<?php 
    // Start the session, to get the data
	session_start();
	// If the user is logged in redirect to the app page
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: ./account/');
        exit;
    }

    // Variables
    require('../config.php');

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
    <title>NotenApp - Fächer</title>
    <link rel="stylesheet" href="app.css">
    <link rel="icon" type="image/x-icon" href="../src/img/favicon.ico" />
    <link rel="apple-touch-icon" href="../src/img/favicon.ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
    <link rel="manifest" href="../manifest.json">
</head>

<body>
    <nav class="topleiste" id="topleiste">
        <div class="logo" id="top_leiste_icon-name"> <img src="../src/img/logo.png" alt="NotenApp Logo" /> NotenApp</div>
        <div id="topleiste_name" class="name" onclick="location.assign('./account/logout.php')"><?=$_SESSION['displayname']?></div>
        <div class="plus" onclick="location.assign('./fach_erstellen /');"><i class="fa-solid fa-plus"></i></div>
    </nav>
    <div class="mainbody" id="mainbody">
        <div class="fachliste" id="fachliste">
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./script.js"></script>
</body>

</html>