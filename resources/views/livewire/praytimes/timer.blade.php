</div>
<div class="h-screen w-full flex items-center justify-center gap-4 bg-gradient-to-b from-stone-900 to bg-stone-400">

    <!-- Countdown -->
    <div id="countdown">
        <div class="w-auto p-10 text-stone-200 text-center text-shadow-lg">
            <div class="font-mavenpro font-extrabold tracking-wide text-xl lg:text-8xl uppercase" id="countdown_title">
            </div>
            <div class="font-montserrat tabular-nums font-bold text-7xl lg:text-[23em] leading-none"
                id="countdown_time"></div>
        </div>
    </div>
    <!-- End of Countdown -->

    <!-- Screenlock -->
    <div id="screenlock" class="absolute inset-0">
        <img src="{{ asset('storage/images/pattern/pattern1.webp') }}" alt="background"
            class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-shadow-lg">
            <div class="flex font-mavenpro font-bold text-slate-800 items-center lg:text-6xl mb-2"
                id="screenlock_caption"></div>
            <div class="font-montserrat uppercase font-extrabold text-5xl lg:text-[11em] text-shadow-lg bg-gradient-to-r from-gray-900 via-teal-700 to-gray-800 inline-block text-transparent bg-clip-text pb-3"
                id="screenlock_title"></div>
            <div class="flex font-montserrat font-bold items-center tabular-nums tracking-wide bg-gradient-to-r from-teal-900 to bg-teal-600 border-5 shadow-xl text-white uppercase text-5xl lg:text-7xl text-shadow-lg gap-3 px-10 py-3 rounded-full"
                id="screenlock_clock"></div>
        </div>
    </div>
    <!-- End of screenlock -->

    <!-- Copyright -->
    <div class="fixed inset-x-0 bottom-0 z-50">
        <div class="flex justify-end">
            <img src="{{ asset('storage/images/icon/masjiid.png') }}" alt="logo" class="h-10 px-2 mb-2">
        </div>
    </div>
    <!-- End of Copyright -->
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
            sunrise_caption: "{{ Str::title($praytimes['sunrise_caption']) }}",
            prayer_caption: "{{ Str::title($praytimes['prayer_caption']) }}",
            sunrise_lock_duration: "{{ $praytimes['sunrise_lock_duration'] }}",            
            jumuah_lock_duration: "{{ $praytimes['jumuah_lock_duration'] }}",
            prayer_lock_duration: "{{ $praytimes['prayer_lock_duration'] }}",
            adhan_caption: "{{ $praytimes['adhan_caption'] }}",
            iqomah_caption: "{{ $praytimes['iqomah_caption'] }}"
        };

        datetime = moment().format('MMM D, YYYY');

        const countDownDate = moment(datetime + " " + nextPrayerTime, "MMM D, YYYY HH:mm").valueOf();

        const clock_icon = `<svg
                                xmlns="http://www.w3.org/2000/svg"
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

            $("#countdown").show();
            $("#countdown_time").html(seconds);

            // Trigger beep
            if (parseInt(seconds) <= 5 && parseInt(seconds) >= 1) {
                beep.play();
            }
            
            const sunrise_alias = ["sunrise", "syuruq", "syuruk", "terbit"];

            if (sunrise_alias.includes(nextPrayerName)) {    
                
                const sunrise_caption = prayerConfig.sunrise_caption;
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

                        let adhan_caption = prayerConfig.adhan_caption;

                        $("#countdown_title").html(
                            `${adhan_caption}<span class='ml-5'>${nextPrayerName}</span>`
                        );
                                               
                        if (minutes == 0) {
                            $("#countdown_time").html(seconds);
                        } else {
                            $("#countdown_time").html(`${minutes}:${seconds}`);
                        }
                        
                        if (distance <= 1000) {
                            clearInterval(adhanCountdownInterval);       

                            $("#countdown_title").html("");
                            $("#countdown_time").html("");

                            const dhuhr_alias = ["jumuah", "jumat", "jumaat"];

                            if (dhuhr_alias.includes(nextPrayerName)) {

                                const prayer_caption = prayerConfig.prayer_caption;

                                $("#screenlock").show();
                                $("#screenlock_caption").html(prayer_caption);
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

                                    let iqomah_caption = prayerConfig.iqomah_caption;

                                    $("#countdown_title").html(
                                        `${iqomah_caption}`
                                    );

                                    if (minutes == 0) {
                                        $("#countdown_time").html(seconds);
                                    } else {
                                        $("#countdown_time").html(`${minutes}:${seconds}`);
                                    }

                                    // Trigger beep
                                    if (minutes == "00" && parseInt(seconds) <= 6 && parseInt(seconds) >= 1) {
                                        beep.play();
                                    }

                                    if (distance <= 1000) {
                                        clearInterval(iqomahCountdownInterval);

                                        const prayer_caption = prayerConfig.prayer_caption;

                                        $("#countdown_title").html("");
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