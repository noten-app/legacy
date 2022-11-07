document.getElementById("color_picker_input").addEventListener("input", (e) => {
    const color = document.getElementById("color_picker_input").value;
    var textcolor = "#ffffff";
    const hex = color.replace('#', '');
    const c_r = parseInt(hex.substr(0, 2), 16);
    const c_g = parseInt(hex.substr(2, 2), 16);
    const c_b = parseInt(hex.substr(4, 2), 16);
    if ((c_r + c_g + c_b) > 381) {
        textcolor = "#000000";
    }
    document.getElementById("grade_send_button").style.backgroundColor = color;
    document.getElementById("topleiste_name").style.backgroundColor = color;
    document.getElementById("grade_send_button").style.color = textcolor;
    document.getElementById("topleiste_name").style.color = textcolor;
});

function createClass() {
    var error = false;
    // Class Name
    const class_name = document.getElementById("fach_titel_input").value;
    if (class_name.length == 0) {
        document.getElementById("fach_titel").style.border = "3px solid red";
        error = true;
    } else {
        document.getElementById("fach_titel").style.border = "0px";
    }
    // Grade percentages 100 check
    const grading_k = parseInt(document.getElementById("grade_percentage_k").value);
    const grading_m = parseInt(document.getElementById("grade_percentage_m").value);
    const grading_s = parseInt(document.getElementById("grade_percentage_s").value);
    if ((grading_k + grading_m + grading_s) != 100) {
        document.getElementById("grading_buttons").style.border = "3px solid red";
        error = true;
    } else {
        document.getElementById("grading_buttons").style.border = "0px";
    }
    // Color
    const color = document.getElementById("color_picker_input").value;
    if (!color.startsWith("#")) {
        document.getElementById("color_picker").style.border = "3px solid red";
        error = true;
    } else {
        document.getElementById("color_picker").style.border = "0px";
    }
    // Check if errors
    if (error) {
        return;
    }
    // Data to json
    var data = {
        name: class_name,
        grade_k: grading_k,
        grade_m: grading_m,
        grade_s: grading_s,
        color: color.replace("#", "")
    }
    $.ajax({
        url: './createClass.php',
        type: 'POST',
        data: { data: JSON.stringify(data) },
        success: function(data) {
            if (data == "SUCCESS") {
                location.assign("../app.php");
            } else {
                console.log(data);
            }
        }
    });
}