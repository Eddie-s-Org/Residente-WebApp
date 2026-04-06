@extends('layouts.admin')

@section('title', 'Backup & Maintenance')
@section('subtitle', 'System Health & Database Management')

@section('content')
<div class="p-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-deep-forest flex items-center gap-3">
            <svg class="w-8 h-8 text-sea-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
            </svg>
            Backup & Maintenance
        </h1>
        <p class="text-gray-600 mt-2">Monitor system health, manage database backups, and control maintenance mode</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        {{-- Database Size --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-sea-green">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Database Size</p>
                    <p class="text-2xl font-bold text-deep-forest mt-1">{{ number_format($dbSize / 1024 / 1024, 2) }} MB</p>
                </div>
                <div class="bg-sea-green bg-opacity-10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-sea-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">MySQL &middot; {{ $tableCount }} tables</p>
        </div>

        {{-- Total Backups --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-deep-forest">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Backups</p>
                    <p class="text-2xl font-bold text-deep-forest mt-1">{{ number_format($totalBackups) }}</p>
                </div>
                <div class="bg-deep-forest bg-opacity-10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-deep-forest" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-2 flex gap-3 text-xs">
                <span class="text-gray-400">{{ $manualBackups }} manual</span>
                <span class="text-gray-400">{{ $scheduledBackups }} scheduled</span>
            </div>
        </div>

        {{-- Last Backup --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-golden-glow">
            <p class="text-sm text-gray-600 mb-1">Last Backup</p>
            <p class="text-2xl font-bold text-deep-forest">
                {{ $lastBackup ? $lastBackup->created_at->diffForHumans() : 'Never' }}
            </p>
            <p class="text-xs text-gray-400 mt-1">
                {{ $lastBackup ? $lastBackup->created_at->format('M d, Y H:i') : 'No backups yet' }}
            </p>
        </div>

        {{-- System Status --}}
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 {{ $isMaintenanceMode ? 'border-tiger-orange' : 'border-sea-green' }}">
            <p class="text-sm text-gray-600 mb-1">System Status</p>
            @if($isMaintenanceMode)
                <p class="text-2xl font-bold text-tiger-orange flex items-center gap-2">
                    <span class="w-3 h-3 bg-tiger-orange rounded-full animate-pulse"></span> Maintenance
                </p>
                <p class="text-xs text-tiger-orange mt-1">App is offline for users</p>
            @else
                <p class="text-2xl font-bold text-sea-green flex items-center gap-2">
                    <span class="w-3 h-3 bg-sea-green rounded-full"></span> Online
                </p>
                <p class="text-xs text-gray-400 mt-1">All systems operational</p>
            @endif
        </div>

    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">

            {{-- Create Backup --}}
            <form method="POST" action="{{ route('admin.backup-maintenance.backup.create') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-sea-green text-white rounded-lg hover:bg-deep-forest transition font-semibold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                    </svg>
                    Create Backup Now
                </button>
            </form>

            {{-- Maintenance Toggle --}}
            <div x-data="{ showConfirm: false }">
                <button @click="showConfirm = true"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-semibold text-sm transition
                        {{ $isMaintenanceMode
                            ? 'bg-sea-green text-white hover:bg-deep-forest'
                            : 'bg-tiger-orange text-white hover:bg-burnt-tangerine' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17l-5.1-5.1m0 0L11.42 4.97m-5.1 5.1H21.75"/>
                    </svg>
                    {{ $isMaintenanceMode ? 'Bring App Online' : 'Enable Maintenance Mode' }}
                </button>

                {{-- Confirmation modal --}}
                <div x-show="showConfirm" x-cloak
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" @click.self="showConfirm = false">
                    <div class="bg-white rounded-xl shadow-2xl p-6 max-w-sm mx-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">
                            {{ $isMaintenanceMode ? 'Bring Application Online?' : 'Enable Maintenance Mode?' }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-5">
                            {{ $isMaintenanceMode
                                ? 'The application will be accessible to all users again.'
                                : 'All users will see a 503 maintenance page. You will receive a secret bypass URL.' }}
                        </p>
                        <div class="flex gap-3 justify-end">
                            <button @click="showConfirm = false" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 transition">Cancel</button>
                            <form method="POST" action="{{ route('admin.backup-maintenance.maintenance.toggle') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-sm font-bold text-white rounded-lg transition
                                    {{ $isMaintenanceMode ? 'bg-sea-green hover:bg-deep-forest' : 'bg-tiger-orange hover:bg-burnt-tangerine' }}">
                                    Confirm
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- History --}}
            <a href="{{ route('admin.backup-maintenance.history') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-semibold text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                View History
            </a>

            {{-- Documentation --}}
            <a href="{{ route('admin.backup-maintenance.documentation') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-semibold text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                Documentation
            </a>

        </div>
    </div>

    {{-- Server Information --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Server Information</h2>
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <dt class="text-gray-500 font-medium">PHP Version</dt>
                    <dd class="text-gray-800 font-semibold">{{ phpversion() }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <dt class="text-gray-500 font-medium">Laravel Version</dt>
                    <dd class="text-gray-800 font-semibold">{{ app()->version() }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <dt class="text-gray-500 font-medium">Database</dt>
                    <dd class="text-gray-800 font-semibold">MySQL {{ $mysqlVersion }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <dt class="text-gray-500 font-medium">Database Name</dt>
                    <dd class="text-gray-800 font-semibold font-mono text-xs">{{ substr($dbName, 0, 4) }}***{{ substr($dbName, -3) }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <dt class="text-gray-500 font-medium">Timezone</dt>
                    <dd class="text-gray-800 font-semibold">{{ config('app.timezone') }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <dt class="text-gray-500 font-medium">Environment</dt>
                    <dd class="text-gray-800 font-semibold">{{ app()->environment() }}</dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-gray-500 font-medium">Server</dt>
                    <dd class="text-gray-800 font-semibold">{{ $_SERVER['SERVER_SOFTWARE'] ?? 'CLI' }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Disk Usage</h2>
            @php
                $usedDisk = $diskTotal - $diskFree;
                $usedPercent = $diskTotal > 0 ? round(($usedDisk / $diskTotal) * 100, 1) : 0;
            @endphp
            <div class="mb-4">
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-600">{{ number_format($usedDisk / 1024 / 1024 / 1024, 1) }} GB used</span>
                    <span class="text-gray-600">{{ number_format($diskTotal / 1024 / 1024 / 1024, 1) }} GB total</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="h-3 rounded-full transition-all duration-300 {{ $usedPercent > 90 ? 'bg-burnt-tangerine' : ($usedPercent > 70 ? 'bg-tiger-orange' : 'bg-sea-green') }}"
                         style="width: {{ $usedPercent }}%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-1">{{ $usedPercent }}% used — {{ number_format($diskFree / 1024 / 1024 / 1024, 1) }} GB free</p>
            </div>

            <dl class="space-y-3 text-sm mt-6">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <dt class="text-gray-500 font-medium">Database Size</dt>
                    <dd class="text-gray-800 font-semibold">{{ number_format($dbSize / 1024 / 1024, 2) }} MB</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <dt class="text-gray-500 font-medium">Storage Usage</dt>
                    <dd class="text-gray-800 font-semibold">{{ number_format($storageSize / 1024 / 1024, 2) }} MB</dd>
                </div>
                <div class="flex justify-between py-2">
                    <dt class="text-gray-500 font-medium">Backup Storage</dt>
                    <dd class="text-gray-800 font-semibold">
                        @php
                            $backupDir = storage_path('app/private/backups');
                            $backupSize = 0;
                            if (is_dir($backupDir)) {
                                foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($backupDir, \FilesystemIterator::SKIP_DOTS)) as $file) {
                                    if ($file->isFile()) $backupSize += $file->getSize();
                                }
                            }
                        @endphp
                        {{ number_format($backupSize / 1024 / 1024, 2) }} MB
                    </dd>
                </div>
            </dl>
        </div>

    </div>

    {{-- Recent Backups --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Recent Backups</h2>
            <a href="{{ route('admin.backup-maintenance.history') }}" class="text-sm font-semibold text-sea-green hover:text-deep-forest transition">
                View All &rarr;
            </a>
        </div>

        @if($recentBackups->isEmpty())
            <div class="px-6 py-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                </svg>
                <p class="text-gray-500 font-medium">No backups yet</p>
                <p class="text-sm text-gray-400 mt-1">Create your first backup using the button above</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-left">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Date / Time</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Filename</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Size</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Integrity</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($recentBackups as $backup)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-700">{{ $backup->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 text-gray-700 font-mono text-xs">{{ $backup->filename }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $backup->humanFileSize() }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $backup->type === 'manual' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                    {{ ucfirst($backup->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $backup->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($backup->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($backup->status === 'completed')
                                    @if(!$backup->fileExists())
                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-burnt-tangerine" title="File missing from disk">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z"/></svg>
                                            Missing
                                        </span>
                                    @elseif($backup->file_hash && !$backup->verifyIntegrity())
                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-burnt-tangerine" title="SHA-256 hash mismatch">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z"/></svg>
                                            Tampered
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-sea-green" title="SHA-256 verified">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                            Verified
                                        </span>
                                    @endif
                                @else
                                    <span class="text-xs text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if($backup->status === 'completed')
                                    <a href="{{ route('admin.backup-maintenance.backup.download', $backup) }}"
                                       class="text-sea-green hover:text-deep-forest transition" title="Download">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                        </svg>
                                    </a>
                                    @endif
                                    <form method="POST" action="{{ route('admin.backup-maintenance.backup.delete', $backup) }}"
                                          onsubmit="return confirm('Delete this backup?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-burnt-tangerine transition" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
