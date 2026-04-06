@extends('layouts.public')

@section('title', 'Map of Buguey')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <div class="inline-flex items-center gap-2 bg-deep-forest/10 text-deep-forest text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/></svg>
                Geographic Location
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-2">Map of Buguey</h1>
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
        </div>

        {{-- Info Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-3xl border border-slate-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-sea-green/10 text-sea-green rounded-xl flex items-center justify-center">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-deep-forest">Location & Size</h3>
                </div>
                <ul class="space-y-2.5 text-sm text-slate-600">
                    <li class="flex justify-between"><span class="text-slate-400">Province</span><span class="font-medium text-slate-700">Cagayan, Philippines</span></li>
                    <li class="flex justify-between"><span class="text-slate-400">Total Land Area</span><span class="font-medium text-slate-700">16,450.05 hectares</span></li>
                    <li class="flex justify-between"><span class="text-slate-400">Municipality Rank</span><span class="font-medium text-slate-700">8th smallest in Cagayan</span></li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-tiger-orange/10 text-tiger-orange rounded-xl flex items-center justify-center">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64"/></svg>
                    </div>
                    <h3 class="font-bold text-deep-forest">Boundaries</h3>
                </div>
                <ul class="space-y-2.5 text-sm text-slate-600">
                    <li class="flex justify-between"><span class="text-slate-400">North</span><span class="font-medium text-slate-700">Babuyan Channel</span></li>
                    <li class="flex justify-between"><span class="text-slate-400">East</span><span class="font-medium text-slate-700">Sta. Teresita</span></li>
                    <li class="flex justify-between"><span class="text-slate-400">South</span><span class="font-medium text-slate-700">Lal-lo</span></li>
                    <li class="flex justify-between"><span class="text-slate-400">West</span><span class="font-medium text-slate-700">Aparri and Camalaniugan</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
