// Config
const cal_config = {
    headerToolbar: {
        left: 'prev,next',
        right: 'title'
    },
    navLinks: false,
    editable: true,
    dayMaxEvents: true,
    locale: "en",
    events: cal_events,
    nowIndicator: true
};

// Load calendars

grid_calendar = undefined;
list_calendar = undefined;

document.addEventListener('DOMContentLoaded', function() {
    list_calendar = new FullCalendar.Calendar(document.getElementById('calendar_list'), {
        initialView: 'listMonth',
        eventClick: function(info) {
            calClick(list_calendar, info.event);
        },
        dateClick: function(info) {
            dateClick(list_calendar, info.dateStr);
        }
    });
    grid_calendar = new FullCalendar.Calendar(document.getElementById('calendar_grid'), {
        showNonCurrentDates: true,
        hiddenDays: [0, 6],
        eventClick: function(info) {
            calClick(grid_calendar, info.event);
        },
        dateClick: function(info) {
            dateClick(grid_calendar, info.dateStr);
        }
    });
    for (var key in cal_config) {
        list_calendar.setOption(key, cal_config[key]);
        grid_calendar.setOption(key, cal_config[key]);
    }
    list_calendar.render();
    grid_calendar.render();
});

// Functions
function calClick(calendar, event) {
    alert('Event: ' + event.id);
    alert('Cal: ' + calendar);
}

function dateClick(calendar, date) {
    alert('Date: ' + date);
    alert('Cal: ' + calendar);
}