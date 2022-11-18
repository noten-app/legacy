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

    // Get class
    $id = $_GET["class"];
    if ($stmt = $con->prepare('SELECT name, color, user_id, id, last_used, grade_k, grade_m, grade_s FROM classes WHERE id = ?')) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($name, $color, $user_id, $id, $last_used, $grade_k, $grade_m, $grade_s);
        $stmt->fetch();
        if($user_id !== $_SESSION["id"]){
            $name = "";
            $color = "";
            $user_id = "";
            $last_used = "";
            exit("ERROR2");
        }
        $stmt->close();
    } else {
        exit("ERROR1");
    }

    // Text color check
    if(hexdec(substr($color,0,2))+hexdec(substr($color,2,2))+hexdec(substr($color,4,2))> 381){
        $textcolor = "#000000";
    } else {
        $textcolor = "#fffff";
    }

    // Color hashtag
    $color = "#".$color;
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
        <div class="logo" id="top_leiste_icon-name" onclick="location.assign('../fach/?id=<?=$id?>')"><i class="fa-solid fa-circle-left"></i></div>
        <div id="topleiste_name" class="name"style="background-color: <?=$color?>; color: <?=$textcolor?>;">Fach bearbeiten: <?=$name?></div>
        <div class="plus"><i class="fa-solid fa-plus"></i></div>
    </nav>
    <p id="class_id" style="display:none"><?=$id?></p>
    <div class="mainbody" id="mainbody">
        <div>
            <div id="container">
                <div id="fach_titel">
                    <div class="color_title title">Fach-Name</div>
                    <input type="text" name="fach_titel" id="fach_titel_input" maxlength="18" minlength="1" value="<?=$name?>">
                </div>
                <div id="grading_buttons">
                    <div class="grading_title title">Notengewichtung</div>
                    <div>
                        <h3>Klassenarbeiten / Schriftliche Noten</h3>
                        <input type="number" id="grade_percentage_k" name="grade_percentage_k" min="0" max="100" value="<?=$grade_k?>">
                    </div>
                    <div>
                        <h3>Mündliche Noten</h3>
                        <input type="number" id="grade_percentage_m" name="grade_percentage_m" min="0" max="100" value="<?=$grade_m?>">
                    </div>
                    <div>
                        <h3>Sonstige Noten</h3>
                        <input type="number" id="grade_percentage_s" name="grade_percentage_s" min="0" max="100" value="<?=$grade_s?>">
                    </div>
                </div>
                <div id="color_picker">
                    <div class="color_title title">Fach-Farbe</div>
                    <input type="color" name="color_picker" id="color_picker_input" value="<?=$color?>">
                </div>
                <div class="button_divider">
                    <button onclick="deleteClass()" id="grade_delete_button" class="class_edit_button" style="background-color:#ff4444; color:<?=$textcolor?>">Fach löschen</button>
                    <button onclick="updateClass()" id="grade_send_button" class="class_edit_button" style="background-color:<?=$color?>; color:<?=$textcolor?>">Speichern</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../../src/js/jquery/jquery-3.6.1.min.js"></script>
    <script src="script.js"></script>
</body>

</html>