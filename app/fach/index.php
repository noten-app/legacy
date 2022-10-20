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
                <tr>
                    <td>1 - 2</td>
                    <td>11.03.2022</td>
                    <td>Klassenarbeit</td>
                    <td>KA 1</td>
                    <td><button>BEARBEITEN</button></td>
                </tr>
                <tr>
                    <td>3-</td>
                    <td>11.03.2022</td>
                    <td>Mündlich</td>
                    <td>KA 1</td>
                    <td><button>BEARBEITEN</button></td>
                </tr>
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