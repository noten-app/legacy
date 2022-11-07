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
    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
        header("Location: ./account/index.php?c=98");
    }

    // Get params
    $class = $_POST["class"];
    $grade = $_POST["grade"];
    $grade_id = $_POST["grade_id"];
    $type = $_POST["type"];
    $note = $_POST["note"];
    $date = $_POST["date"];

    // Check values
    if($grade < 0.75 || $grade > 6){
        exit("Grade not expected");
    }
    if(!($type == "K" || $type == "M" || $type == "S")){
        exit("Type \"".$type."\" not expected");
    }
    if(strlen($note) > 64){
        exit("Note too long");
    }

    // Generate date
    if(!$date) $date = date('Y-m-d');

    // Insert values
    if ($stmt = $con->prepare("UPDATE grades SET class = ?, type = ?, note = ?, date = ?, grade = ? WHERE user_id = ? AND id = ?")) {
        $stmt->bind_param('isssssi', $class, $type, $note, $date, $grade, $_SESSION["id"], $grade_id);
        $stmt->execute();
        $stmt->close();
        $con->close();
        exit("SUCCESS");
    } else {
        exit("DB ERROR in place 2");
    }
?>