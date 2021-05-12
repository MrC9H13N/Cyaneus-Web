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
                title: 'Révisions d\'infographie',
                start: '2021-05-12 09:30',
                end: '2021-05-12 10:30',
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