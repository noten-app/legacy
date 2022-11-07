var type = "";

function chooseType(lmnt) {
    const type_buttons = document.getElementsByClassName("type_button");
    for (const button of type_buttons) {
        button.style.backgroundColor = "#424242";
    }
    switch (lmnt.id) {
        case "type_button_schriftlich":
            type = "K";
            break;
        case "type_button_muendlich":
            type = "M";
            break;
        case "type_button_sonstiges":
            type = "S";
            break;
    }
    lmnt.style.backgroundColor = "#2b4696"
    checkFinishedState();
}

// 
// 
// 
var grade = undefined;

function chooseGrade(lmnt) {
    const type_buttons = document.getElementsByClassName("grade_button");
    for (const button of type_buttons) {
        button.style.backgroundColor = "#424242";
    }
    var grade_calc = lmnt.id;
    grade_calc = grade_calc.replace("grade_button_", "");
    grade_calc = grade_calc.substring(0, 1) + "." + grade_calc.substring(1, 3);
    grade = grade_calc;
    lmnt.style.backgroundColor = "#2b4696"
    checkFinishedState();
}

function checkFinishedState() {
    if (grade && type) {
        document.getElementById("grade_send_button").disabled = false;
    }
}

// 
// 
// 

function sendGrade() {
    $.ajax({
        url: './setGrade.php',
        type: 'POST',
        data: {
            class: location.href.split("?class=")[1].split("&")[0],
            grade: grade,
            type: type,
            note: document.getElementById("notiz_input").value,
            date: document.getElementById("date_input").value
        },
        success: function(data) {
            if (data == "SUCCESS") {
                location.assign("../fach/?id=" + location.href.split("?class=")[1].split("&")[0]);
            }
        }
    });
}