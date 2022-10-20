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

var fachliste = document.getElementById("fachliste");
$.ajax({
    url: './getClasses.php',
    type: 'POST',
    data: {},
    success: function(data) {
        // Parse the data
        var parsed = JSON.parse(data);
        // Sort
        parsed = parsed.sort(function(a, b) {
            return new Date(JSON.parse(a)["last_used"]) - new Date(JSON.parse(b)["last_used"]);
        });
        // Generate the Class item
        parsed.forEach(lmnt => {
            const element_parsed = JSON.parse(lmnt);
            // Class item container
            var fach_kachel = document.createElement("div");
            fach_kachel.classList.add("fach-kachel");
            fach_kachel.id = "fach_kachel-" + element_parsed.class_id;

            // Class name item 
            var fach_name = document.createElement("div");
            fach_name.classList.add("fach_name");
            fach_name.innerText = element_parsed.class_name;
            fach_kachel.appendChild(fach_name);

            // Class color item 
            var fach_farbe = document.createElement("div");
            fach_farbe.classList.add("fach_farbe");
            fach_farbe.style.backgroundColor = "#" + element_parsed.class_color;
            fach_kachel.appendChild(fach_farbe);

            // Class grade item 
            var fach_info = document.createElement("div");
            fach_info.classList.add("fach_info");
            if (element_parsed.class_grade) {
                fach_info.innerText = "Note: " + element_parsed.class_grade;
            } else {
                fach_info.innerText = "Note: ?";
            }
            fach_kachel.appendChild(fach_info);

            // Append the item
            fachliste.prepend(fach_kachel);
            // Get the element
            document.getElementById("fach_kachel-" + element_parsed.class_id).addEventListener("click", (event) => {
                location.assign("./fach/?id=" + element_parsed.class_id);
            });
        });
    }
});