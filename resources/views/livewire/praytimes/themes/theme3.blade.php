<div class="h-screen text-white overflow-hidden flex flex-col lg:flex-row">

    {{-- Left Column --}}
    <div class="w-full lg:w-1/4 flex flex-col bg-gradient-to-b from-slate-900 via-slate-800 to-slate-700 relative">
        {{-- Prayer Times --}}
        <div class="flex-1">
            <div class="w-full h-full grid grid-rows-6 gap-3 px-5 py-4 overflow-y-auto">
                @for ($i = 1; $i <= 6; $i++) <div
                    class="bg-white/5 backdrop-blur-sm rounded-2xl px-5 py-auto flex items-center gap-5 border border-white/10"
                    id="{{ $i }}">
                    <div class="flex-shrink-0">
                        {!! $prayerIcons[$i] ?? '' !!}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-xl md:text-2xl lg:text-4xl font-medium truncate" id="praynames{{ $i }}"></h3>
                        <div class="text-xl md:text-2xl lg:text-6xl font-extrabold" id="praytimes{{ $i }}"></div>
                    </div>
            </div>
            @endfor
        </div>
    </div>

</div>

{{-- Right Column --}}
<div class="hidden lg:flex lg:w-3/4 flex-col relative h-full overflow-hidden">

    {{-- Full-screen background --}}
    <div class="absolute inset-0 -z-10">
        <x-partials.hero-with-video :videoPath="$videoPath" />
    </div>

    {{-- Header --}}
    <div id="profile-section" class="flex justify-between items-center absolute top-0 right-0 left-0 bg-gradient-to-r from-black/70 via-transparent to-black/70
                    backdrop-blur-sm border-b border-white/10">

        {{-- Clock --}}
        <div class="flex w-1/3 bg-gradient-to-r from-slate-900 via-slate-950 to bg-transparent p-2">
            <div class="flex justify-center w-full">
                <x-partials.clock-2 />
            </div>
        </div>

        {{-- Profile --}}
        <div class="flex w2/3 items-center justify-end gap-4 p-2">
            <div class="text-right">
                <h1 class="font-merriweather text-2xl lg:text-3xl font-bold drop-shadow-md highlight-me" id="name">
                </h1>
                <p class="text-base lg:text-lg" id="address"></p>
                <p class="text-base lg:text-lg" id="description"></p>
            </div>
            <div class="flex-shrink-0">
                <x-partials.logo />
            </div>
        </div>

        {{-- Current Date --}}
        <div class="absolute -bottom-8 left-0 right-0 bg-gradient-to-r from-blue-950/80 to-blue-700/80 
                          backdrop-blur-sm border-t border-indigo-300/30 px-2">
            <div class="text-right font-medium text-lg lg:text-2xl drop-shadow">
                <x-partials.currentdate />
            </div>
        </div>
    </div>

    {{-- Footer Area --}}
    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent 
                      backdrop-blur-sm">

        {{-- Next Prayer--}}
        <div id="nextprayer-section" class="absolute bottom-21 right-2">
            <x-partials.nextprayer-1 />
        </div>

        {{-- Running Text – Smooth Marquee --}}
        <div class="overflow-hidden bg-black/40 backdrop-blur ">
            <x-partials.running-text :tickerText="$tickerText" />
        </div>

        {{-- Copyright --}}
        <div class="text-center text-xs lg:text-sm text-gray-400" id="copyright-section">
            <x-partials.copyright />
        </div>
    </div>
</div>
</div>