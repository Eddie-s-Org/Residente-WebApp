@extends('layouts.public')

@section('title', 'History')

@section('content')
<div class="py-10 md:py-14 lg:py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <div class="inline-flex items-center gap-2 bg-tiger-orange/10 text-tiger-orange text-xs font-semibold tracking-wide uppercase px-4 py-1.5 rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                Municipal History
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-deep-forest mb-3">History of Buguey</h1>
        </div>

        {{-- Intro Card --}}
        <div class="bg-sea-green/5 border border-sea-green/20 rounded-3xl p-6 sm:p-8 mb-10">
            <p class="text-slate-700 leading-relaxed text-base">
                The Municipality of Buguey is a 3rd-class municipality and a coastal town in the province of Cagayan, Philippines.
                Its rich history dates back to the Spanish colonial period, and the town has grown into a vibrant
                community where about 80% of families are engaged in farming, fishing, and related activities.
            </p>
        </div>

        {{-- Etymology --}}
        <div class="mb-10">
            <h2 class="text-xl font-bold text-deep-forest mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-deep-forest/10 text-deep-forest rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg>
                </span>
                Etymology — Origin of the Name
            </h2>
            <p class="text-slate-600 leading-relaxed">
                Buguey derived its name from the Ibanag word <strong class="text-deep-forest">"Navugay,"</strong> which means <strong class="text-deep-forest">capsized</strong>.
                In the early 1600s, sea pirates stole the town's largest bell, but a strong gust of wind caused their
                vinta (boat) to sink in the Babuyan Channel. The locals shouted <em>"Navugay Ira"</em> in joy, and the
                word eventually evolved into "Buguey".
            </p>
        </div>

        {{-- Historical Timeline --}}
        <div class="mb-10">
            <h2 class="text-xl font-bold text-deep-forest mb-6 flex items-center gap-2">
                <span class="w-8 h-8 bg-deep-forest/10 text-deep-forest rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                Historical Timeline
            </h2>
            <div class="space-y-0">
                @php
                    $events = [
                        ['date' => 'May 20, 1623', 'title' => 'Foundation by Royal Decree', 'desc' => 'The town was officially founded by a Royal Decree from the King of Spain, establishing Buguey as an important settlement in Northern Luzon during the Spanish colonial period.'],
                        ['date' => '1901', 'title' => 'Barrio Status', 'desc' => 'During the American colonial period, Buguey was reduced to a barrio (village) and administratively attached to the municipality of Camalaniugan.'],
                        ['date' => 'July 26, 1915', 'title' => 'Municipal Status Restored', 'desc' => 'Buguey\'s municipal status was officially restored, re-establishing its independence and local governance.'],
                        ['date' => 'Modern Era', 'title' => 'Progressive Municipality', 'desc' => 'Today, Buguey continues to thrive as a 3rd-class municipality with a strong focus on agriculture, fisheries, and sustainable development.'],
                    ];
                @endphp
                @foreach($events as $i => $evt)
                <div class="flex gap-4 sm:gap-6 relative">
                    {{-- Timeline line --}}
                    @if(!$loop->last)
                    <div class="absolute left-[19px] sm:left-[23px] top-10 bottom-0 w-px bg-slate-200"></div>
                    @endif
                    {{-- Dot --}}
                    <div class="flex-shrink-0 w-10 sm:w-12 pt-1">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-tiger-orange/10 text-tiger-orange rounded-xl flex items-center justify-center font-bold text-xs">
                            {{ $i + 1 }}
                        </div>
                    </div>
                    {{-- Content --}}
                    <div class="pb-8">
                        <span class="text-xs font-semibold text-tiger-orange">{{ $evt['date'] }}</span>
                        <h3 class="text-base font-bold text-deep-forest mt-0.5">{{ $evt['title'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mt-1">{{ $evt['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Socio-Economic Profile --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-6 sm:p-8">
            <h2 class="text-xl font-bold text-deep-forest mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-deep-forest/10 text-deep-forest rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5"/></svg>
                </span>
                Socio-Economic Profile
            </h2>
            <p class="text-slate-600 leading-relaxed">
                Buguey is a predominantly agricultural municipality. Approximately <strong class="text-deep-forest">80% of its families</strong> are engaged
                in farming, fishing, and related livelihood activities. The town's economy is deeply rooted in its coastal and
                agricultural resources, making it a vital contributor to the province's food production.
            </p>
        </div>
    </div>
</div>
@endsection
