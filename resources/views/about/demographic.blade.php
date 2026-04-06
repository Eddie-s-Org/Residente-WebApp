@extends('layouts.public')

@section('title', 'Demographic Profile')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <div class="inline-flex items-center gap-2 bg-sea-green/10 text-sea-green text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                Census Data
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-2">Demographic Profile</h1>
            <p class="text-sm text-slate-400">Based on 2015 PSA Census Data</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            @php
                $stats = [
                    ['value' => '30,175', 'label' => 'Total Population', 'sub' => 'PSA Census 2015', 'color' => 'sea-green', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>'],
                    ['value' => '1.12%', 'label' => 'Annual Growth Rate', 'sub' => 'Average annual', 'color' => 'tiger-orange', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>'],
                    ['value' => '30', 'label' => 'Barangays', 'sub' => '10 Urban, 20 Rural', 'color' => 'golden-glow', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>'],
                    ['value' => '1.83', 'label' => 'Population Density', 'sub' => 'persons per hectare', 'color' => 'burnt-tangerine', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>'],
                ];
            @endphp
            @foreach($stats as $stat)
            <div class="bg-white rounded-3xl border border-slate-100 p-5">
                <div class="w-9 h-9 bg-{{ $stat['color'] }}/10 text-{{ $stat['color'] }} rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">{!! $stat['icon'] !!}</svg>
                </div>
                <p class="text-2xl font-extrabold text-deep-forest">{{ $stat['value'] }}</p>
                <p class="text-xs font-medium text-slate-500 mt-0.5">{{ $stat['label'] }}</p>
                <p class="text-[10px] text-slate-400 mt-0.5">{{ $stat['sub'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Gender & Age --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-3xl border border-slate-100 p-6 sm:p-8">
                <h2 class="text-lg font-bold text-deep-forest mb-5">Gender Distribution</h2>
                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between mb-1.5">
                            <span class="text-sm font-medium text-slate-600">Male</span>
                            <span class="text-sm font-bold text-deep-forest">51%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-sea-green h-2.5 rounded-full" style="width: 51%"></div>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">51 males per 100 population</p>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1.5">
                            <span class="text-sm font-medium text-slate-600">Female</span>
                            <span class="text-sm font-bold text-deep-forest">49%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-tiger-orange h-2.5 rounded-full" style="width: 49%"></div>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">49 females per 100 population</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 p-6 sm:p-8">
                <h2 class="text-lg font-bold text-deep-forest mb-5">Age Distribution</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-sea-green/5 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-sea-green rounded-full"></span>
                            <span class="text-sm text-slate-600">0-19 years (Youth)</span>
                        </div>
                        <span class="font-bold text-sea-green">41.63%</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-tiger-orange/5 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-tiger-orange rounded-full"></span>
                            <span class="text-sm text-slate-600">20-64 years (Working Age)</span>
                        </div>
                        <span class="font-bold text-tiger-orange">~52%</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-burnt-tangerine/5 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-burnt-tangerine rounded-full"></span>
                            <span class="text-sm text-slate-600">65+ years (Senior Citizens)</span>
                        </div>
                        <span class="font-bold text-burnt-tangerine">~6%</span>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-golden-glow/10 rounded-xl">
                    <p class="text-xs text-slate-600">Buguey has a <strong>young demographic</strong>, with over 40% under 20 years old</p>
                </div>
            </div>
        </div>

        {{-- Labor Force --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6 sm:p-8">
            <h2 class="text-lg font-bold text-deep-forest mb-6">Labor Force & Employment</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-3">Participation Rate</h3>
                    <div class="bg-sea-green/5 rounded-2xl p-5 border border-sea-green/10">
                        <p class="text-3xl font-extrabold text-sea-green">62.06%</p>
                        <p class="text-sm text-slate-500 mt-1">18,728 individuals in the labor force</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-3">Employment by Sector</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 bg-sea-green/10 text-sea-green rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
                                </div>
                                <span class="text-sm text-slate-600">Agriculture</span>
                            </div>
                            <span class="font-bold text-sea-green">59.69%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 bg-tiger-orange/10 text-tiger-orange rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.15c0 .415.336.75.75.75z"/></svg>
                                </div>
                                <span class="text-sm text-slate-600">Services</span>
                            </div>
                            <span class="font-bold text-tiger-orange">35.86%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 bg-burnt-tangerine/10 text-burnt-tangerine rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                                </div>
                                <span class="text-sm text-slate-600">Industry</span>
                            </div>
                            <span class="font-bold text-burnt-tangerine">4.45%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 p-4 bg-tiger-orange/5 border border-tiger-orange/10 rounded-2xl">
                <p class="text-sm text-slate-600">
                    <strong class="text-deep-forest">Agriculture is the major employment generator</strong>, absorbing nearly 60% of the working population,
                    followed by the service sector. About 80% of families are engaged in farming, fishing, and related activities.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
