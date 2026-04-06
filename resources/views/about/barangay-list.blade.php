@extends('layouts.public')

@section('title', 'List of Barangays')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <div class="inline-flex items-center gap-2 bg-sea-green/10 text-sea-green text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                30 Barangays
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-2">List of Barangays</h1>
        </div>

        {{-- Urban Barangays --}}
        <div class="mb-10">
            <div class="bg-gradient-to-r from-deep-forest to-sea-green rounded-2xl p-5 sm:p-6 mb-5 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white">10 Urban Barangays</h2>
                    <p class="text-sm text-white/60 mt-0.5">7,273.86 hectares (44.22% of total land area)</p>
                </div>
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
                @php
                $urbanBarangays = ['Centro', 'Centro West', 'Dalaya', 'Leron', 'Maddalero', 'Pattao', 'Sta. Maria', 'Sta. Isabel', 'San Lorenzo', 'Tabbac'];
                @endphp
                @foreach($urbanBarangays as $index => $barangay)
                <div class="bg-white rounded-2xl border border-slate-100 p-4 hover:border-sea-green/30 hover:shadow-sm transition group cursor-default">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-sea-green/10 text-sea-green rounded-lg flex items-center justify-center font-bold text-xs group-hover:bg-sea-green group-hover:text-white transition">
                            {{ $index + 1 }}
                        </div>
                        <span class="text-sm font-medium text-slate-700">{{ $barangay }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Rural Barangays --}}
        <div class="mb-10">
            <div class="bg-gradient-to-r from-tiger-orange to-burnt-tangerine rounded-2xl p-5 sm:p-6 mb-5 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white">20 Rural Barangays</h2>
                    <p class="text-sm text-white/60 mt-0.5">9,176.17 hectares (55.78% of total land area)</p>
                </div>
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
                @php
                $ruralBarangays = ['Ballang', 'Balza', 'Cabaritan', 'Calamegatan', 'Fula', 'M. Antiporda', 'Mala Este', 'Mala Weste', 'Minanga Este', 'Minanga Weste', 'Paddaya Este', 'Paddaya Weste', 'Quinawegan', 'Remebella', 'San Isidro', 'San Juan', 'San Vicente', 'Villa Cielo', 'Villa Gracia', 'Villa Leonora'];
                @endphp
                @foreach($ruralBarangays as $index => $barangay)
                <div class="bg-white rounded-2xl border border-slate-100 p-4 hover:border-tiger-orange/30 hover:shadow-sm transition group cursor-default">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-tiger-orange/10 text-tiger-orange rounded-lg flex items-center justify-center font-bold text-xs group-hover:bg-tiger-orange group-hover:text-white transition">
                            {{ $index + 11 }}
                        </div>
                        <span class="text-sm font-medium text-slate-700">{{ $barangay }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-3xl border border-slate-100 p-5">
                <p class="text-2xl font-extrabold text-deep-forest">30</p>
                <p class="text-xs font-medium text-slate-500 mt-0.5">Total Barangays</p>
                <p class="text-xs text-slate-400 mt-1">Bisected by Buguey Lagoon into coastal and non-coastal areas</p>
            </div>
            <div class="bg-white rounded-3xl border border-slate-100 p-5">
                <p class="text-2xl font-extrabold text-sea-green">Tabbac</p>
                <p class="text-xs font-medium text-slate-500 mt-0.5">Largest Barangay</p>
                <p class="text-xs text-slate-400 mt-1">2,821.17 hectares (17.15%)</p>
            </div>
            <div class="bg-white rounded-3xl border border-slate-100 p-5">
                <p class="text-2xl font-extrabold text-tiger-orange">Sta. Maria</p>
                <p class="text-xs font-medium text-slate-500 mt-0.5">Smallest Barangay</p>
                <p class="text-xs text-slate-400 mt-1">21.87 hectares — most densely populated</p>
            </div>
        </div>

        {{-- Notable Facts --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6">
            <h3 class="text-base font-bold text-deep-forest mb-4">Notable Population Facts</h3>
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 bg-tiger-orange rounded-full mt-2 flex-shrink-0"></span>
                    <p class="text-sm text-slate-600"><strong class="text-deep-forest">Barangay Pattao</strong> is the most populated with 3,295 residents (gateway to the municipality)</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 bg-tiger-orange rounded-full mt-2 flex-shrink-0"></span>
                    <p class="text-sm text-slate-600"><strong class="text-deep-forest">Barangay Centro</strong> (seat of government) is the second most populated with 2,012 residents</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 bg-tiger-orange rounded-full mt-2 flex-shrink-0"></span>
                    <p class="text-sm text-slate-600"><strong class="text-deep-forest">Barangay Sta. Maria</strong> is the most densely populated with 31 persons per hectare</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
