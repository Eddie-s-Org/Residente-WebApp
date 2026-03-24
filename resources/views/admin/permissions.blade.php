@extends('layouts.admin')

@section('title', 'Role Permissions')
@section('subtitle', 'Manage feature access for each role')

@section('content')
<div class="p-8" x-data="permissionsManager()">

    {{-- Page header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-deep-forest">🛡️ Permissions Manager</h2>
            <p class="text-sm text-gray-500 mt-1">Toggle features on or off for each role. Super Admin always has full access.</p>
        </div>
    </div>

    {{-- Role selector tabs --}}
    <div class="flex gap-2 mb-6 bg-white rounded-xl p-1.5 shadow-sm border border-slate-200 w-fit">
        @foreach($roles as $index => $role)
            @php
                $dotColor = match($role->name) {
                    'SA'      => 'bg-red-500',
                    'admin'   => 'bg-orange-500',
                    'citizen' => 'bg-emerald-500',
                    'visitor' => 'bg-gray-400',
                    default   => 'bg-blue-500',
                };
            @endphp
            <button type="button"
                @click="activeRole = {{ $index }}"
                :class="activeRole === {{ $index }}
                    ? 'bg-deep-forest text-white shadow-md'
                    : 'text-slate-600 hover:bg-slate-100'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 cursor-pointer">
                <span class="w-2 h-2 rounded-full {{ $dotColor }}"></span>
                {{ $role->display_name }}
                <span class="text-[10px] opacity-70">({{ $role->residents_count }})</span>
            </button>
        @endforeach
    </div>

    {{-- Role permission panels --}}
    @foreach($roles as $index => $role)
    <div x-show="activeRole === {{ $index }}" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0">

        @if($role->name === 'SA')
            {{-- SA: Read-only info card --}}
            <div class="bg-gradient-to-r from-red-50 to-orange-50 border border-red-200 rounded-2xl p-8 text-center">
                <div class="text-4xl mb-3">🔒</div>
                <h3 class="text-lg font-bold text-red-800">Super Admin — Full Access</h3>
                <p class="text-sm text-red-600 mt-1 max-w-md mx-auto">
                    This role has unrestricted access to all features and cannot be modified.
                    All permissions are permanently enabled.
                </p>
                <div class="flex flex-wrap justify-center gap-2 mt-5">
                    @foreach($permissions as $module => $perms)
                        <span class="px-3 py-1 bg-white/80 border border-red-200 text-red-700 text-xs font-semibold rounded-full">
                            ✓ {{ $module }}
                        </span>
                    @endforeach
                </div>
            </div>
        @else
            {{-- Editable role --}}
            <form action="{{ route('admin.permissions.update', $role) }}" method="POST"
                  x-data="{ dirty: false }" @change="dirty = true">
                @csrf
                @method('PUT')

                {{-- Sticky save bar --}}
                <div x-show="dirty" x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="sticky top-0 z-10 mb-4 flex items-center justify-between bg-amber-50 border border-amber-300 rounded-xl px-5 py-3 shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-amber-600">⚠️</span>
                        <span class="text-sm font-medium text-amber-800">You have unsaved changes for <strong>{{ $role->display_name }}</strong></span>
                    </div>
                    <button type="submit"
                        class="px-5 py-2 bg-deep-forest text-white text-sm font-bold rounded-lg
                               hover:bg-sea-green transition-colors duration-150 cursor-pointer shadow-sm">
                        💾 Save Changes
                    </button>
                </div>

                {{-- Module cards grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach($permissions as $module => $perms)
                        @php
                            $moduleIcons = [
                                'Dashboard'       => '📊',
                                'Residents'       => '👥',
                                'Services'        => '⚙️',
                                'Households'      => '🏠',
                                'Documents'       => '📄',
                                'Reports'         => '📈',
                                'Activity Logs'   => '📝',
                                'Verification'    => '✅',
                                'Data Collection' => '📋',
                                'ID Scanner'      => '🪪',
                                'Settings'        => '🔧',
                                'Roles'           => '🛡️',
                            ];
                            $icon = $moduleIcons[$module] ?? '📦';
                            $enabledCount = $perms->filter(fn($p) => $role->permissions->contains('id', $p->id))->count();
                            $totalCount = $perms->count();
                            $allEnabled = $enabledCount === $totalCount;
                        @endphp
                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200"
                             x-data="{ allChecked: {{ $allEnabled ? 'true' : 'false' }} }">

                            {{-- Module header --}}
                            <div class="flex items-center justify-between px-4 py-3 bg-slate-50 border-b border-slate-200">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-lg">{{ $icon }}</span>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800">{{ $module }}</h4>
                                        <p class="text-[10px] text-slate-400 font-medium">{{ $enabledCount }}/{{ $totalCount }} enabled</p>
                                    </div>
                                </div>
                                {{-- Toggle all for this module --}}
                                <label class="relative inline-flex items-center cursor-pointer" title="Toggle all {{ $module }} permissions">
                                    <input type="checkbox" class="sr-only peer"
                                           :checked="allChecked"
                                           @click="
                                               allChecked = !allChecked;
                                               $el.closest('[x-data]').querySelectorAll('input[data-module]').forEach(cb => cb.checked = allChecked);
                                           ">
                                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-sea-green/30 rounded-full
                                                peer-checked:after:translate-x-full peer-checked:after:border-white after:content-['']
                                                after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300
                                                after:border after:rounded-full after:h-4 after:w-4 after:transition-all
                                                peer-checked:bg-sea-green"></div>
                                </label>
                            </div>

                            {{-- Action items --}}
                            <div class="p-4 space-y-2">
                                @foreach($perms as $perm)
                                    @php
                                        $isEnabled = $role->permissions->contains('id', $perm->id);
                                        $actionColors = [
                                            'view'    => 'text-blue-600 bg-blue-50',
                                            'create'  => 'text-emerald-600 bg-emerald-50',
                                            'edit'    => 'text-amber-600 bg-amber-50',
                                            'delete'  => 'text-red-600 bg-red-50',
                                            'verify'  => 'text-indigo-600 bg-indigo-50',
                                            'promote' => 'text-purple-600 bg-purple-50',
                                            'toggle'  => 'text-cyan-600 bg-cyan-50',
                                            'approve' => 'text-teal-600 bg-teal-50',
                                            'export'  => 'text-pink-600 bg-pink-50',
                                        ];
                                        $actionClass = $actionColors[$perm->action] ?? 'text-slate-600 bg-slate-50';
                                    @endphp
                                    <label class="flex items-center justify-between py-1.5 px-3 rounded-lg hover:bg-slate-50 cursor-pointer select-none transition-colors group">
                                        <div class="flex items-center gap-2.5">
                                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded {{ $actionClass }}">
                                                {{ $perm->action }}
                                            </span>
                                            <span class="text-sm text-slate-700 group-hover:text-slate-900">{{ $perm->display_name }}</span>
                                        </div>
                                        <input type="checkbox"
                                               name="permissions[]"
                                               value="{{ $perm->id }}"
                                               data-module="{{ $module }}"
                                               {{ $isEnabled ? 'checked' : '' }}
                                               class="h-4 w-4 rounded border-gray-300 text-sea-green
                                                      focus:ring-sea-green transition cursor-pointer">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Bottom save button --}}
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="px-6 py-2.5 bg-deep-forest text-white text-sm font-bold rounded-xl
                               hover:bg-sea-green transition-colors duration-150 cursor-pointer shadow-sm">
                        💾 Save {{ $role->display_name }} Permissions
                    </button>
                </div>
            </form>
        @endif
    </div>
    @endforeach
</div>

<script>
function permissionsManager() {
    return {
        activeRole: {{ $roles->search(fn($r) => $r->name !== 'SA') ?: 0 }}
    }
}
</script>
@endsection
