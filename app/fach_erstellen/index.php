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
    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
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
    <link rel="stylesheet" href="../../src/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../../src/fontawesome/css/solid.min.css">
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
                    <input type="text" name="fach_titel" id="fach_titel_input" maxlength="20" minlength="1" placeholder="Fachname">
                </div>
                <div id="grading_buttons">
                    <div class="grading_title title">Notengewichtung</div>
                    <div>
                        <h3>Klassenarbeiten / Schriftliche Noten</h3>
                        <input type="number" id="grade_percentage_k" name="grade_percentage_k" min="0" max="100" value="50">
                    </div>
                    <div>
                        <h3>Mündliche Noten</h3>
                        <input type="number" id="grade_percentage_m" name="grade_percentage_m" min="0" max="100" value="50">
                    </div>
                    <div>
                        <h3>Sonstige Noten</h3>
                        <input type="number" id="grade_percentage_s" name="grade_percentage_s" min="0" max="100" value="0">
                    </div>
                </div>
                <div id="color_picker">
                    <div class="color_title title">Fach-Farbe</div>
                    <input type="color" name="color_picker" id="color_picker_input">
                </div>
                <button onclick="createClass()" id="grade_send_button">Absenden</button>
            </div>
        </div>
    </div>
    <script src="../../src/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="script.js"></script>
</body>

</html>