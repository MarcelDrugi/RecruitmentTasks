window.addEventListener('DOMContentLoaded', function() {
    setInterval(() => {
        let yearInput = (document.getElementById('counter-year-input') || 1).value;
        let monthInput = (document.getElementById('counter-month-input') || 1).value;
        let dayInput = (document.getElementById('counter-day-input') || 1).value;
        let hourInput = (document.getElementById('counter-hour-input') || 0).value;
        let minuteInput = (document.getElementById('counter-minute-input') || 0).value;
        let secondInput = (document.getElementById('counter-second-input') || 0).value;

        monthInput = monthValidation(monthInput);
        dayInput = dayValidation(dayInput, monthInput, yearInput);
        yearInput = yearValidation(yearInput);

        const current = new Date();
        const dateString = yearInput + '-' + formatDigits(monthInput) + '-' + formatDigits(dayInput) + 'T' + formatDigits(hourInput) + ':' + formatDigits(minuteInput) + ':' + formatDigits(secondInput);
        const draw = new Date(dateString);
        const secondsDiff = parseInt((draw.getTime() - current.getTime()) / 1000);
        const labelHours = document.getElementById('hours-label').textContent.trim()
        const labelMinutes = document.getElementById('minutes-label').textContent.trim()
        const labelSeconds = document.getElementById('seconds-label').textContent.trim()

        let seconds = formatDigits(secondsDiff % 60);
        let minutes = formatDigits((secondsDiff / 60) % 60);
        let hours = formatDigits((secondsDiff / 3600) % 24);
        let days = formatDigits(secondsDiff / 86400);
        if (secondsDiff < 86400) {
            if (labelHours == 'days')  {
                const label = document.getElementById('hours-label').textContent = 'hours'
            }
            if (labelMinutes == 'hours')  {
                const label = document.getElementById('minutes-label').textContent = 'minutes'
            }
            if (labelSeconds == 'minutes')  {
                const label = document.getElementById('seconds-label').textContent = 'seconds'
            }
            document.getElementById('counter-number-seconds').textContent = seconds;
            document.getElementById('counter-number-minutes').textContent = minutes;
            document.getElementById('counter-number-hours').textContent = hours;
        } else {
            if (labelHours == 'hours')  {
                const label = document.getElementById('hours-label').textContent = 'days'
            }
            if (labelMinutes == 'minutes')  {
                const label = document.getElementById('minutes-label').textContent = 'hours'
            }
            if (labelSeconds == 'seconds')  {
                const label = document.getElementById('seconds-label').textContent = 'minutes'
            }
            document.getElementById('counter-number-seconds').textContent = minutes;
            document.getElementById('counter-number-minutes').textContent = hours;
            document.getElementById('counter-number-hours').textContent = days;
        }

    }, 1000);

    const formatDigits = (seconds) => {
        seconds = parseInt(seconds);
        if (seconds < 1) {
            return '00';
        } else if (seconds < 10) {
            return '0' + seconds
        }
        return seconds
    }

    const monthValidation = (month) => {
        if (month == 0) {
            document.getElementById('counter-month-input').value = '01';
            return 1;
        } else if (month > 12) {
            document.getElementById('counter-month-input').value = '12'
            return 12;
        }
        return month;
    }

    const dayValidation = (day, month, year) => {
        if (day == 0) {
            document.getElementById('counter-day-input').value = '01';
            return 1;
        } else {
            if ([1, 3, 5, 7, 8, 10, 12].includes(month) && day > 31) {
                document.getElementById('counter-day-input').value = '31';
                return 31
            }
            if ([4, 6, 9, 11].includes(month) && day > 30) {
                document.getElementById('counter-day-input').value = '30';
                return 30
            }
            if (day > 29 && month == 2 && year % 4 === 0) {
                document.getElementById('counter-day-input').value = '29';
                return 29;
            }
            if (day > 28 && month == 2 && year % 4 !== 0) {
                document.getElementById('counter-day-input').value = '28';
                return 28;
            }

            return day;
        }
    }

    const yearValidation = (year) => {
         if (year < 1001) {
             document.getElementById('counter-year-input').value = '1001';
             return 1001;
         } else if (year > 9999) {
             document.getElementById('counter-year-input').value = '9999';
             return 9999;
         }
         return year;
    }
});