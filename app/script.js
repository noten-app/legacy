function checkResize() {
    if (window.screen.width <= 500) {
        document.getElementById("top_leiste_icon-name").innerHTML = '<img src="/src/img/logo.png" alt="NotenApp Logo" style="margin: 0 !important;"/>';
    } else {
        document.getElementById("top_leiste_icon-name").innerHTML = '<img src="/src/img/logo.png" alt="NotenApp Logo"/>NotenApp';
    }
}
window.addEventListener('orientationchange', (event) => { checkResize() });
window.addEventListener('resize', (event) => { checkResize() });
checkResize();