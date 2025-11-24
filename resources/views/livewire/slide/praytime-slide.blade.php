<div wire:poll.300s="loadData" class="h-screen w-full">
    <!-- Change to 300s in production -->
    <div id="app-config" style="display: none;"
        data-profile='@json(array_merge($profile, ["logo_url" => $profile["file_name"] ? asset("storage/" . $profile["file_name"]) : asset("storage/images/upload/default-logo.png")]))'
        data-praytimes='@json($praytimes)' data-random-images='@json($randomImages ?? [])'
        data-tickertext='@json($tickerText)'>
    </div>

    <x-layouts.preloader />

    @include('livewire.praytimes.themes.'.$profile['selected_theme'], ['videoPath' => $videoPath])

</div>

<script src="{{ asset('storage/dist/praytimes/PrayTimes.js') }}"></script>
<script src="{{ asset('storage/dist/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('storage/dist/moment/moment-with-locales.js') }}"></script>
<script src="{{ asset('storage/dist/moment-hijri/moment-hijri.js') }}"></script>
<script src="{{ asset('storage/dist/imageRandomizer/imageRandomizer.js') }}"></script>
<script src="{{ asset('storage/dist/sharedFunctions.js') }}"></script>

<script>
    // Declare intervals globally to persist across re-inits
    let currentClockInterval;
    let startCountDownInterval;

    function initPrayTimes() {
        // Clear existing intervals first to prevent duplicates/leaks
        clearInterval(currentClockInterval);
        clearInterval(startCountDownInterval);

        // Read dynamic data from DOM (updated after each poll/morph)
        const configElement = document.getElementById('app-config');
        if (!configElement) {
            console.error('Config element not found');
            return;
        }
        
        let profile, praytimes, randomImages, tickerText;
        try {
            profile = JSON.parse(configElement.dataset.profile) || {};
            praytimes = JSON.parse(configElement.dataset.praytimes) || {};
            randomImages = JSON.parse(configElement.dataset.randomImages) || [];
            tickerText = JSON.parse(configElement.dataset.tickertext) || 'No active announcements';
        } catch (error) {
            console.error('Error parsing app-config JSON:', error);
            return;
        }

        // Debug logo_url
        console.log('Logo URL:', profile.logo_url);

        // Map to prayerConfig (with defaults)
        let prayerConfig = {
            prayer_calc_method: praytimes.prayer_calc_method ?? 'Kemenag',
            latitude: praytimes.latitude ?? '3.67026',
            longitude: praytimes.longitude ?? '98.59399',
            timezone: praytimes.timezone ?? '7',
            dst: praytimes.dst ?? '0',
            time_format: praytimes.time_format ?? '24h',
            hijri_correction: praytimes.hijri_correction ?? '0',
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

        // Set moment.js language
        let moment_lang = "id";
        moment.locale(moment_lang); 

        const format = prayerConfig.time_format === "12h" ? "hh:mm" : "HH:mm";            
        const prayerTimeKeys = ['fajr', 'sunrise', 'dhuhr', 'asr', 'maghrib', 'isha'];

        // Praytimes config
        let PT = new PrayTimes(prayerConfig.prayer_calc_method);
        let times = PT.getTimes(new Date(), [ prayerConfig.latitude , prayerConfig.longitude ], prayerConfig.timezone, prayerConfig.dst, prayerConfig.time_format);

        // Get current day name, masehi and hijri date
        let getDay = moment().format('dddd');            
        let getMasehiDate = moment_lang == "en" ? moment().format('MMMM Do, YYYY') : moment().format('Do MMMM YYYY');
        let getHijriDate = moment().add(prayerConfig.hijri_correction, 'days').format('iD iMMMM iYYYY');

        // Add praytimes and manual correction 
        const prayerTimes = prayerTimeKeys.map((key, index) => {
            const correction = prayerConfig[`prayer${index + 1}_correction`];
            return moment(times[key], format)
                .add(moment.duration(correction, 'minutes'))
                .format(format);
        });

        //-----------------Pass variable to HTML-----------------//
        $("#current_date").html(
            `${getDay}, ${getMasehiDate}/ ${getHijriDate} H`
        );
        
        $("#name").html(profile.name ?? 'Your Masjiid');
        $("#address").html(profile.address ?? 'Type your address here');
        $("#description").html(profile.description ?? 'Add your description here');
        $("#logo").attr("src", profile.logo_url || 'http://localhost:8000/storage/images/upload/default-logo.png');
        
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

        $("#running-text").fadeOut(300, function() {
           $(this).html(tickerText).fadeIn(300);
        });
        
        let contact = `
            <span>
                <a href="#" class="inline-flex items-center text-white text-xs md:text-sm tracking-wide space-x-1 ml-1">                                                      
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#fff"
                        stroke-width="1"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        <path d="M15 7a2 2 0 0 1 2 2" />
                        <path d="M15 3a6 6 0 0 1 6 6" />
                    </svg>
                    <span>${profile.contact_no ?? 'Support : 0811.6077.81'}</span>
                </a>
            </span>
        `;
        $("#contact_no").html(contact);
        
        // Initialize image randomizer
        if (typeof window.initImageRandomizer !== 'function') {
            console.error('initImageRandomizer is not defined. Ensure imageRandomizer.js is loaded correctly.');
            return;
        }
        window.imageRandomizer = window.initImageRandomizer('random-image', randomImages, 15000);

        $('.highlight-me').each(function () {
            let text = $(this).text().trim();
            let words = text.split(' ');
            if (words.length > 0) {
                let firstWord = words.shift();
                let remainingText = words.join(' ');
                $(this).html('<span class="first-word">' + firstWord + '</span> ' + remainingText);
            }
        });

        try {
           SharedFunctions.currentClock({ time_format: prayerConfig.time_format });
            currentClockInterval = setInterval(() => SharedFunctions.currentClock({ time_format: prayerConfig.time_format }), 1000);

            const getDay = moment().format('dddd');
            SharedFunctions.praytimesCountDown(prayerConfig, prayerTimes, moment_lang, getDay);
            
            console.log('initPrayTimes completed successfully');
        } catch (error) {
            console.error('Error in initPrayTimes:', error);
        }
    }

    // Initial call
    initPrayTimes();

    // Re-init after Livewire updates
    document.addEventListener('livewire:initialized', function () {
        Livewire.hook('morphed', ({ el, component }) => {
            initPrayTimes();
            console.log('Livewire morphed - re-init complete');
        });
    });
    
</script>