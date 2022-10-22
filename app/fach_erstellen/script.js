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
    document.getElementById("topleiste_name").style.backgroundColor = color;
    document.getElementById("topleiste_name").style.color = textcolor;
});