// Shared utility functions
window.SharedFunctions = {
    twoDigit(i) {
        return i < 10 ? "0" + i : i;
    },

    getDhuhrAlias(getDay, moment_lang, defaultAlias) {
        let fridayAlias = ["friday", "jumat", "jumaat"];
        let result = fridayAlias.includes(getDay.toLowerCase())
            ? (moment_lang === "id" ? "jumat" : "jumuah")
            : defaultAlias;
        return result.charAt(0).toUpperCase() + result.slice(1);
    },

    currentClock(config = { time_format: "24h" }) {
        let now = new Date();
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let seconds = now.getSeconds();
        let ampm = null;

        moment.locale('en');

        if (config.time_format === "12h") {
            hours = moment().format('h');
            ampm = moment().format('A');
        } else {
            hours = moment().format('H');
        }

        $("#clock").html(`${this.twoDigit(hours)}:${this.twoDigit(minutes)}`);
        $("#seconds").html(this.twoDigit(seconds));
        $("#ampm").html(ampm);
    },

    praytimesCountDown(prayerConfig, prayerTimes, moment_lang, getDay) {
        // Clear existing countdown interval
        if (window.startCountDownInterval) {
            clearInterval(window.startCountDownInterval);
        }

        let currentClock = moment().hours() * 60 + moment().minutes();

        const prayerMinutes = prayerTimes.map((time, index) => {
            if (prayerConfig.time_format === "12h") {
                return index <= 1
                    ? moment(time + ' AM', 'h:mm A').hours() * 60 + moment(time + ' AM', 'h:mm A').minutes()
                    : moment(time + ' PM', 'h:mm A').hours() * 60 + moment(time + ' PM', 'h:mm A').minutes();
            } else {
                return moment(time, 'HH:mm').hours() * 60 + moment(time, 'HH:mm').minutes();
            }
        });

        // Update prayer names in the DOM
        [1, 2, 3, 4, 5, 6].forEach(i => {
            const value = i === 3
                ? this.getDhuhrAlias(getDay, moment_lang, prayerConfig[`prayer${i}_alias`])
                : prayerConfig[`prayer${i}_alias`];
            const element = $(`#praynames${i}`);
            if (element.length) {
                element.html(value);
            } /*else {
                console.warn(`Element #praynames${i} not found in DOM`);
            }*/
        });

        const [getPrayer1, getPrayer2, getPrayer3, getPrayer4, getPrayer5, getPrayer6] = prayerMinutes;

        $(".selected").removeClass("selected");

        let nextPrayIndex = -1;
        let nextPrayName = '';
        let nextPrayTime = '';
        let iqomah_duration = 0;
        
        for (let i = 0; i < prayerMinutes.length; i++) {
            if (currentClock <= prayerMinutes[i]) {
                nextPrayIndex = i;
                nextPrayName = i === 2
                    ? this.getDhuhrAlias(getDay, moment_lang, prayerConfig[`prayer${i+1}_alias`])
                    : prayerConfig[`prayer${i+1}_alias`];

                try {
                    if (prayerConfig.time_format === "12h") {
                        nextPrayTime = i <= 1
                            ? moment(`${prayerTimes[i]} AM`, 'h:mm A').format('HH:mm')
                            : moment(`${prayerTimes[i]} PM`, 'h:mm A').format('HH:mm');
                    } else {
                        nextPrayTime = prayerTimes[i];
                    }
                } catch (error) {
                    console.error(`Error formatting nextPrayTime for index ${i}:`, error);
                    nextPrayTime = prayerTimes[i]; // Fallback
                }

                iqomah_duration = (i+1 === 2) ? 0 : (parseInt(prayerConfig[`prayer${i+1}_iqomah_duration`]) || 0);
                $(`#${i+1}`).addClass("selected");
                break;
            }
        }
        
        if (nextPrayIndex === -1) {
            nextPrayIndex = 0;
            nextPrayName = prayerConfig.prayer1_alias;
            try {
                nextPrayTime = prayerConfig.time_format === "12h"
                    ? moment(`${prayerTimes[0]} AM`, 'h:mm A').format('HH:mm')
                    : prayerTimes[0];
            } catch (error) {
                console.error('Error formatting nextPrayTime for Fajr:', error);
                nextPrayTime = prayerTimes[0];
            }
            $("#1").addClass("selected");
        }

        let adhan_duration = parseInt(prayerConfig.adhan_duration) || 5;
        const useTomorrow = currentClock > prayerMinutes[5];
        
        let countDownDate;
        try {
            const [targetHours, targetMinutes] = nextPrayTime.split(':').map(Number);
            if (isNaN(targetHours) || isNaN(targetMinutes)) {
                throw new Error(`Invalid nextPrayTime format: ${nextPrayTime}`);
            }
            countDownDate = moment()
                .startOf('day')
                .add(useTomorrow ? 1 : 0, 'days')
                .hours(targetHours)
                .minutes(targetMinutes)
                .seconds(0)
                .toDate()
                .getTime();
            console.log(`countDownDate for ${nextPrayName}:`, new Date(countDownDate));
        } catch (error) {
            console.error('Error calculating countDownDate:', error);
            return; // Exit to prevent infinite loop
        }
        
        window.startCountDownInterval = setInterval(() => {
            try {
                const now = new Date().getTime();
                const distance = countDownDate - now;
                //console.log(`Distance for ${nextPrayName}: ${distance}ms`);

                const hours = Math.max(0, Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                const minutes = Math.max(0, Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
                const seconds = Math.max(0, Math.floor((distance % (1000 * 60)) / 1000));

                const nextPrayElement = $("#nextPrayName");
                if (nextPrayElement.length) {
                    nextPrayElement.html(
                        `${nextPrayName} - <strong>${this.twoDigit(hours)}:${this.twoDigit(minutes)}:${this.twoDigit(seconds)}</strong>`
                    );
                } else {
                    console.warn('Element #nextPrayName not found in DOM');
                }

                if (distance <= 60000) { // 60.000 ms = 60 sec
                    clearInterval(window.startCountDownInterval);
                    const params = new URLSearchParams({
                        name: nextPrayName,
                        time: nextPrayTime,
                        adhan: adhan_duration.toString(),
                        iqomah: iqomah_duration.toString()
                    });
                    const redirectUrl = `${window.location.origin}/timer/?${params.toString()}`;
                    console.log('Redirecting to:', redirectUrl);
                    window.location.href = redirectUrl; // Use window.location.href for clarity
                }

                if (distance < 0) {
                    clearInterval(window.startCountDownInterval);
                    const loadingElement = $("#nextPrayName");
                    if (loadingElement.length) {
                        loadingElement.html(`loading...`);
                    }
                    console.log('Countdown reached negative distance, restarting...');
                    setTimeout(() => this.praytimesCountDown(prayerConfig, prayerTimes, moment_lang, moment().format('dddd')), 1000);
                }
            } catch (error) {
                console.error('Error in countdown interval:', error);
                clearInterval(window.startCountDownInterval);
            }
        }, 1000);
    },

};