<?php 
    // Start the session, to get the data
	session_start();
	// If the user is logged in redirect to the app page
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: ../account/');
        exit;
    }

    // Variables
    require('../../config.php');

    // Conect to database
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'notenapp');
    if (mysqli_connect_errno()) {
        header("Location: ./account/index.php?c=98");
    }
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotenApp - Fach erstellen</title>
    <link rel="stylesheet" href="app.css">
    <link rel="icon" type="image/x-icon" href="../../src/img/favicon.ico" />
    <link rel="apple-touch-icon" href="../../src/img/favicon.ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
    <link rel="manifest" href="../../manifest.json">
</head>

<body>
    <nav class="topleiste" id="topleiste">
        <div class="logo" id="top_leiste_icon-name" onclick="location.assign('../app.php')"><i class="fa-solid fa-circle-left"></i></div>
        <div id="topleiste_name" class="name">Fach erstellen</div>
        <div class="plus"><i class="fa-solid fa-plus"></i></div>
    </nav>
    <div class="mainbody" id="mainbody">
        <div>
            <div id="container">
                <div id="fach_titel">
                    <div class="color_title title">Fach-Titel</div>
                    <input type="text" name="fach_titel" id="fach_titel_input" maxlength="16" minlength="1">
                </div>
                <div id="grading_buttons">
                    <div class="grading_title title">Notengewichtung</div>
                    <div>
                        <h3>Klassenarbeiten / Schriftliche Noten</h3>
                        <input type="number" id="tentacles" name="tentacles" min="0" max="100" value="50">
                    </div>
                    <div>
                        <h3>Mündliche Noten</h3>
                        <input type="number" id="tentacles" name="tentacles" min="0" max="100" value="50">
                    </div>
                    <div>
                        <h3>Sonstige Noten</h3>
                        <input type="number" id="tentacles" name="tentacles" min="0" max="100" value="0">
                    </div>
                </div>
                <div id="color_picker">
                    <div class="color_title title">Fach-Farbe</div>
                    <input type="color" name="color_picker" id="color_picker_input">
                </div>
                <button onclick="sendGrade()" id="grade_send_button" disabled>Absenden</button>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>