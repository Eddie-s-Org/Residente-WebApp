@extends('layouts.public')

@section('title', 'Services Directory')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white" x-data="{ search: '' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 bg-sea-green/10 text-sea-green text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Public Directory
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-3">LGU Buguey Services</h1>
            <p class="text-base text-slate-500 max-w-2xl mx-auto">Complete directory of available government services organized by department</p>
        </div>

        {{-- Search Bar --}}
        <div class="max-w-lg mx-auto mb-10">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" x-model="search" placeholder="Search services or departments..." class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sea-green/30 focus:border-sea-green shadow-sm">
            </div>
        </div>

        {{-- Department Cards --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Municipal Health Office --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow"
                 x-show="search === '' || 'municipal health office anti-rabies immunization laboratory maternal tuberculosis dental std death certificate sanitary out-patient'.includes(search.toLowerCase()) || 'Municipal Health Office'.toLowerCase().includes(search.toLowerCase())"
                 x-transition.opacity>
                <div class="p-5 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-11 h-11 bg-sea-green/10 text-sea-green rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-deep-forest">Municipal Health Office</h3>
                        <p class="text-xs text-slate-400">10 services available</p>
                    </div>
                    <span class="ml-auto text-xs font-medium text-sea-green bg-sea-green/10 px-2.5 py-1 rounded-full">Health</span>
                </div>
                <ul class="p-2">
                    @php
                        $healthServices = [
                            'Availing of Anti-Rabies',
                            'Availing of Immunization Services',
                            'Availing of Laboratory Services',
                            'Maternal and Child Health Care',
                            'Anti-Tuberculosis Drugs/Medicines',
                            'Availing of Dental Services',
                            'Availing STD/STI Services',
                            'Securing Medical/Death Certificate',
                            'Out-Patient Department',
                            'Issuance of Sanitary Permit',
                        ];
                    @endphp
                    @foreach($healthServices as $service)
                    <li class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-slate-600 hover:bg-sea-green/5 hover:text-deep-forest transition-colors cursor-default group">
                        <span class="w-1.5 h-1.5 bg-sea-green/40 rounded-full group-hover:bg-sea-green transition-colors"></span>
                        {{ $service }}
                        <svg class="w-4 h-4 ml-auto text-slate-300 group-hover:text-sea-green transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Municipal Civil Registrar --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow"
                 x-show="search === '' || 'municipal civil registrar birth marriage death forms petition court supplemental'.includes(search.toLowerCase()) || 'Municipal Civil Registrar'.toLowerCase().includes(search.toLowerCase())"
                 x-transition.opacity>
                <div class="p-5 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-11 h-11 bg-tiger-orange/10 text-tiger-orange rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-deep-forest">Municipal Civil Registrar</h3>
                        <p class="text-xs text-slate-400">7 services available</p>
                    </div>
                    <span class="ml-auto text-xs font-medium text-tiger-orange bg-tiger-orange/10 px-2.5 py-1 rounded-full">Records</span>
                </div>
                <ul class="p-2">
                    @php
                        $registrarServices = [
                            'Registration of Birth (Timely/Delayed, Legitimate/Illegitimate, Out-of-Town)',
                            'Registration of Marriage (Timely/Delayed) & License Application',
                            'Registration of Death (Timely/Delayed)',
                            'Issuance of Forms (1A, 1B, 1C, 2A, 2B, 2C, 3A, 3B, CTC)',
                            'Petition for Clerical Error/Change of Name (RA9048 & 10172)',
                            'Registration of Court Orders & Legal Instruments',
                            'Supplemental Report',
                        ];
                    @endphp
                    @foreach($registrarServices as $service)
                    <li class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-slate-600 hover:bg-tiger-orange/5 hover:text-deep-forest transition-colors cursor-default group">
                        <span class="w-1.5 h-1.5 bg-tiger-orange/40 rounded-full group-hover:bg-tiger-orange transition-colors"></span>
                        {{ $service }}
                        <svg class="w-4 h-4 ml-auto text-slate-300 group-hover:text-tiger-orange transition-colors flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Mayor's Office --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow"
                 x-show="search === '' || 'mayor office clearance business permit working tricycle'.includes(search.toLowerCase()) || \"Mayor's Office\".toLowerCase().includes(search.toLowerCase())"
                 x-transition.opacity>
                <div class="p-5 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-11 h-11 bg-golden-glow/15 text-deep-forest rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-deep-forest">Mayor's Office</h3>
                        <p class="text-xs text-slate-400">4 services available</p>
                    </div>
                    <span class="ml-auto text-xs font-medium text-deep-forest bg-golden-glow/20 px-2.5 py-1 rounded-full">Executive</span>
                </div>
                <ul class="p-2">
                    @php
                        $mayorServices = [
                            'Issuance of Mayor\'s Clearance',
                            'Issuance of Business Permit',
                            'Issuance of Working Permit',
                            'Motorized Tricycle Operator\'s Permit',
                        ];
                    @endphp
                    @foreach($mayorServices as $service)
                    <li class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-slate-600 hover:bg-golden-glow/10 hover:text-deep-forest transition-colors cursor-default group">
                        <span class="w-1.5 h-1.5 bg-golden-glow/50 rounded-full group-hover:bg-golden-glow transition-colors"></span>
                        {{ $service }}
                        <svg class="w-4 h-4 ml-auto text-slate-300 group-hover:text-deep-forest transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Planning and Development --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow"
                 x-show="search === '' || 'planning development zoning land locational clearance'.includes(search.toLowerCase()) || 'Planning and Development'.toLowerCase().includes(search.toLowerCase())"
                 x-transition.opacity>
                <div class="p-5 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-11 h-11 bg-burnt-tangerine/10 text-burnt-tangerine rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-deep-forest">Planning and Development</h3>
                        <p class="text-xs text-slate-400">2 services available</p>
                    </div>
                    <span class="ml-auto text-xs font-medium text-burnt-tangerine bg-burnt-tangerine/10 px-2.5 py-1 rounded-full">Zoning</span>
                </div>
                <ul class="p-2">
                    @php
                        $planningServices = [
                            'Zoning Certification/Land Issuance',
                            'Locational Clearance for Business Permit',
                        ];
                    @endphp
                    @foreach($planningServices as $service)
                    <li class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-slate-600 hover:bg-burnt-tangerine/5 hover:text-deep-forest transition-colors cursor-default group">
                        <span class="w-1.5 h-1.5 bg-burnt-tangerine/40 rounded-full group-hover:bg-burnt-tangerine transition-colors"></span>
                        {{ $service }}
                        <svg class="w-4 h-4 ml-auto text-slate-300 group-hover:text-burnt-tangerine transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Stats Strip --}}
        <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-3xl mx-auto">
            <div class="text-center bg-white rounded-2xl border border-slate-100 py-4 px-3">
                <p class="text-2xl font-extrabold text-deep-forest">4</p>
                <p class="text-xs text-slate-400 mt-0.5">Departments</p>
            </div>
            <div class="text-center bg-white rounded-2xl border border-slate-100 py-4 px-3">
                <p class="text-2xl font-extrabold text-sea-green">23</p>
                <p class="text-xs text-slate-400 mt-0.5">Total Services</p>
            </div>
            <div class="text-center bg-white rounded-2xl border border-slate-100 py-4 px-3">
                <p class="text-2xl font-extrabold text-tiger-orange">100%</p>
                <p class="text-xs text-slate-400 mt-0.5">Digital Ready</p>
            </div>
            <div class="text-center bg-white rounded-2xl border border-slate-100 py-4 px-3">
                <p class="text-2xl font-extrabold text-golden-glow">24/7</p>
                <p class="text-xs text-slate-400 mt-0.5">Online Access</p>
            </div>
        </div>

        {{-- CTA --}}
        <div class="mt-12 text-center">
            <div class="bg-gradient-to-r from-deep-forest to-sea-green rounded-3xl shadow-lg p-8 sm:p-10 max-w-2xl mx-auto">
                <h3 class="text-xl sm:text-2xl font-bold text-white mb-2">Ready to Request Services?</h3>
                <p class="text-sm text-white/70 mb-6">Create your RESIDENTE account to access online service requests</p>
                @auth
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 bg-golden-glow hover:bg-white text-deep-forest px-7 py-3 rounded-xl font-bold shadow-lg transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        View Full Directory
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-golden-glow hover:bg-white text-deep-forest px-7 py-3 rounded-xl font-bold shadow-lg transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
                        Register Now
                    </a>
                @endauth
            </div>
        </div>

    </div>
</div>
@endsection
