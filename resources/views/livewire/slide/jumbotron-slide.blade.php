<div wire:poll.300s="loadData">

    <x-layouts.preloader />

    <div id="app-config" style="display: none;" data-random-images='@json($randomImages ?? [])'
        data-praytimes='@json($praytimes ?? [])'>
    </div>

    <div class="fixed inset-x-0 top-0 z-50">
        <div id="nextprayer-section" class="flex justify-center">
            <!-- Next Prayer -->
            <div class="flex items-center">
                <div
                    class="bg-gradient-to-b from-teal-500 to-teal-700 outline-4 outline-stone-50 py-1 pl-10 pr-3 rounded-bl-6xl">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="animate-pulse h-7 lg:h-20 max-w-[30px] max-h-[30px] lg:max-w-[40px] lg:max-h-[48px]">
                        <path d="M9 4.55a8 8 0 0 1 6 14.9m0 -4.45v5h5" />
                        <path d="M5.63 7.16l0 .01" />
                        <path d="M4.06 11l0 .01" />
                        <path d="M4.63 15.1l0 .01" />
                        <path d="M7.16 18.37l0 .01" />
                        <path d="M11 19.94l0 .01" />
                    </svg>
                </div>
                <div
                    class="font-montserrat font-medium text-gray-800 text-xl lg:text-5xl tracking-tighter tabular-nums inline-flex flex-wrap items-center justify-center gap-x-2 bg-gradient-to-b from-stone-50 to-stone-300 outline-4 outline-stone-50 shadow-xl py-1 pl-3 pr-10 rounded-br-6xl whitespace-nowrap">
                    @include('livewire.praytimes.partials.nextprayer')
                </div>
            </div>
        </div>
    </div>

    <!-- Jumbotron section -->
    <div id="jumbotron-section">
        @include('livewire.praytimes.partials.hero')
    </div>

    <!-- Footer -->
    <div class="fixed inset-x-0 bottom-0 z-50 mx-auto w-full">
        <div id="clock-section" class="flex justify-center mb-1">
            <!-- Clock -->
            <div
                class="flex flex-row bg-gradient-to-b from-stone-400 to bg-stone-200 rounded-tl-6xl rounded-tr-6xl px-10 outline-4 outline-stone-100">
                @include('livewire.praytimes.partials.clock')
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('storage/dist/praytimes/PrayTimes.js') }}"></script>
<script src="{{ asset('storage/dist/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('storage/dist/moment/moment-with-locales.js') }}"></script>
<script src="{{ asset('storage/dist/imageRandomizer/imageRandomizer.js') }}"></script>
<script src="{{ asset('storage/dist/sharedFunctions.js') }}"></script>

<script>
    let currentClockInterval;
    let startCountDownInterval;

    function initJumbotron() {
        // Clear existing intervals to prevent duplicates
        clearInterval(currentClockInterval);
        clearInterval(startCountDownInterval);

        // Read dynamic data from DOM (updated after each poll/morph)
        const configElement = document.getElementById('app-config');
        if (!configElement) {
            console.error('Config element not found');
            return;
        }

        let randomImages, praytimes;
        try {
            randomImages = JSON.parse(configElement.dataset.randomImages) || [];
            praytimes = JSON.parse(configElement.dataset.praytimes) || {};
        } catch (error) {
            console.error('Error parsing app-config JSON:', error);
            return;
        }

        // Initialize praytimesCountDown    
        const prayerConfig = {
            prayer_calc_method: praytimes.prayer_calc_method ?? 'Kemenag',
            latitude: praytimes.latitude ?? '3.67026',
            longitude: praytimes.longitude ?? '98.59399',
            timezone: praytimes.timezone ?? '7',
            dst: praytimes.dst ?? '0',
            time_format: praytimes.time_format ?? '24h',
            prayer1_alias: (praytimes.prayer1_alias ?? 'fajr').charAt(0).toUpperCase() + (praytimes.prayer1_alias ?? 'fajr').slice(1),
            prayer2_alias: (praytimes.prayer2_alias ?? 'sunrise').charAt(0).toUpperCase() + (praytimes.prayer2_alias ?? 'sunrise').slice(1),
            prayer3_alias: (praytimes.prayer3_alias ?? 'duhr').charAt(0).toUpperCase() + (praytimes.prayer3_alias ?? 'duhr').slice(1),
            prayer4_alias: (praytimes.prayer4_alias ?? 'asr').charAt(0).toUpperCase() + (praytimes.prayer4_alias ?? 'asr').slice(1),
            prayer5_alias: (praytimes.prayer5_alias ?? 'maghrib').charAt(0).toUpperCase() + (praytimes.prayer5_alias ?? 'maghrib').slice(1),
            prayer6_alias: (praytimes.prayer6_alias ?? 'isha').charAt(0).toUpperCase() + (praytimes.prayer6_alias ?? 'isha').slice(1),
            prayer1_correction: praytimes.prayer1_correction ?? '0',
            prayer2_correction: praytimes.prayer2_correction ?? '0',
            prayer3_correction: praytimes.prayer3_correction ?? '0',
            prayer4_correction: praytimes.prayer4_correction ?? '0',
            prayer5_correction: praytimes.prayer5_correction ?? '0',
            prayer6_correction: praytimes.prayer6_correction ?? '0',
            adhan_duration: praytimes.adhan_duration ?? '5',
            prayer1_iqomah_duration: praytimes.prayer1_iqomah_duration ?? '3',
            prayer3_iqomah_duration: praytimes.prayer3_iqomah_duration ?? '3',
            prayer4_iqomah_duration: praytimes.prayer4_iqomah_duration ?? '3',
            prayer5_iqomah_duration: praytimes.prayer5_iqomah_duration ?? '3',
            prayer6_iqomah_duration: praytimes.prayer6_iqomah_duration ?? '3',
        };

        // Initialize clock using shared function
        const timeFormat = praytimes.time_format ?? '24h';

        // Set moment.js language 
        const moment_lang = "id";
        const getDay = moment().format('dddd');

        const format = prayerConfig.time_format === "12h" ? "hh:mm" : "HH:mm";
        const prayerTimeKeys = ['fajr', 'sunrise', 'dhuhr', 'asr', 'maghrib', 'isha'];

        // Calculate prayer times with corrections
        let PT = new PrayTimes(prayerConfig.prayer_calc_method);
        let times = PT.getTimes(new Date(), [prayerConfig.latitude, prayerConfig.longitude], prayerConfig.timezone, prayerConfig.dst, prayerConfig.time_format);

        const prayerTimes = prayerTimeKeys.map((key, index) => {
            const correction = prayerConfig[`prayer${index + 1}_correction`];
            return moment(times[key], format)
                .add(moment.duration(correction, 'minutes'))
                .format(format);
        });

        prayerTimes.forEach((time, index) => {
            $(`#praytimes${index + 1}`).html(time);
        });

        // Update prayer names with Dhuhr alias for Friday
        [1, 2, 3, 4, 5, 6].forEach(i => {
            const value = i === 3
                ? SharedFunctions.getDhuhrAlias(moment().format('dddd'), moment_lang, prayerConfig[`prayer${i}_alias`])
                : prayerConfig[`prayer${i}_alias`];
            $(`#praynames${i}`).html(value);
        });        

        // Initialize image randomizer
        if (typeof window.initImageRandomizer !== 'function') {
            console.error('initImageRandomizer is not defined. Ensure imageRandomizer.js is loaded correctly.');
            return;
        }
        window.imageRandomizer = window.initImageRandomizer('random-image', randomImages, 10000);

        // Initialize clock and countdown using shared functions
        try {
            SharedFunctions.currentClock({ time_format: prayerConfig.time_format });
            currentClockInterval = setInterval(() => SharedFunctions.currentClock({ time_format: prayerConfig.time_format }), 1000);

            const getDay = moment().format('dddd');
            SharedFunctions.praytimesCountDown(prayerConfig, prayerTimes, moment_lang, getDay);
        } catch (error) {
            console.error('Error in initJumbotron:', error);
        }
                
    }

    // Initial call
    initJumbotron();

    // Re-init after Livewire updates
    document.addEventListener('livewire:initialized', function () {
        Livewire.hook('morphed', ({ el, component }) => {
            initJumbotron();
            console.log('Livewire morphed - jumbotron re-init complete');
        });
    });

</script>