<?php 
    // Start the session, to get the data
	session_start();
	// If the user is logged in redirect to the app page
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: ./account/');
        exit;
    }

    // Variables
    require('../../config.php');

    // Conect to database
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'notenapp');
    if (mysqli_connect_errno()) {
        header("Location: ./account/index.php?c=98");
    }

    // Get class
    $id = $_GET["id"];
    if ($stmt = $con->prepare('SELECT name, color, user_id, id, last_used FROM classes WHERE id = ?')) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($name, $color, $user_id, $id, $last_used);
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

    // Get grades
    $grades = array(); 
    if ($stmt = $con->prepare('SELECT id, user_id, class, note, type, date, grade FROM grades WHERE class = ?')) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach($result as $row) {
            array_push($grades, $row);
        }
        if($user_id !== $_SESSION["id"]){
            $name = "";
            $user_id = "";
            $id = "";
            $class = "";
            $note = "";
            $date = "";
            $grade = "";
            exit("ERROR2");
        }
        $stmt->close();
    } else {
        exit("ERROR1");
    }
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotenApp - <?=$name?></title>
    <link rel="stylesheet" href="app.css">
    <link rel="icon" type="image/x-icon" href="../../src/img/favicon.ico" />
    <link rel="apple-touch-icon" href="../../src/img/favicon.ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
    <link rel="manifest" href="../../manifest.json">
</head>

<body>
    <nav class="topleiste" id="topleiste">
        <div class="logo" id="top_leiste_icon-name" onclick="location.assign('../app.php')"><i class="fa-solid fa-house"></i></div>
        <div id="topleiste_name" class="name" style="background-color: #<?=$color?>; color: <?=$textcolor?>;"><?=$name?></div>
        <div class="plus"><i class="fa-solid fa-plus"></i></div>
    </nav>
    <div class="mainbody" id="mainbody">
        <table>
            <thead>
                <tr>
                    <th>Note</th>
                    <th>Datum</th>
                    <th>Typ</th>
                    <th>Notiz</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($grades as $grade_entry) {
                        $grade_split = (explode(".",$grade_entry["grade"]));
                        $grade = "";
                        // Grade to text calc
                        if (sizeof($grade_split) == 2) {
                            switch ($grade_split[1]) {
                                case "25":
                                    $grade = $grade_split[0]. "-";
                                    break;
                                case "5":
                                    $grade = $grade_split[0] . "-" . (int)$grade_split[0] + 1;
                                    break;
                                case "75":
                                    $grade = (int)$grade_split[0] + 1 . "+";
                                    break;
                            }
                        } else {
                            $grade = $grade_split[0];
                        }
                        // Date to text calc
                        $date_split = explode("-",$grade_entry["date"]);
                        $date = $date_split[2] . "." . $date_split[1] . "." . $date_split[0];
                        // Type to text
                        $type = "";
                        switch ($grade_entry["type"]) {
                            case 'K':
                                $type = "Klassenarbeit";
                                break;
                            case 'M':
                                $type = "Mündlich";
                                break;
                            case 'S':
                                $type = "Sonstiges";
                                break;
                        }
                        // Paste table entry
                        $table_entry = "<tr><td>".$grade;
                        $table_entry .= "</td><td>". $date;
                        $table_entry .= "</td><td>". $type;
                        $table_entry .= "</td><td>". $grade_entry["note"];
                        $table_entry .= "</td><td><button onclick='editGrade(".$grade_entry["id"].")'>BEARBEITEN</button></td></tr>";
                        echo $table_entry;
                    }
                ?>
                <tr>
                    <td id="average-grade">2 - 3</td>
                    <td></td>
                    <td>4 Klassenarbeit | 2 Mündlich | 2 Sonstige</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>