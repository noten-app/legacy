<?php 

    // Check login state
    session_start();
    require("../res/php/checkLogin.php");
    if(!checkLogin()) header("Location: ../account/login");

    // Get config
    require("../config.php");

    // DB Connection
    $con = mysqli_connect(
        config_db_host,
        config_db_user,
        config_db_password,
        config_db_name
    );
    if(mysqli_connect_errno()) exit("Error with the Database");

    // Get all classes
    $classlist = array();
    if($stmt = $con->prepare("SELECT name, color, id, last_used, average FROM ".config_table_name_classes." WHERE user_id = ?")) {
        $stmt->bind_param("s", $_SESSION["user_id"]);
        $stmt->execute();
        $stmt->bind_result($class_name, $class_color, $class_id, $class_last_used, $class_grade_average);
        while ($stmt->fetch()) {
            $classlist[] = array(
                "name" => $class_name,
                "color" => $class_color,
                "id" => $class_id,
                "last_used" => $class_last_used,
                "average" => $class_grade_average
            );
        }
        $stmt->close();
    }
    if(isset($_GET["class"])) foreach ($classlist as $class) {
        if($class["id"] == $_GET["class"]) {
            if($class["average"] == 0) $class["average"] = "???";
            $current_class = $class;
            
            // Get all grades
            $grades = array();
            if($stmt = $con->prepare("SELECT type, grade, note, date, id FROM ".config_table_name_grades." WHERE class = ?")) {
                $stmt->bind_param("s", $class["id"]);
                $stmt->execute();
                $stmt->bind_result($grade_type, $grade_grade, $grade_note, $grade_date, $grade_id);
                while ($stmt->fetch()) {
                    $grades[] = array(
                        "type" => $grade_type,
                        "grade" => $grade_grade,
                        "note" => $grade_note,
                        "date" => $grade_date,
                        "id" => $grade_id
                    );
                }
                $stmt->close();
            }
        }
    } else {
        if(isset($classlist[0])) header("Location: ./?class=".$classlist[0]["id"]);
    }

    // DB Con close
    $con->close();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotenApp</title>
    <link rel="icon" type="image/x-icon" href="/res/img/favicon.ico" />
    <link rel="stylesheet" href="/res/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/res/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/res/css/fonts.css">
    <link rel="stylesheet" href="/res/css/main.css">
    <link rel="stylesheet" href="/res/css/navbar.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="overlays" id="overlay_container">
        <div class="overlay_add_grade" id="overlay_add_grade">
            <h1>Füge eine Note hinzu</h1>
            <hr>
            <h3>Notentyp</h3>
            <div class="grade_type-buttons">
                <button>Klassenarbeit</button>
                <button>Test</button>
                <button>M&uuml;ndlich</button>
                <button>Sonstiges</button>
            </div>
            <hr>
            <h3>Note</h3>
            <div class="grade-buttons">
                <button>1</button>
                <button>1-</button>
                <button>1-2</button>
            </div>
            <hr>
        </div>
    </div>
    <nav>
        <div class="nav_top_buttons">
            <a href="/" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-home"></i>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </a>
            <a href="/grades/" class="nav-link">
                <div class="navbar_icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-book"></i>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-book-open"></i>
                </div>
            </a>
        </div>
        <div class="nav_bottom_buttons">
            <a href="#" class="nav-link nav-bottom" id="theme-link" onclick="">
                <div class="navbar_icon" id="settings-icon">
                    <div>
                        <i class="fas fa-cog"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="nav-link nav-bottom" id="theme-link" onclick="cycleTheme();">
                <div class="navbar_icon" id="theme-icon">
                    <div>
                        <i class="fas fa-adjust"></i>
                    </div>
                </div>
            </a>
        </div>
    </nav>
    <main id="main">
        <div class="class_list">
            <div class="classlist_title">
                Classes
            </div>
            <div class="class_list_list">
                <?php 
                foreach ($classlist as $class) {
                    echo '<div class="class_entry" onclick="location.assign(\'./?class='.$class["id"].'\')" style="border-color:#'.$class["color"].'">';
                    echo '<div class="class_entry_name">'.$class["name"].'</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="grade_table">
            <table>
                <thead>
                    <tr>
                        <th>Note</th>
                        <th>Datum</th>
                        <th>Typ</th>
                        <th>Notiz</th>
                        <th>Bearbeiten</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($grades as $grade) {
                            $table_entry = "<tr><td>".$grade["grade"];
                            $table_entry .= "</td><td>". $grade["date"];
                            $table_entry .= "</td><td>". $grade["type"];
                            $table_entry .= "</td><td>". $grade["note"];
                            $table_entry .= "</td><td><button onclick='location.assign(\"../note_bearbeiten?grade_id=".$grade["id"]."\")'>BEARBEITEN</button></td></tr>";
                            echo $table_entry;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="grade_stats">
            <div class="grade_stats_cake">
                <div class="cake_coming_soon">
                    Statistics<br>Coming Soon!
                </div>
            </div>
            <div class="grade_stats_average">
                &Oslash; <?=$current_class["average"]?>
            </div>
            <div class="grade_plus" onclick="showOverlay_addGrade();">
                <div class="grade_plus_button grade_stats_button">
                    <i class="fa-solid fa-square-plus"></i>
                </div>
            </div>
            <div class="grade_more">
                <div class="grade_more_button grade_stats_button">
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
            </div>
        </div>
    </main>
    <script src="./overlays.js"></script>
    <script src="/res/js/themes/themes.js"></script>
    <script src="/res/js/shortcuts/shortcuts.js"></script>
</body>

</html>