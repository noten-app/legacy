<?php 
	// Start the session, to get the data
	session_start();
	// If the user is logged in redirect to the app page
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: ../account/');
        exit;
    }

    // Variables
    $db_config = require('../../config.php');

    // Conect to database
    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
        header("Location: ./account/index.html?c=98");
    }

    // Get data
    if(isset($_POST["class_id"]) && isset($_POST["grade_id"])){
        $class_id = $_POST["class_id"];
        $grade_id = $_POST["grade_id"];
    } else {
        exit("NO DATA RECIEVED");
    }
    $class_id = $_POST["class_id"];
    $grade_id = $_POST["grade_id"];

    // Update DB
    if($stmt = $con->prepare("DELETE FROM grades WHERE id = ? AND class = ? AND user_id = ? ")){
        $stmt->bind_param("iis", $grade_id, $class_id, $_SESSION["id"]);
        $stmt->execute();
    }

    // Exit
    exit("SUCCESS");
?>