document.addEventListener('DOMContentLoaded', function() {
    //FullCalendar library - https://fullcalendar.io/
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        allDaySlot: false,
        locale :'fr',
        height: "40vw",
        eventDisplay:"block",
        slotMinTime:"08:00:00",
        slotMaxTime:"20:00:00",
        displayEventTime: true,
        events: [
            {
                title: 'Cours d\'automatique',
                start: '2021-06-21 08:00',
                end: '2021-06-21 10:05',
            },
            {
                title: 'Cours de nanosciences',
                start: '2021-06-21 10:20',
                end: '2021-06-21 12:25',
            },
            {
                title: 'Anglais',
                start: '2021-06-21 13:30',
                end: '2021-06-21 15:35',
            },
            {
                title: 'Cours d\'automatique',
                start: '2021-06-22 08:00',
                end: '2021-06-22 10:05',
            },
            {
                title: 'Analyse des signaux et des images',
                start: '2021-06-22 10:20',
                end: '2021-06-22 12:20',
            },
            {
                title: 'TP d\'électronique',
                start: '2021-06-23 13:30',
                end: '2021-06-23 17:45',
            },
            {
                title: 'Cours d\'automatique',
                start: '2021-06-24 10:20',
                end: '2021-06-24 12:25',
            },
            {
                title: 'Cours de nanosciences',
                start: '2021-06-25 08:00',
                end: '2021-06-25 10:05',
            },
            {
                title: 'Analyse des signaux et des images',
                start: '2021-06-25 10:20',
                end: '2021-06-25 12:25',
            },
            {
                title: 'TD d\'Analyse des signaux et des images',
                start: '2021-06-25 15:50',
                end: '2021-06-25 17:55',
            },
            {
                title: 'Cours d\'automatique',
                start: '2021-06-28 08:00',
                end: '2021-06-28 10:05',
            },
            {
                title: 'Cours de nanosciences',
                start: '2021-06-28 10:20',
                end: '2021-06-28 12:25',
            },
            {
                title: 'Anglais',
                start: '2021-06-28 13:30',
                end: '2021-06-28 15:35',
            },
            {
                title: 'Cours d\'automatique',
                start: '2021-06-29 08:00',
                end: '2021-06-29 10:05',
            },
            {
                title: 'Analyse des signaux et des images',
                start: '2021-06-29 10:20',
                end: '2021-06-29 12:20',
            },
            {
                title: 'TP d\'électronique',
                start: '2021-06-30 13:30',
                end: '2021-06-30 17:45',
            },
            {
                title: 'Cours d\'automatique',
                start: '2021-07-01 10:20',
                end: '2021-07-01 12:25',
            },
            {
                title: 'Cours de nanosciences',
                start: '2021-07-02 08:00',
                end: '2021-07-02 10:05',
            },
            {
                title: 'Analyse des signaux et des images',
                start: '2021-07-02 10:20',
                end: '2021-07-02 12:25',
            },
            {
                title: 'TD d\'Analyse des signaux et des images',
                start: '2021-07-02 15:50',
                end: '2021-07-02 17:55',
            },

        ],
        dayHeaderContent: (args) => {
            moment.locale("fr");
            let day = moment(args.date).format('dddd Do');
            return day.charAt(0).toUpperCase() + day.slice(1);
        }
    });
    calendar.render();
});