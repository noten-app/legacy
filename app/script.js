function checkResize() {
    if (window.screen.width <= 500) {
        document.getElementById("top_leiste_icon-name").innerHTML = '<img src="../src/img/logo.png" alt="NotenApp Logo" style="margin: 0 !important;"/>';
    } else {
        document.getElementById("top_leiste_icon-name").innerHTML = '<img src="../src/img/logo.png" alt="NotenApp Logo"/>NotenApp';
    }
}
window.addEventListener('orientationchange', (event) => { checkResize() });
window.addEventListener('resize', (event) => { checkResize() });
checkResize();

const topleiste_name = document.getElementById("topleiste_name");
var username = "";
topleiste_name.addEventListener("mouseenter", (e) => {
    if (username.length == 0) {
        username = topleiste_name.innerText;
    }
    topleiste_name.innerText = "Ausloggen";
    topleiste_name.style.backgroundColor = "#2B56a6"
});
topleiste_name.addEventListener("mouseleave", (e) => {
    topleiste_name.innerText = username;
    topleiste_name.style.backgroundColor = "#2b4696";
});