@extends('layouts.public')

@section('title', 'Memos & Circulars')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 bg-deep-forest/10 text-deep-forest text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                Official Documents
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-3">Memos & Circulars</h1>
            <p class="text-base text-slate-500 max-w-xl mx-auto">Official memorandums, circulars, and communications from the Municipality of Buguey</p>
        </div>

        {{-- Memos List --}}
        <div class="space-y-4">
            {{-- Sample Memo --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden group">
                <div class="p-6 flex items-start gap-4">
                    <div class="w-11 h-11 bg-tiger-orange/10 text-tiger-orange rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <h3 class="font-bold text-deep-forest text-base group-hover:text-sea-green transition-colors">Sample Memorandum Title</h3>
                            <span class="text-xs text-slate-400 bg-slate-50 px-3 py-1 rounded-full whitespace-nowrap flex-shrink-0">Feb 27, 2026</span>
                        </div>
                        <p class="text-sm text-slate-500 mb-3 leading-relaxed">Brief description of the memorandum content goes here...</p>
                        <div class="flex items-center gap-4">
                            <span class="text-xs text-slate-400 font-medium">Memo No: 2026-001</span>
                            <button class="inline-flex items-center gap-1.5 text-tiger-orange font-semibold text-sm hover:text-burnt-tangerine transition">
                                View PDF
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Empty State --}}
        <div class="text-center py-16 mt-4">
            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9.75m3 0h-3m4.253 3.14l.155-.034a3.375 3.375 0 002.513-2.514l.034-.154M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-600 mb-1">More Memos Coming Soon</h3>
            <p class="text-sm text-slate-400">Official memorandums and circulars will be published here as they are issued.</p>
        </div>
    </div>
</div>
@endsection
