@extends('layouts.public')

@section('title', 'Barangay List Map')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <div class="inline-flex items-center gap-2 bg-sea-green/10 text-sea-green text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/></svg>
                Interactive Map
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-2">Barangay Map</h1>
            <p class="text-sm text-slate-400">All 30 barangays of Buguey organized by urban and rural classification</p>
        </div>

        {{-- Map --}}
        <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm mb-8">
            <iframe
                class="w-full h-[500px] sm:h-[600px] border-0"
                src="https://maps.google.com/maps?q=Buguey,+Cagayan,+Philippines&t=&z=13&ie=UTF8&iwloc=&output=embed"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                <p class="text-xs text-slate-400">
                    <strong class="text-slate-500">Note:</strong> This map shows the general location of Buguey Municipality.
                    The 30 barangays are distributed across coastal and non-coastal areas, bisected by the Buguey Lagoon.
                </p>
            </div>
        </div>

        {{-- Barangay Lists --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-br from-deep-forest to-sea-green rounded-3xl p-6 text-white">
                <h3 class="text-lg font-bold mb-1">10 Urban Barangays</h3>
                <p class="text-xs text-white/50 mb-4">44.22% of total land area (7,273.86 ha)</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['Centro', 'Centro West', 'Dalaya', 'Leron', 'Maddalero', 'Pattao', 'Sta. Maria', 'Sta. Isabel', 'San Lorenzo', 'Tabbac'] as $brgy)
                    <div class="flex items-center gap-2 text-sm text-white/80">
                        <span class="w-1.5 h-1.5 bg-golden-glow rounded-full flex-shrink-0"></span>
                        {{ $brgy }}
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-gradient-to-br from-tiger-orange to-burnt-tangerine rounded-3xl p-6 text-white">
                <h3 class="text-lg font-bold mb-1">20 Rural Barangays</h3>
                <p class="text-xs text-white/50 mb-4">55.78% of total land area (9,176.17 ha)</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['Ballang', 'Balza', 'Cabaritan', 'Calamegatan', 'Fula', 'M. Antiporda', 'Mala Este', 'Mala Weste', 'Minanga Este', 'Minanga Weste', 'Paddaya Este', 'Paddaya Weste', 'Quinawegan', 'Remebella', 'San Isidro', 'San Juan', 'San Vicente', 'Villa Cielo', 'Villa Gracia', 'Villa Leonora'] as $brgy)
                    <div class="flex items-center gap-2 text-sm text-white/80">
                        <span class="w-1.5 h-1.5 bg-golden-glow rounded-full flex-shrink-0"></span>
                        {{ $brgy }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
