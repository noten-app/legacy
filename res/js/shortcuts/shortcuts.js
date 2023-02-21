// Key stroke listener

var shortcuts = {
    "alt+t": function() {
        cycleTheme();
    },
    "alt+s": function() {
        window.location.href = "/";
    },
    "alt+k": function() {
        window.location.href = "/calendar/";
    },
    "alt+h": function() {
        window.location.href = "/homework/";
    },
    "alt+g": function() {
        window.location.href = "/grades/";
    },
    "alt+c": function() {
        window.location.href = "/classes/";
    },
    "alt+,": function() {
        window.location.href = "/settings/";
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