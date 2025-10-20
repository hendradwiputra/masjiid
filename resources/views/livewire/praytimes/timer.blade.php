<div class="h-screen w-full flex items-center justify-center gap-4 bg-gradient-to-b from-stone-900 to bg-stone-500">

    <x-layouts.preloader />

    <!-- Countdown -->
    <div id="countdown">
        <div class="flex flex-col text-stone-200 text-center text-shadow-lg">
            <div class="text-4xl lg:text-6xl tracking-wide font-bold text-amber-50" id="countdown_title"></div>
            <div class="text-7xl lg:text-[11em] tracking-tight font-extrabold bg-gradient-to-r from-amber-100 via-amber-400 to-amber-700 inline-block text-transparent bg-clip-text"
                id="countdown_prayername">
            </div>
            <div class="tabular-nums font-bold text-9xl lg:text-[23em] bg-gradient-to-r from-amber-50 via-gray-100 to-amber-50 inline-block text-transparent bg-clip-text"
                id="countdown_time"></div>
        </div>
    </div>
    <!-- End of Countdown -->

    <!-- Screenlock -->
    <div id="screenlock" class="absolute inset-0">
        <img src="{{ asset('storage/images/pattern/pattern1.webp') }}" alt="background"
            class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-shadow-lg">
            <div class="flex font-bold text-slate-800 items-center lg:text-6xl mb-2" id="screenlock_caption"></div>
            <div class="uppercase font-extrabold text-5xl lg:text-[11em] text-shadow-lg bg-gradient-to-r from-amber-500 via-amber-700 to-amber-900 inline-block text-transparent bg-clip-text pb-3"
                id="screenlock_title"></div>
            <div class="flex font-bold items-center tabular-nums bg-gradient-to-r from-stone-800 to bg-stone-400 border-5 shadow-xl text-white uppercase text-5xl lg:text-7xl text-shadow-lg gap-3 px-10 py-3 rounded-full"
                id="screenlock_clock"></div>
        </div>
    </div>
    <!-- End of screenlock -->
</div>

<script src="{{ asset('storage/dist/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('storage/dist/moment/moment-with-locales.js') }}"></script>
<script>
    moment.locale('en');
        // hide all element
        $("#countdown, #screenlock").hide();
        
        const params = new URLSearchParams(window.location.search);

        let nextPrayerName = params.get("name").toLowerCase();
        let nextPrayerTime = params.get("time");        
        let adhan = params.get("adhan");
        let iqomah = params.get("iqomah");

        let prayerConfig = {            
            sunrise_lock_duration: "{{ $praytimes['sunrise_lock_duration'] }}",            
            jumuah_lock_duration: "{{ $praytimes['jumuah_lock_duration'] }}",
            prayer_lock_duration: "{{ $praytimes['prayer_lock_duration'] }}"            
        };

        let notification = {
            before_adhan_caption: "{{ Str::title($notification['before_adhan_caption']) }}",
            adhan_caption: "{{ Str::title($notification['adhan_caption']) }}",
            iqomah_caption: "{{ Str::title($notification['iqomah_caption']) }}",
            sunrise_caption: "{{ Str::title($notification['sunrise_caption']) }}",
            prayer_caption: "{{ Str::title($notification['prayer_caption']) }}",
            jumuah_caption: "{{ Str::title($notification['jumuah_caption']) }}"
        };

        datetime = moment().format('MMM D, YYYY');

        const countDownDate = moment(datetime + " " + nextPrayerTime, "MMM D, YYYY HH:mm").valueOf();

        const clock_icon = `<svg
                                width="64"
                                height="64"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#fff"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 12l-2 3" />
                                <path d="M12 7v5" />
                            </svg>`

        const beep = new Audio('{{ asset("storage/sounds/beep.mp3") }}');

        // Start countdown
        const countdownInterval = setInterval(function() {

            let now = new Date().getTime();
            let distance = countDownDate - now;
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            seconds = twoDigit(seconds);
            const before_adhan_caption = notification.before_adhan_caption;

            $("#countdown").show();
            $("#countdown_title").html(`${before_adhan_caption}`);    
            $("#countdown_prayername").html(`${nextPrayerName.toUpperCase()}`);
            $("#countdown_time").html(seconds);
            
            // Trigger beep
            if (parseInt(seconds) <= 5 && parseInt(seconds) >= 1) {
                beep.play();
            }
            
            const sunrise_alias = ["sunrise", "syuruq", "syuruk", "terbit"];

            if (sunrise_alias.includes(nextPrayerName)) {    
                
                const sunrise_caption = notification.sunrise_caption;
                const screenlock_clock = `${clock_icon}${nextPrayerTime}-${moment(nextPrayerTime, "HH:mm").add(moment.duration(prayerConfig.sunrise_lock_duration, 'minutes')).format("HH:mm")}`;

                $("#screenlock").show();
                $("#screenlock_caption").html(sunrise_caption);
                $("#screenlock_title").html(nextPrayerName);    
                $("#screenlock_clock").html(screenlock_clock);           
                $("#countdown").hide();   

                const sunrise_lock_duration = prayerConfig.sunrise_lock_duration;

                setTimeout(function() {

                    location.href = `${window.location.origin}`;

                }, Number(sunrise_lock_duration) * 60000);

            } else {
                if (distance <= 1000) {

                    clearInterval(countdownInterval);
                    $("#countdown_title").html("");
                    $("#countdown_prayername").html("");
                    $("#countdown_time").html("");
                    
                    $("#countdown").show();
                    $("#screenlock").hide();
                    
                    nextPrayerTime = moment(nextPrayerTime, "HH:mm").add(moment.duration(adhan, 'minutes')).format("HH:mm");

                    datetime = moment().format('MMM D, YYYY');

                    const countDownDate = moment(datetime + " " + nextPrayerTime, "MMM D, YYYY HH:mm").valueOf();

                    // Adhan countdown
                    const adhanCountdownInterval = setInterval(function() {

                        let now = new Date().getTime();
                        let distance = countDownDate - now;
                        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                        minutes = twoDigit(minutes);
                        seconds = twoDigit(seconds);

                        let adhan_caption = notification.adhan_caption;

                        $("#countdown_title").html(`${adhan_caption}`);    
                        $("#countdown_prayername").html(`${nextPrayerName.toUpperCase()}`);
                                               
                        if (minutes == 0) {
                            $("#countdown_time").html(seconds);
                        } else {
                            $("#countdown_time").html(`${minutes}:${seconds}`);
                        }
                        
                        if (distance <= 1000) {
                            clearInterval(adhanCountdownInterval);       

                            $("#countdown_title").html("");
                            $("#countdown_prayername").html("");
                            $("#countdown_time").html("");

                            const dhuhr_alias = ["jumuah", "jumat", "jumaat"];

                            if (dhuhr_alias.includes(nextPrayerName)) {

                                const jumuah_caption = notification.jumuah_caption;

                                $("#screenlock").show();
                                $("#screenlock_caption").html(jumuah_caption);
                                $("#screenlock_title").html(nextPrayerName);
                                $("#countdown").hide();   
                                
                                currentClock();
                                setInterval(currentClock, 1000);  

                                const jumuah_lock_duration = prayerConfig.jumuah_lock_duration;

                                setTimeout(function() {                                    
                                    
                                    location.href = `${window.location.origin}`;

                                }, Number(jumuah_lock_duration) * 60000);

                            } else {

                                nextPrayerTime = moment(nextPrayerTime, "HH:mm").add(moment.duration(iqomah, 'minutes')).format("HH:mm");

                                datetime = moment().format('MMM D, YYYY');
                                
                                const countDownDate = moment(datetime + " " + nextPrayerTime, "MMM D, YYYY HH:mm").valueOf();

                                // Iqomah countdown
                                const iqomahCountdownInterval = setInterval(function() {

                                    let now = new Date().getTime();
                                    let distance = countDownDate - now;
                                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    
                                    minutes = twoDigit(minutes);
                                    seconds = twoDigit(seconds);

                                    let iqomah_caption = notification.iqomah_caption;
                                    $("#countdown_title").html(`${iqomah_caption}`);
                                    $("#countdown_prayername").html(`IQOMAH`);

                                    if (minutes == 0) {
                                        $("#countdown_time").html(seconds);
                                    } else {
                                        $("#countdown_time").html(`${minutes}:${seconds}`);
                                    }

                                    // Trigger beep
                                    if (minutes == "00" && parseInt(seconds) <= 5 && parseInt(seconds) >= 1) {
                                        beep.play();
                                    }

                                    if (distance <= 1000) {
                                        clearInterval(iqomahCountdownInterval);

                                        const prayer_caption = notification.prayer_caption;

                                        $("#countdown_title").html("");
                                        $("#countdown_prayername").html("");
                                        $("#countdown_time").html(""); 
                                        $("#screenlock").show();
                                        $("#screenlock_caption").html(prayer_caption);
                                        $("#screenlock_title").html(nextPrayerName);
                                        
                                        currentClock();
                                        setInterval(currentClock, 1000);  

                                        const prayer_lock_duration = prayerConfig.prayer_lock_duration;

                                        setTimeout(function() {
                                            
                                            location.href = `${window.location.origin}`;

                                        }, Number(prayer_lock_duration) * 60000);
                                    }

                                }, 1000);

                            }
                                                        
                        }
                    }, 1000);  
                }
            }
        }, 1000);

        function twoDigit(i) {
            if (i < 10) { i = "0" + i };
            return i;
        }

        function currentClock() {            

            $("#screenlock_clock").html(
                `${moment().format('hh:mm a')}`
            );
        } 

</script>

</div>