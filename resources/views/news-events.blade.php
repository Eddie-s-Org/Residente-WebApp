@extends('layouts.public')

@section('title', 'News & Events')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white" x-data="{ category: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 bg-tiger-orange/10 text-tiger-orange text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                Latest Updates
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-3">News & Events</h1>
            <p class="text-base text-slate-500 max-w-2xl mx-auto">Stay updated with the latest news, events, and announcements from the Municipality of Buguey</p>
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($announcements as $announcement)
            <article class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden group">
                {{-- Category Bar --}}
                <div class="px-6 pt-5 pb-0 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $announcement->category_badge_color }} text-xs font-semibold rounded-full">
                        {{ $announcement->category }}
                    </span>
                    <span class="text-xs text-slate-400">{{ $announcement->formatted_posted_at }}</span>
                </div>

                {{-- Content --}}
                <div class="p-6">
                    <h3 class="font-bold text-deep-forest text-base mb-2 group-hover:text-sea-green transition-colors leading-snug">{{ $announcement->title }}</h3>
                    <p class="text-sm text-slate-500 mb-4 leading-relaxed">{{ Str::limit($announcement->content, 150) }}</p>

                    @if($announcement->target_barangay)
                    <div class="flex items-center gap-1.5 text-xs text-slate-400 mb-4">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        Barangay {{ $announcement->target_barangay }}
                    </div>
                    @endif

                    <button class="inline-flex items-center gap-1.5 text-tiger-orange font-semibold text-sm hover:text-burnt-tangerine transition group-hover:gap-2">
                        Read More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </button>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-20">
                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-600 mb-1">No News Yet</h3>
                <p class="text-sm text-slate-400">Check back soon for updates and announcements.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($announcements->hasPages())
        <div class="mt-10">
            {{ $announcements->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
