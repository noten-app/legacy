// Elements
const ol_container = document.getElementById("overlay_container");
const ol_addGrade = document.getElementById("overlay_add_grade");

// Overlay vars
let overlay_addGrade = false;

// Functions
function showOverlay_addGrade() {
    overlay_addGrade = true;
    ol_addGrade.style.display = "block";
    ol_container.style.backgroundColor = "#000000bb";
    ol_container.style.zIndex = "500";
}

function hideOverlay_addGrade() {
    overlay_addGrade = false;
    ol_addGrade.style.display = "none";
    ol_container.style.backgroundColor = "#00000000";
    ol_container.style.zIndex = "-500";
}

// Click Outside of Overlay
ol_container.addEventListener('click', function(e) {
    if (overlay_addGrade && !ol_addGrade.contains(e.target)) hideOverlay_addGrade();
});