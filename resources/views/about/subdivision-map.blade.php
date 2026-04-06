@extends('layouts.public')

@section('title', 'Subdivision Map')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <div class="inline-flex items-center gap-2 bg-golden-glow/15 text-deep-forest text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                Land Distribution
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-2">Subdivision Map of Buguey</h1>
            <p class="text-sm text-slate-400">Administrative subdivision showing land area distribution across all barangays</p>
        </div>

        {{-- Map Placeholder --}}
        <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-br from-deep-forest to-sea-green h-80 sm:h-96 flex items-center justify-center p-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white/60" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/></svg>
                    </div>
                    <p class="text-lg font-bold text-white mb-1">Administrative Subdivision Map</p>
                    <p class="text-sm text-white/50">Detailed land use and subdivision map coming soon</p>
                    <p class="text-xs text-white/30 mt-2">Will display barangay boundaries and land area percentages</p>
                </div>
            </div>
        </div>

        {{-- Land Area Stats --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6 sm:p-8 mb-8">
            <h2 class="text-lg font-bold text-deep-forest mb-2">Land Area Distribution</h2>
            <p class="text-sm text-slate-400 mb-6">Total municipal land area: <strong class="text-slate-600">16,450.05 hectares</strong></p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-golden-glow/5 border border-golden-glow/10 rounded-2xl p-5">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Largest Barangay</p>
                    <p class="text-xl font-extrabold text-tiger-orange">Tabbac</p>
                    <p class="text-sm text-slate-500 mt-1">2,821.17 hectares</p>
                    <p class="text-xs text-slate-400">17.15% of total area</p>
                </div>
                <div class="bg-sea-green/5 border border-sea-green/10 rounded-2xl p-5">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Smallest Barangay</p>
                    <p class="text-xl font-extrabold text-sea-green">Sta. Maria</p>
                    <p class="text-sm text-slate-500 mt-1">21.87 hectares</p>
                    <p class="text-xs text-slate-400">Most densely populated</p>
                </div>
                <div class="bg-tiger-orange/5 border border-tiger-orange/10 rounded-2xl p-5">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Classification</p>
                    <p class="text-sm text-slate-600 mt-2"><strong class="text-deep-forest">Urban:</strong> 7,273.86 ha (44.22%)</p>
                    <p class="text-sm text-slate-600"><strong class="text-deep-forest">Rural:</strong> 9,176.17 ha (55.78%)</p>
                </div>
            </div>
        </div>

        {{-- Geographic Feature --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 bg-deep-forest/10 text-deep-forest rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-deep-forest">Key Geographic Feature</h3>
                    <p class="text-sm text-slate-500 mt-1"><strong class="text-deep-forest">Buguey Lagoon</strong> bisects the municipality into coastal and non-coastal areas, creating distinct ecological and economic zones.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
