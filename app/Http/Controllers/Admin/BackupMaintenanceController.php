<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BackupLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BackupMaintenanceController extends Controller
{
    /**
     * Dashboard — system health, quick actions, recent backups.
     */
    public function index()
    {
        // Database metrics (MySQL)
        $dbName = config('database.connections.mysql.database');
        $dbSizeResult = DB::select(
            "SELECT SUM(data_length + index_length) AS size FROM information_schema.tables WHERE table_schema = ?",
            [$dbName]
        );
        $dbSize = $dbSizeResult[0]->size ?? 0;

        $tableCount = count(DB::select("SHOW TABLES"));

        $mysqlVersion = DB::select("SELECT VERSION() AS version")[0]->version ?? 'Unknown';

        // Disk usage
        $diskFree  = disk_free_space(base_path());
        $diskTotal = disk_total_space(base_path());

        // Storage directory size
        $storageSize = $this->directorySize(storage_path('app'));

        // Backups
        $totalBackups    = BackupLog::completed()->count();
        $manualBackups   = BackupLog::completed()->manual()->count();
        $scheduledBackups = BackupLog::completed()->scheduled()->count();
        $lastBackup      = BackupLog::completed()->latest()->first();
        $recentBackups   = BackupLog::latest()->limit(5)->get();

        // System status
        $isMaintenanceMode = app()->isDownForMaintenance();

        return view('admin.backup-maintenance.index', compact(
            'dbSize',
            'dbName',
            'tableCount',
            'mysqlVersion',
            'diskFree',
            'diskTotal',
            'storageSize',
            'totalBackups',
            'manualBackups',
            'scheduledBackups',
            'lastBackup',
            'recentBackups',
            'isMaintenanceMode',
        ));
    }

    /**
     * Trigger a manual backup via artisan command.
     */
    public function createBackup(Request $request)
    {
        // Check disk space first
        $freeSpace = disk_free_space(storage_path());
        if ($freeSpace !== false && $freeSpace < 524288000) {
            return back()->with('error', 'Insufficient disk space. At least 500MB free is required.');
        }

        try {
            $exitCode = Artisan::call('backup:database', ['--type' => 'manual']);

            if ($exitCode !== 0) {
                return back()->with('error', 'Backup command failed. Check server logs for details.');
            }

            // Update the last created backup record with the current user
            $lastBackup = BackupLog::latest()->first();
            if ($lastBackup && $lastBackup->type === 'manual' && !$lastBackup->initiated_by) {
                $lastBackup->update(['initiated_by' => auth()->id()]);
            }

            ActivityLog::log([
                'resident_id'  => auth()->id(),
                'user_email'   => auth()->user()->email,
                'user_role'    => auth()->user()->role,
                'action'       => 'backup_created',
                'entity_type'  => 'BackupLog',
                'entity_id'    => $lastBackup->id ?? null,
                'description'  => "Manual database backup created: " . ($lastBackup->filename ?? 'unknown'),
                'severity'     => 'critical',
            ]);

            return back()->with('success', "Backup created successfully: " . ($lastBackup->filename ?? ''));
        } catch (\Exception $e) {
            return back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }

    /**
     * Download a backup file with integrity verification.
     */
    public function downloadBackup(BackupLog $backupLog)
    {
        $filePath = $backupLog->getFullPath();

        if (!file_exists($filePath)) {
            return back()->with('error', 'Backup file not found on disk.');
        }

        // Verify file integrity before serving
        if (!$backupLog->verifyIntegrity()) {
            ActivityLog::log([
                'resident_id'  => auth()->id(),
                'user_email'   => auth()->user()->email,
                'user_role'    => auth()->user()->role,
                'action'       => 'backup_integrity_failure',
                'entity_type'  => 'BackupLog',
                'entity_id'    => $backupLog->id,
                'description'  => "Integrity check FAILED for backup: {$backupLog->filename}",
                'severity'     => 'critical',
                'is_suspicious' => true,
            ]);

            return back()->with('error', 'Backup file integrity check failed — file may be corrupted or tampered with.');
        }

        ActivityLog::log([
            'resident_id'  => auth()->id(),
            'user_email'   => auth()->user()->email,
            'user_role'    => auth()->user()->role,
            'action'       => 'backup_downloaded',
            'entity_type'  => 'BackupLog',
            'entity_id'    => $backupLog->id,
            'description'  => "Downloaded backup: {$backupLog->filename}",
            'severity'     => 'warning',
        ]);

        return response()->download($filePath, $backupLog->filename);
    }

    /**
     * Delete a backup file and its record.
     */
    public function deleteBackup(BackupLog $backupLog)
    {
        $filePath = $backupLog->getFullPath();
        $filename = $backupLog->filename;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $backupLog->delete();

        ActivityLog::log([
            'resident_id'  => auth()->id(),
            'user_email'   => auth()->user()->email,
            'user_role'    => auth()->user()->role,
            'action'       => 'backup_deleted',
            'entity_type'  => 'BackupLog',
            'description'  => "Deleted backup: {$filename}",
            'severity'     => 'critical',
        ]);

        return back()->with('success', "Backup deleted: {$filename}");
    }

    /**
     * Full backup history with filters.
     */
    public function history(Request $request)
    {
        $query = BackupLog::latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $backupLogs = $query->paginate(20)->withQueryString();

        return view('admin.backup-maintenance.history', compact('backupLogs'));
    }

    /**
     * Toggle maintenance mode on/off.
     */
    public function toggleMaintenance(Request $request)
    {
        if (app()->isDownForMaintenance()) {
            Artisan::call('up');

            ActivityLog::log([
                'resident_id'  => auth()->id(),
                'user_email'   => auth()->user()->email,
                'user_role'    => auth()->user()->role,
                'action'       => 'maintenance_disabled',
                'entity_type'  => 'system',
                'description'  => 'Application brought ONLINE from maintenance mode',
                'severity'     => 'critical',
            ]);

            return back()->with('success', 'Application is now ONLINE.');
        }

        $secret = Str::random(32);
        Artisan::call('down', ['--secret' => $secret]);

        ActivityLog::log([
            'resident_id'  => auth()->id(),
            'user_email'   => auth()->user()->email,
            'user_role'    => auth()->user()->role,
            'action'       => 'maintenance_enabled',
            'entity_type'  => 'system',
            'description'  => 'Application placed into MAINTENANCE MODE',
            'severity'     => 'critical',
        ]);

        $bypassUrl = url("/{$secret}");

        return back()->with('success', "Maintenance mode ENABLED. Bypass URL: {$bypassUrl}");
    }

    /**
     * Documentation / operations checklist page.
     */
    public function documentation()
    {
        return view('admin.backup-maintenance.documentation');
    }

    /**
     * Calculate total size of a directory recursively.
     */
    private function directorySize(string $path): int
    {
        $size = 0;

        if (!is_dir($path)) {
            return $size;
        }

        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)) as $file) {
            if ($file->isFile()) {
                $size += $file->getSize();
            }
        }

        return $size;
    }
}
