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
    lmnt.style.backgroundColor = "#2b4696";
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
    lmnt.style.backgroundColor = "#2b4696";
}


// 
// 
// 

function sendGrade() {
    $.ajax({
        url: './setGrade.php',
        type: 'POST',
        data: {
            class: document.getElementById("class_id").innerText,
            grade: grade,
            grade_id: location.href.split("?grade_id=")[1].split("&")[0],
            type: type,
            note: document.getElementById("notiz_input").value,
            date: document.getElementById("date_input").value
        },
        success: function(data) {
            if (data == "SUCCESS") {
                location.assign("../fach/?id=" + document.getElementById("class_id").innerText);
            } else {
                console.log(data);
            }
        }
    });
}