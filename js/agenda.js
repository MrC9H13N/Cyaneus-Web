//Permet de charger le calendrier et ses paramètres
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
        events: events,
        dayHeaderContent: (args) => {
            moment.locale("fr");
            let day = moment(args.date).format('dddd Do');
            return day.charAt(0).toUpperCase() + day.slice(1);
        }
    });
    calendar.render();
});