document.addEventListener('DOMContentLoaded', function() {
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
            { // this object will be "parsed" into an Event Object
                title: 'Révisions d\'infographie', // a property!
                start: '2021-05-12 09:30', // a property!
                end: '2021-05-12 10:30', // a property! ** see important note below about 'end' **
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