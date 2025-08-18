<div>
    @include('livewire.praytimes.themes.'.$profiles['selected_theme'])
</div>

<script src="{{ asset('storage/dist/praytimes/PrayTimes.js') }}"></script>
<script src="{{ asset('storage/dist/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('storage/dist/moment/moment-with-locales.js') }}"></script>
<script src="{{ asset('storage/dist/moment-hijri/moment-hijri.js') }}"></script>

<script>
    //-------------------- Declare Variable --------------------//
            let prayerConfig = {
                    prayer_calc_method: "{{ $praytimes['prayer_calc_method'] ?? 'Kemenag' }}",
                    latitude: "{{ $praytimes['latitude'] ?? '3.67026' }}",
                    longitude: "{{ $praytimes['longitude'] ?? '98.59399' }}",
                    timezone: "{{ $praytimes['timezone'] ?? '7' }}",
                    dst: "{{ $praytimes['dst'] ?? '0' }}",
                    time_format: "{{ $praytimes['time_format'] ?? '24h' }}",
                    hijri_correction: "{{ $praytimes['hijri_correction'] ?? '0' }}",
                    prayer1_alias: "{{ Str::title($praytimes['prayer1_alias'] ?? 'fajr') }}",
                    prayer2_alias: "{{ Str::title($praytimes['prayer2_alias'] ?? 'sunrise') }}",
                    prayer3_alias: "{{ Str::title($praytimes['prayer3_alias'] ?? 'duhr') }}",
                    prayer4_alias: "{{ Str::title($praytimes['prayer4_alias'] ?? 'asr') }}",
                    prayer5_alias: "{{ Str::title($praytimes['prayer5_alias'] ?? 'maghrib') }}",
                    prayer6_alias: "{{ Str::title($praytimes['prayer6_alias'] ?? 'isha') }}",
                    prayer1_correction: "{{ $praytimes['prayer1_correction'] ?? '0' }}",
                    prayer2_correction: "{{ $praytimes['prayer2_correction'] ?? '0' }}",
                    prayer3_correction: "{{ $praytimes['prayer3_correction'] ?? '0' }}",
                    prayer4_correction: "{{ $praytimes['prayer4_correction'] ?? '0' }}",
                    prayer5_correction: "{{ $praytimes['prayer5_correction'] ?? '0' }}",
                    prayer6_correction: "{{ $praytimes['prayer6_correction'] ?? '0' }}",
                    adhan_duration: "{{ $praytimes['adhan_duration'] ?? '5' }}",
                    prayer1_iqomah_duration: "{{ $praytimes['prayer1_iqomah_duration'] ?? '3' }}",
                    prayer3_iqomah_duration: "{{ $praytimes['prayer3_iqomah_duration'] ?? '3' }}",
                    prayer4_iqomah_duration: "{{ $praytimes['prayer4_iqomah_duration'] ?? '3' }}",
                    prayer5_iqomah_duration: "{{ $praytimes['prayer5_iqomah_duration'] ?? '3' }}",
                    prayer6_iqomah_duration: "{{ $praytimes['prayer6_iqomah_duration'] ?? '3' }}",
            };

            let profile = {
                    name: "{{ Str::title($profiles['name'] ?? 'Your Masjiid') }}",
                    address: "{{ $profiles['address'] ?? 'Type your address here' }}",
                    description: "{{ $profiles['description'] ?? 'Add your description here' }}",
                    logo: "{{ $profiles['logo'] ?? 'mosque.png' }}",
                    contact_no: "{{ $profiles['contact_no'] ?? 'Support : 0811.6077.81' }}"
            };

            // Set moment.js language
            let moment_lang = "id";
            moment.locale(moment_lang); 

            const format = prayerConfig.time_format === "12h" ? "hh:mm" : "HH:mm";            
            const prayerTimeKeys = ['fajr', 'sunrise', 'dhuhr', 'asr', 'maghrib', 'isha']; // load default praytimes from praytimes.js
            
            // Praytimes config
            let PT = new PrayTimes(prayerConfig.prayer_calc_method);
            let times = PT.getTimes(new Date(), [ prayerConfig.latitude , prayerConfig.longitude ], prayerConfig.timezone, prayerConfig.dst, prayerConfig.time_format);

            // Get current day name, masehi and hijri date
            let getDay = moment().format('dddd');            
            let getMasehiDate = moment_lang == "en" ? moment().format('MMMM Do, YYYY') : moment().format('Do MMMM YYYY');
            let getHijriDate = moment().add(prayerConfig.hijri_correction, 'days').format('iD iMMMM iYYYY');

            // Add praytimes and manual correction 
            const prayerTimes = prayerTimeKeys.map((key, index) => {
                const correction = prayerConfig[`prayer${index + 1}_correction`]; // load time correction

                return moment(times[key], format)
                    .add(moment.duration(correction, 'minutes'))
                    .format(format);
            });

            //-----------------Pass variable to HTML-----------------//
            $("#current_date").html(
                `${getDay}, ${getMasehiDate}/ ${getHijriDate} H`
            );
            
            $("#name").html(profile.name);
            $("#address").html(profile.address);
            $("#description").html(profile.description);
            $("#logo").attr("src", profile.logo);
            
            // #praytimes1 to 6
            prayerTimes.forEach((time, index) => {
                $(`#praytimes${index + 1}`).html(time);
            });
            
            // #praynames1 to 6
            [1, 2, 3, 4, 5, 6].forEach(i => {
                const value = i === 3 
                    ? getDhuhrAlias(getDay, moment_lang, prayerConfig[`prayer${i}_alias`]) 
                    : prayerConfig[`prayer${i}_alias`];
                $(`#praynames${i}`).html(value);
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
                                    <span>${profile.contact_no}</span>
                                </a>
                            </span>
                        `

            $("#contact_no").html(contact);

            
            //-------------------- Functions --------------------//

            // Dhuhr alias
            function getDhuhrAlias(getDay, moment_lang, defaultAlias) {
                let fridayAlias = ["friday", "jumat", "jumaat"];
                let result = fridayAlias.includes(getDay.toLowerCase())
                    ? (moment_lang === "id" ? "jumat" : "jumuah")
                    : defaultAlias;
    
                // Capitalize first letter
                return result.charAt(0).toUpperCase() + result.slice(1);
            }

            // Add leading zeros if needed
            function twoDigit(i) {
                return i < 10 ? "0" + i : i;
            }

            // Current clock
            function currentClock() {

                let now = new Date();
                let hours = now.getHours();
                let minutes = now.getMinutes();
                let seconds = now.getSeconds();
                let ampm = null;

                moment.locale('en');
                
                if (prayerConfig.time_format == "12h") {
                    hours = moment().format('h');
                    ampm = moment().format('A');
                } else {
                    hours = moment().format('H');
                }
                
                $("#clock").html(`${twoDigit(hours)}:${twoDigit(minutes)}`);
                $("#seconds").html(twoDigit(seconds));
                $("#ampm").html(ampm);

            }

            // Praytimes countdown
            function praytimesCountDown() {
                let alarm_icon =   `<svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="100%"
                                        height="100%"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#ffffff"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="h-8 lg:h-18 max-w-[30px] max-h-[30px] lg:max-w-[40px] lg:max-h-[40px]"                                        
                                    >
                                        <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M12 10l0 3l2 0" />
                                        <path d="M7 4l-2.75 2" />
                                        <path d="M17 4l2.75 2" />
                                    </svg>`

                // Get current time in minutes (always in 24h format)
                let currentClock = moment().hours() * 60 + moment().minutes();
                
                // Convert prayer times to minutes (always in 24h format)
                const prayerMinutes = prayerTimes.map((time, index) => {
                    // For 12h format, we need to handle AM/PM properly
                    if (prayerConfig.time_format === "12h") {
                        // Fajr and Sunrise should be AM
                        if (index <= 1) {
                            return moment(time + ' AM', 'h:mm A').hours() * 60 + moment(time + ' AM', 'h:mm A').minutes();
                        }
                        // Other prayers are PM
                        else {
                            return moment(time + ' PM', 'h:mm A').hours() * 60 + moment(time + ' PM', 'h:mm A').minutes();
                        }
                    }
                    // For 24h format, direct conversion
                    else {
                        return moment(time, 'HH:mm').hours() * 60 + moment(time, 'HH:mm').minutes();
                    }
                });
                
                const [getPrayer1, getPrayer2, getPrayer3, getPrayer4, getPrayer5, getPrayer6] = prayerMinutes;
                
                // Remove all selected classes first
                $(".selected").removeClass("selected");
                
                // Find the next prayertime
                let nextPrayIndex = -1;
                let nextPrayName = '';
                let nextPrayTime = '';

                // Find next prayertime after the current time
                for (let i = 0; i < prayerMinutes.length; i++) {
                    if (currentClock <= prayerMinutes[i]) {
                        nextPrayIndex = i;
                        nextPrayName = i === 2  // Check if it's Dhuhr (index 2)
                            ? getDhuhrAlias(getDay, moment_lang, prayerConfig[`prayer${i+1}_alias`])
                            : prayerConfig[`prayer${i+1}_alias`];
                        
                        // Get the time in 24h format for countdown
                        if (prayerConfig.time_format === "12h") {
                            nextPrayTime = i <= 1 
                                ? moment(prayerTimes[i] + ' AM', 'h:mm A').format('HH:mm')
                                : moment(prayerTimes[i] + ' PM', 'h:mm A').format('HH:mm');
                        } else {
                            nextPrayTime = prayerTimes[i];
                        }

                        iqomah_duration = (i+1 === 2) ? 0 : (prayerConfig[`prayer${i+1}_iqomah_duration`] || 0);
                        $(`#${i+1}`).addClass("selected");
                        break;
                    }                                    
                }

                // If no prayer found (current time is after Isha), wrap around to Fajr next day
                if (nextPrayIndex === -1) {
                    nextPrayIndex = 0;
                    nextPrayName = prayerConfig.prayer1_alias;
                    nextPrayTime = prayerConfig.time_format === "12h" 
                        ? moment(prayerTimes[0] + ' AM', 'h:mm A').format('HH:mm')
                        : prayerTimes[0];
                    $("#1").addClass("selected");
                }
                
                let adhan_duration = prayerConfig.adhan_duration;
                const useTomorrow = currentClock > prayerMinutes[5];

                // Create countdown target time (always in 24h format)
                const [targetHours, targetMinutes] = nextPrayTime.split(':').map(Number);
                const countDownDate = moment()
                    .startOf('day')
                    .add(useTomorrow ? 1 : 0, 'days')
                    .hours(targetHours)
                    .minutes(targetMinutes)
                    .seconds(0)
                    .toDate()
                    .getTime();
                
                let startCountDown = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = countDownDate - now;
                    
                    const hours = Math.max(0, Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                    const minutes = Math.max(0, Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
                    const seconds = Math.max(0, Math.floor((distance % (1000 * 60)) / 1000));
                    
                    $("#nextPrayName").html(
                        `${alarm_icon}${nextPrayName} - ${twoDigit(hours)}:${twoDigit(minutes)}:${twoDigit(seconds)}`
                    );
                    
                    // Redirect page if remains 50s                    
                    if (distance <= 50000) {  
                        clearInterval(startCountDown);
                        const params = new URLSearchParams({
                            name: nextPrayName,
                            time: nextPrayTime,
                            adhan: adhan_duration,
                            iqomah: iqomah_duration
                        });
                        location.href = `${window.location.origin}/timer/?${params.toString()}`;
                    } 
                    
                    if (distance < 0) {
                        clearInterval(startCountDown);
                        $("#nextPrayName").html(`${alarm_icon}loading...`);
                    }   
                }, 1000);
            }

            // Randomize Image
            $(document).ready(function() {
                // Convert PHP array to JavaScript array
                let images = @json($imagePaths ?? []);

                if(images.length > 0) {
                    let currentIndex = 0;
                    
                    function changeImage() {
                        // Get next image (or first if at end)
                        currentIndex = (currentIndex + 1) % images.length;
                        
                        // Fade transition
                        $('#random-image').fadeOut(300, function() {
                            $(this).attr('src', images[currentIndex]).fadeIn(300);
                        });
                    }
                    
                    // Change immediately and then every 10 seconds
                    setInterval(changeImage, 10000);
                    
                    // Preload all images
                    images.forEach(img => {
                        new Image().src = img;
                    });
                }
            });

            // Styling the first word
            $('.highlight-me').each(function () {
                let text = $(this).text().trim();
                let words = text.split(' ');
                if (words.length > 0) {
                    let firstWord = words.shift(); // Remove first word
                    let remainingText = words.join(' ');
                    $(this).html('<span class="first-word">' + firstWord + '</span> ' + remainingText);
                }
            });

            let currentClockInterval;
            let praytimesCountdownInterval;
            
            currentClock();
            praytimesCountDown();

            currentClockInterval = setInterval(currentClock, 1000);
            praytimesCountdownInterval = setInterval(praytimesCountDown, 1000);

</script>