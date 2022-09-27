<?php
	// Start the session, to get the data
	session_start();
	// If the user is logged in redirect to the app page
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        header('Location: ../app.php');
        exit;
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Sqowey</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="index_style.css" rel="stylesheet" type="text/css">
        <!-- Set tab icon -->
        <link rel="icon" href="../../contents/icon.svg">
    </head>

    <body>
        <!-- Theme button -->
        <div id="themeButton">
            <button id="themeToggleButton" onclick="toggleTheme()">Darkmode/Lightmode</button>
        </div>

        <div id="choose">
            <!-- Header -->
            <h1>Bitte wählen</h1>

            <!-- The menu -->
            <div id="auswahlen">
                <!-- Username field -->
                <span onclick='window.location.assign("login.html")'>Anmelden</span>

                <!-- Password field -->
                <span onclick='window.location.assign("register.html")'>Registrieren</span>

                <!-- Password field -->
                <span onclick='window.location.assign("../help.html")'>Hilfe</span>
            </div>
        </div>

        <!-- Load all needed scripts -->
        <script src="index_themes.js"></script>
    </body>

    </html>