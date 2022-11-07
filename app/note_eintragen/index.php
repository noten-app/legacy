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
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note eintragen - <?=$name?></title>
    <link rel="stylesheet" href="app.css">
    <link rel="icon" type="image/x-icon" href="../../src/img/favicon.ico" />
    <link rel="apple-touch-icon" href="../../src/img/favicon.ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
    <link rel="manifest" href="../../manifest.json">
</head>

<body>
    <nav class="topleiste" id="topleiste">
        <div class="logo" id="top_leiste_icon-name" onclick="location.assign('../fach/?id=<?=$id?>')"><i class="fa-solid fa-circle-left"></i></div>
        <div id="topleiste_name" class="name" style="background-color: #<?=$color?>; color: <?=$textcolor?>;">Note eintragen - <?=$name?></div>
        <div class="plus"><i class="fa-solid fa-plus"></i></div>
    </nav>
    <div class="mainbody" id="mainbody">
        <div>
            <div class="note_eintragen-container">
                <div class="notentyp">
                    <div class="grade_type_title title">Typ der Note</div>
                    <button onclick="chooseType(this)" class="type_button" id="type_button_schriftlich">Klassenarbeit / Schriftlich</button>
                    <button onclick="chooseType(this)" class="type_button" id="type_button_muendlich">Mündlich</button>
                    <button onclick="chooseType(this)" class="type_button" id="type_button_sonstiges">Sonstiges</button>
                </div>
                <div class="note">
                    <div class="grade_nummer_title title">Note</div>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_075">1+</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_100">1</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_125">1-</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_150">1-2</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_175">2+</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_200">2</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_225">2-</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_250">2-3</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_275">3+</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_300">3</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_325">3-</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_350">3-4</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_375">4+</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_400">4</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_425">4-</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_450">4-5</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_475">5+</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_500">5</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_525">5-</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_550">5-6</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_575">6+</button>
                    <button onclick="chooseGrade(this)" class="grade_button" id="grade_button_600">6</button>
                </div>
                <div class="datum">
                    <div class="datum_titel title">Datum</div>
                    <input type="date" name="date" id="date_input" value="<?=date('Y-m-d')?>" required>
                    <button onclick='document.getElementById("date_input").value = "<?=date("Y-m-d")?>"' id="date_reset">Datum zurücksetzen</button>
                </div>
                <div class="notiz">
                    <div class="notiz_titel title">Notiz</div>
                    <input type="text" id="notiz_input" maxlength="64" placeholder="Ich bin eine Notiz"></input>
                </div>
                <button onclick="sendGrade()" id="grade_send_button" class="grade_send_button" disabled>Absenden</button>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>