@extends('layouts.app')

@section('title', 'Profile Setup')

@push('styles')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('content')
<div class="bg-slate-50 antialiased font-sans min-h-screen flex flex-col items-center py-10 md:py-14 px-4 sm:px-6 lg:px-8">

    <div class="w-full max-w-3xl" x-data="{ step: 1, maxSteps: 5 }">

        {{-- Header --}}
        <div class="mb-8 text-center">
            <div class="inline-flex items-center gap-2 bg-tiger-orange/10 text-tiger-orange text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                Profile Onboarding
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-deep-forest">Complete Your Resident Profile</h2>
            <p class="text-sm text-slate-500 mt-2">Account Status: <span class="text-tiger-orange font-bold">In Progress</span></p>

            {{-- Progress Bar --}}
            <div class="mt-6">
                <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-deep-forest to-sea-green h-2 rounded-full transition-all duration-500" :style="'width: ' + ((step / maxSteps) * 100) + '%'"></div>
                </div>
                <div class="flex justify-between mt-3">
                    @php
                        $steps = [
                            ['num' => 1, 'label' => 'Housing', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>'],
                            ['num' => 2, 'label' => 'Agriculture', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>'],
                            ['num' => 3, 'label' => 'Aquaculture', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 01-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 01-1.458-1.137l1.411-2.353a2.25 2.25 0 00.286-.76l.095-.572a1.125 1.125 0 011.12-.983h.604l.271-.677a2.25 2.25 0 011.126-1.126l.477-.19a1.125 1.125 0 011.577.75l.157.627z"/>'],
                            ['num' => 4, 'label' => 'Livestock', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.379a48.474 48.474 0 00-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265z"/>'],
                            ['num' => 5, 'label' => 'Fisheries', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332"/>'],
                        ];
                    @endphp
                    @foreach($steps as $s)
                    <div class="flex flex-col items-center gap-1">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-300"
                             :class="step >= {{ $s['num'] }} ? 'bg-sea-green/10 text-sea-green' : 'bg-slate-100 text-slate-400'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">{!! $s['icon'] !!}</svg>
                        </div>
                        <span class="text-[10px] font-semibold tracking-wide uppercase transition-colors duration-300"
                              :class="step >= {{ $s['num'] }} ? 'text-sea-green' : 'text-slate-400'">{{ $s['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <form action="{{ route('profile.onboarding.store') }}" method="POST" class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            @csrf

            {{-- Step 1: Housing & Sanitation --}}
            <div x-show="step === 1" x-transition.opacity class="p-6 sm:p-8 space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 bg-sea-green/10 text-sea-green rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-deep-forest">Housing & Sanitation</h3>
                        <p class="text-xs text-slate-400">Step 1 of 5</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Residential Status</label>
                        <select name="residential_type" class="block w-full rounded-xl border-slate-200 py-3 px-4 text-sm text-slate-700 focus:border-sea-green focus:ring-sea-green">
                            <option>Owned</option>
                            <option>Rented</option>
                            <option>Shared</option>
                            <option>Informal Settler</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">House Materials</label>
                        <select name="house_materials" class="block w-full rounded-xl border-slate-200 py-3 px-4 text-sm text-slate-700 focus:border-sea-green focus:ring-sea-green">
                            <option value="Type A">Type A (Galvanized Iron/Concrete)</option>
                            <option value="Type B">Type B (Combination Light/Concrete)</option>
                            <option value="Type C">Type C (Light Materials Only)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Water Source</label>
                        <select name="water_source" class="block w-full rounded-xl border-slate-200 py-3 px-4 text-sm text-slate-700 focus:border-sea-green focus:ring-sea-green">
                            <option>Poso / Jet Matic</option>
                            <option>Balon (Well)</option>
                            <option>Tap / Piped Water</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="space-y-3 flex flex-col justify-center">
                        <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition">
                            <input type="checkbox" name="flood_prone" class="h-4 w-4 text-sea-green rounded border-slate-300 focus:ring-sea-green">
                            <span class="text-sm text-slate-600">Located in a flood-prone area</span>
                        </label>
                        <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition">
                            <input type="checkbox" name="sanitary_toilet" class="h-4 w-4 text-sea-green rounded border-slate-300 focus:ring-sea-green">
                            <span class="text-sm text-slate-600">Has access to a sanitary toilet</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Step 2: Agriculture (Crops) --}}
            <div x-show="step === 2" x-transition.opacity class="p-6 sm:p-8 space-y-6" style="display: none;">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 bg-sea-green/10 text-sea-green rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-deep-forest">Agriculture (Crops)</h3>
                        <p class="text-xs text-slate-400">Step 2 of 5 — Select crops you actively farm</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach(['Vegetables', 'Ginger', 'Banana', 'Mango', 'Pineapple', 'Citrus', 'Mungbean', 'Peanut', 'Coconut', 'Coffee', 'Cacao'] as $crop)
                    <label class="flex items-center gap-3 p-3.5 bg-slate-50 border border-slate-100 rounded-xl hover:bg-sea-green/5 hover:border-sea-green/20 cursor-pointer transition group">
                        <input type="checkbox" name="crops[]" value="{{ $crop }}" class="h-4 w-4 text-sea-green rounded border-slate-300 focus:ring-sea-green">
                        <span class="text-sm text-slate-600 font-medium group-hover:text-deep-forest transition">{{ $crop }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Step 3: Aquaculture --}}
            <div x-show="step === 3" x-transition.opacity class="p-6 sm:p-8 space-y-6" style="display: none;">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 bg-sea-green/10 text-sea-green rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-deep-forest">Aquaculture</h3>
                        <p class="text-xs text-slate-400">Step 3 of 5 — Select marine farming activities</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach(['Fishpond', 'Fishcage', 'Oyster (Raft/Broadcast)', 'Seaweed'] as $aqua)
                    <label class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-100 rounded-xl hover:bg-sea-green/5 hover:border-sea-green/20 cursor-pointer transition group">
                        <input type="checkbox" name="aquaculture[]" value="{{ $aqua }}" class="h-5 w-5 text-sea-green rounded border-slate-300 focus:ring-sea-green">
                        <span class="text-sm text-slate-700 font-semibold group-hover:text-deep-forest transition">{{ $aqua }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Step 4: Livestock & Poultry --}}
            <div x-show="step === 4" x-transition.opacity class="p-6 sm:p-8 space-y-6" style="display: none;">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 bg-sea-green/10 text-sea-green rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.379a48.474 48.474 0 00-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-deep-forest">Livestock & Poultry</h3>
                        <p class="text-xs text-slate-400">Step 4 of 5</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <h4 class="font-semibold text-tiger-orange text-sm mb-3">Large Ruminants</h4>
                        <div class="space-y-2">
                            @foreach(['Carabao', 'Cattle', 'Horse'] as $animal)
                            <label class="flex items-center gap-2.5 p-2 rounded-lg hover:bg-white cursor-pointer transition">
                                <input type="checkbox" name="livestock[]" value="{{ $animal }}" class="h-4 w-4 text-sea-green rounded border-slate-300 focus:ring-sea-green">
                                <span class="text-sm text-slate-600">{{ $animal }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <h4 class="font-semibold text-tiger-orange text-sm mb-3">Small Ruminants</h4>
                        <div class="space-y-2">
                            @foreach(['Goat', 'Sheep'] as $animal)
                            <label class="flex items-center gap-2.5 p-2 rounded-lg hover:bg-white cursor-pointer transition">
                                <input type="checkbox" name="livestock[]" value="{{ $animal }}" class="h-4 w-4 text-sea-green rounded border-slate-300 focus:ring-sea-green">
                                <span class="text-sm text-slate-600">{{ $animal }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <h4 class="font-semibold text-tiger-orange text-sm mb-3">Others</h4>
                        <div class="space-y-2">
                            @foreach(['Swine' => 'Swine', 'Poultry' => 'Poultry', 'Companions' => 'Companions (Pets)'] as $val => $label)
                            <label class="flex items-center gap-2.5 p-2 rounded-lg hover:bg-white cursor-pointer transition">
                                <input type="checkbox" name="livestock[]" value="{{ $val }}" class="h-4 w-4 text-sea-green rounded border-slate-300 focus:ring-sea-green">
                                <span class="text-sm text-slate-600">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 5: Capture Fisheries --}}
            <div x-show="step === 5" x-transition.opacity class="p-6 sm:p-8 space-y-6" style="display: none;">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 bg-sea-green/10 text-sea-green rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-deep-forest">Capture Fisheries</h3>
                        <p class="text-xs text-slate-400">Step 5 of 5 — Indicate your fishing engagement</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach(['Municipal Inland Fishing', 'Municipal Marine Fishing', 'Various Fishing Gear'] as $fish)
                    <label class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-100 rounded-xl hover:bg-sea-green/5 hover:border-sea-green/20 cursor-pointer transition group">
                        <input type="checkbox" name="fisheries[]" value="{{ $fish }}" class="h-5 w-5 text-sea-green rounded border-slate-300 focus:ring-sea-green">
                        <span class="text-sm text-slate-700 font-semibold group-hover:text-deep-forest transition">{{ $fish === 'Various Fishing Gear' ? 'Various Fishing Gear Types' : $fish }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Navigation Footer --}}
            <div class="bg-slate-50 px-6 sm:px-8 py-4 border-t border-slate-100 flex items-center justify-between">
                <button type="button" x-show="step > 1" @click="step--" class="inline-flex items-center gap-1.5 text-slate-500 font-semibold hover:text-deep-forest transition text-sm px-4 py-2 rounded-xl hover:bg-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    Back
                </button>
                <div x-show="step === 1"></div>

                <div class="flex items-center gap-3">
                    <button type="button" @click="step < maxSteps ? step++ : $el.closest('form').submit()" class="text-slate-400 hover:text-tiger-orange font-medium text-sm px-3 py-2 transition">
                        Skip
                    </button>

                    <button type="button" x-show="step < maxSteps" @click="step++" class="inline-flex items-center gap-1.5 bg-gradient-to-r from-deep-forest to-sea-green hover:opacity-90 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-sm text-sm">
                        Next Step
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </button>

                    <button type="submit" x-show="step === maxSteps" class="inline-flex items-center gap-1.5 bg-gradient-to-r from-tiger-orange to-burnt-tangerine hover:opacity-90 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-sm text-sm" style="display: none;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Complete Onboarding
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
