@extends('layouts.public')

@section('title', 'Buguey Hymn')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center">
            <div class="inline-flex items-center gap-2 bg-deep-forest/10 text-deep-forest text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z"/></svg>
                Municipal Anthem
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-8">Buguey Hymn</h1>
        </div>

        {{-- Placeholder --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-10 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-600 mb-1">Hymn Content Coming Soon</h3>
            <p class="text-sm text-slate-400">Contact the Municipal Office for the official hymn lyrics and audio.</p>
        </div>
    </div>
</div>
@endsection
