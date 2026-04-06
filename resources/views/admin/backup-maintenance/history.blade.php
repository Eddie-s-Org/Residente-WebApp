@extends('layouts.admin')

@section('title', 'Backup History')
@section('subtitle', 'Full backup log with filters')

@section('content')
<div class="p-8">

    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.backup-maintenance.index') }}" class="text-sm text-sea-green hover:text-deep-forest font-semibold transition mb-2 inline-block">
                &larr; Back to Dashboard
            </a>
            <h1 class="text-3xl font-bold text-deep-forest">Backup History</h1>
        </div>
        <form method="POST" action="{{ route('admin.backup-maintenance.backup.create') }}">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-sea-green text-white rounded-lg hover:bg-deep-forest transition font-semibold text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                </svg>
                New Backup
            </button>
        </form>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('admin.backup-maintenance.history') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sea-green focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="manual" {{ request('type') === 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="scheduled" {{ request('type') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sea-green focus:border-transparent">
                    <option value="">All Statuses</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sea-green focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sea-green focus:border-transparent">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2 bg-sea-green text-white rounded-lg hover:bg-deep-forest transition font-bold text-sm">
                    Filter
                </button>
                <a href="{{ route('admin.backup-maintenance.history') }}" class="px-5 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition font-bold text-sm">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Backup Logs Table --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($backupLogs->isEmpty())
            <div class="px-6 py-12 text-center">
                <p class="text-gray-500 font-medium">No backup records found</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-left">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Date / Time</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Filename</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Size</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Integrity</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Initiated By</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($backupLogs as $backup)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">#{{ $backup->id }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $backup->created_at->format('M d, Y H:i:s') }}</td>
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
                                        <span class="inline-flex items-center gap-1 text-tiger-orange" title="File missing from disk">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                            </svg>
                                            <span class="text-xs font-semibold">Missing</span>
                                        </span>
                                    @elseif($backup->verifyIntegrity())
                                        <span class="inline-flex items-center gap-1 text-sea-green" title="SHA-256 verified">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                                            </svg>
                                            <span class="text-xs font-semibold">Verified</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-burnt-tangerine" title="Hash mismatch — possible tampering">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                            </svg>
                                            <span class="text-xs font-semibold">Tampered</span>
                                        </span>
                                    @endif
                                @else
                                    <span class="text-xs text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $backup->initiator ? $backup->initiator->full_name : 'System' }}
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

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $backupLogs->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
