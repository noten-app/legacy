// Load calendars

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar_list');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next',
            right: 'title'
        },
        initialView: 'listMonth',
        navLinks: false,
        editable: true,
        dayMaxEvents: true,
        locale: "en",
        events: cal_events
    });
    calendar.render();
});
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar_grid');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next',
            right: 'title'
        },
        navLinks: false,
        editable: true,
        dayMaxEvents: true,
        showNonCurrentDates: true,
        hiddenDays: [0, 6],
        locale: "en",
        events: cal_events,
        nowIndicator: true,
        eventClick: function(info) {
            alert('Event: ' + JSON.stringify(info.event.id));
        }
    });
    calendar.render();
});