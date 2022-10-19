const status_container = document.getElementById("status_container");
if (location.href.split("?c=")[1].split("&")[0]) {
    switch (location.href.split("?c=")[1].split("&")[0]) {
        case "21":
            status_container.innerText = "Beide Passwörter müssen übereinstimmen";
            break;
        case "01":
            status_container.innerText = "Die eMail ist nicht valide";
            break;
        case "02":
            status_container.innerText = "Der Benutzername ist nicht valide";
            break;
        case "04":
            status_container.innerText = "Das Passwort ist nicht valide";
            break;
        case "98":
            status_container.innerText = "Fehler mit der Datenbank";
            break;
        case "11":
            status_container.innerText = "Der Benutzername ist schon vergeben";
            break;
        case "12":
            status_container.innerText = "Die eMail ist schon zu oft genutzt";
            break;
        case "13":
            status_container.innerText = "Der Benutzer wurde erstellt, du kannst dich jetzt anmelden";
            status_container.style.backgroundColor = "#008800";
            document.getElementById("register_form").style.filter = "grayscale(1)";
            document.getElementById("login_form").style.transform = "scale(1.15)";
            window.setTimeout(() => {
                document.getElementById("login_form").style.transform = "scale(1)";
            }, 0.5 * 1000);
            break;
    }
}