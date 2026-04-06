<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BackupLog extends Model
{
    protected $fillable = [
        'filename',
        'file_path',
        'file_size',
        'file_hash',
        'type',
        'status',
        'initiated_by',
        'notes',
        'completed_at',
    ];

    protected $casts = [
        'file_size'    => 'integer',
        'completed_at' => 'datetime',
    ];

    // ── Relationships ────────────────────────────────────────────────────

    public function initiator(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'initiated_by');
    }

    // ── Scopes ───────────────────────────────────────────────────────────

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeManual($query)
    {
        return $query->where('type', 'manual');
    }

    public function scopeScheduled($query)
    {
        return $query->where('type', 'scheduled');
    }

    // ── Helpers ──────────────────────────────────────────────────────────

    public function humanFileSize(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFullPath(): string
    {
        return storage_path('app/private/' . $this->file_path);
    }

    public function verifyIntegrity(): bool
    {
        if (!$this->file_hash) {
            return true;
        }

        $path = $this->getFullPath();

        if (!file_exists($path)) {
            return false;
        }

        return hash_file('sha256', $path) === $this->file_hash;
    }

    public function fileExists(): bool
    {
        return file_exists($this->getFullPath());
    }
}
