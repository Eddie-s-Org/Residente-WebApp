@extends('layouts.public')

@section('title', 'E-Bugueyano')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-deep-forest via-deep-forest to-sea-green text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-white/10 text-golden-glow text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                Digital Citizen Portal
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-3">E-Bugueyano Portal</h1>
            <p class="text-base text-white/60 max-w-xl mx-auto">Your digital gateway to personalized e-governance services for residents of Buguey</p>
        </div>

        {{-- Feature Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            {{-- Profile Card --}}
            <div class="bg-white/[0.08] backdrop-blur-sm rounded-3xl p-7 border border-white/10 hover:bg-white/[0.12] transition group">
                <div class="w-12 h-12 bg-golden-glow/20 text-golden-glow rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2 group-hover:text-golden-glow transition">Personal Profile</h3>
                <p class="text-sm text-white/50 leading-relaxed">Access and manage your digital resident profile, household data, and personal records.</p>
            </div>

            {{-- Service Requests Card --}}
            <div class="bg-white/[0.08] backdrop-blur-sm rounded-3xl p-7 border border-white/10 hover:bg-white/[0.12] transition group">
                <div class="w-12 h-12 bg-sea-green/30 text-emerald-300 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2 group-hover:text-emerald-300 transition">Service Requests</h3>
                <p class="text-sm text-white/50 leading-relaxed">Submit and track government service applications — from certificates to permits.</p>
            </div>

            {{-- Notifications Card --}}
            <div class="bg-white/[0.08] backdrop-blur-sm rounded-3xl p-7 border border-white/10 hover:bg-white/[0.12] transition group">
                <div class="w-12 h-12 bg-tiger-orange/20 text-tiger-orange rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2 group-hover:text-tiger-orange transition">Notifications</h3>
                <p class="text-sm text-white/50 leading-relaxed">Receive real-time updates about your barangay, municipality events, and request statuses.</p>
            </div>
        </div>

        {{-- Additional Features --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
            @php
                $features = [
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>', 'label' => 'PhilSys Verified'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5"/>', 'label' => '24/7 Access'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>', 'label' => 'Fast Processing'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>', 'label' => 'Secure & Private'],
                ];
            @endphp
            @foreach($features as $feat)
            <div class="bg-white/[0.06] rounded-2xl py-4 px-3 text-center border border-white/5">
                <svg class="w-5 h-5 mx-auto mb-2 text-white/50" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">{!! $feat['icon'] !!}</svg>
                <p class="text-xs font-medium text-white/70">{{ $feat['label'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="text-center">
            @auth
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-golden-glow hover:bg-white text-deep-forest px-8 py-3.5 rounded-xl font-bold shadow-lg transition text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Go to My Dashboard
                </a>
            @else
                <div class="bg-white/[0.08] backdrop-blur-sm rounded-3xl p-8 max-w-md mx-auto border border-white/10">
                    <h3 class="font-bold text-xl mb-2">Access E-Bugueyano Services</h3>
                    <p class="text-sm text-white/50 mb-6">Register or log in to access personalized e-governance services</p>
                    <div class="flex gap-3 justify-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-golden-glow hover:bg-white text-deep-forest px-6 py-3 rounded-xl font-bold shadow-lg transition text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
                            Register Now
                        </a>
                        <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 px-6 py-3 rounded-xl font-bold transition text-sm border border-white/10">
                            Log In
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
