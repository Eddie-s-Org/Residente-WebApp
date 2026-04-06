<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use App\Models\BackupLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class DatabaseBackup extends Command
{
    protected $signature = 'backup:database {--type=scheduled : Backup type (manual|scheduled)}';

    protected $description = 'Create a compressed backup of the MySQL database with integrity hash';

    public function handle(): int
    {
        $destDir   = storage_path('app/private/backups');
        $timestamp = now()->format('Y-m-d_His');
        $type      = $this->option('type');

        if (!is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }

        // Check disk space before proceeding
        $freeSpace = disk_free_space($destDir);
        if ($freeSpace !== false && $freeSpace < 524288000) { // 500MB
            $this->error('Insufficient disk space. At least 500MB free space required.');
            return self::FAILURE;
        }

        $driver = config('database.default');

        try {
            if ($driver === 'sqlite') {
                $result = $this->backupSqlite($destDir, $timestamp);
            } else {
                $result = $this->backupMysql($destDir, $timestamp);
            }

            // Compute SHA-256 integrity hash
            $fullPath = "{$destDir}/{$result['filename']}";
            $fileHash = hash_file('sha256', $fullPath);

            BackupLog::create([
                'filename'     => $result['filename'],
                'file_path'    => "backups/{$result['filename']}",
                'file_size'    => $result['size'],
                'file_hash'    => $fileHash,
                'type'         => $type,
                'status'       => 'completed',
                'initiated_by' => null,
                'completed_at' => now(),
            ]);

            $sizeFormatted = number_format($result['size'] / 1024, 2);
            $this->info("Backup created: {$result['filename']} ({$sizeFormatted} KB)");
            $this->info("SHA-256: {$fileHash}");
        } catch (\Exception $e) {
            BackupLog::create([
                'filename'     => "backup_{$timestamp}_failed",
                'file_path'    => "backups/backup_{$timestamp}_failed",
                'file_size'    => 0,
                'type'         => $type,
                'status'       => 'failed',
                'initiated_by' => null,
                'notes'        => $e->getMessage(),
            ]);

            $this->error('Backup failed: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->pruneOldBackups();

        return self::SUCCESS;
    }

    private function backupSqlite(string $destDir, string $timestamp): array
    {
        $sourcePath = database_path('database.sqlite');
        if (!file_exists($sourcePath)) {
            throw new \RuntimeException('SQLite database file not found.');
        }

        $filename = "backup_{$timestamp}.sqlite";
        copy($sourcePath, "{$destDir}/{$filename}");

        return ['filename' => $filename, 'size' => filesize("{$destDir}/{$filename}")];
    }

    private function backupMysql(string $destDir, string $timestamp): array
    {
        $connection = config('database.default');
        $host     = config("database.connections.{$connection}.host", '127.0.0.1');
        $port     = config("database.connections.{$connection}.port", '3306');
        $database = config("database.connections.{$connection}.database");
        $username = config("database.connections.{$connection}.username");
        $password = config("database.connections.{$connection}.password", '');

        $filename = "backup_{$timestamp}.sql.gz";
        $destPath = "{$destDir}/{$filename}";

        // Detect mysqldump path — XAMPP on Windows may need explicit path
        $mysqldumpPath = $this->findMysqldump();

        // Build command: dump + gzip. Password passed via MYSQL_PWD env to avoid shell exposure.
        $command = sprintf(
            '%s --host=%s --port=%s --user=%s --single-transaction --routines --triggers %s | gzip > %s',
            escapeshellarg($mysqldumpPath),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            escapeshellarg($database),
            escapeshellarg($destPath)
        );

        $result = Process::env(['MYSQL_PWD' => $password])
            ->timeout(300)
            ->run($command);

        if (!$result->successful()) {
            // Clean up partial file
            if (file_exists($destPath)) {
                unlink($destPath);
            }
            throw new \RuntimeException('mysqldump failed: ' . $result->errorOutput());
        }

        if (!file_exists($destPath) || filesize($destPath) === 0) {
            if (file_exists($destPath)) {
                unlink($destPath);
            }
            throw new \RuntimeException('Backup file is empty or was not created.');
        }

        return ['filename' => $filename, 'size' => filesize($destPath)];
    }

    private function findMysqldump(): string
    {
        // Try standard PATH first
        $check = Process::run(PHP_OS_FAMILY === 'Windows' ? 'where mysqldump 2>nul' : 'which mysqldump 2>/dev/null');

        if ($check->successful() && trim($check->output())) {
            return trim(explode("\n", $check->output())[0]);
        }

        // XAMPP Windows fallback paths
        $fallbacks = [
            'C:\\MyXampp\\mysql\\bin\\mysqldump.exe',
            'C:\\xampp\\mysql\\bin\\mysqldump.exe',
        ];

        foreach ($fallbacks as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        throw new \RuntimeException(
            'mysqldump executable not found. Ensure MySQL client tools are installed and in your PATH.'
        );
    }

    private function pruneOldBackups(): void
    {
        $cutoff = now()->subDays(30);
        $oldBackups = BackupLog::where('created_at', '<', $cutoff)->get();

        foreach ($oldBackups as $backup) {
            $filePath = $backup->getFullPath();
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $backup->delete();
            $this->line("Pruned old backup: {$backup->filename}");
        }
    }
}
