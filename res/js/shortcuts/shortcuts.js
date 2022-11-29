// Key stroke listener

var shortcuts = {
    "alt+t": function() {
        cycleTheme();
    },
    "alt+s": function() {
        window.location.href = "/home/";
    },
    "alt+k": function() {
        window.location.href = "/calendar/";
    },
    "alt+h": function() {
        window.location.href = "/homework/";
    },
    "alt+p": function() {
        window.location.href = "/planner/";
    },
    "alt+c": function() {
        window.location.href = "/classes/";
    }
}

onkeydown = function(e) {
    var key = e.key.toLowerCase();
    if (e.altKey) {
        key = "alt+" + key;
    }
    if (e.shiftKey) {
        key = "shift+" + key;
    }
    if (e.ctrlKey) {
        key = "ctrl+" + key;
    }
    if (shortcuts[key]) {
        shortcuts[key]();
    }
}