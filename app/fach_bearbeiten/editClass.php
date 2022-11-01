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
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'notenapp');
    if (mysqli_connect_errno()) {
        header("Location: ./account/index.html?c=98");
    }

    // Get data
    if(isset($_POST["data"])){
        $data = $_POST["data"];
    } else {
        exit("NO DATA RECIEVED");
    }
    $data = json_decode($data);

    // Update DB
    if($stmt = $con->prepare("UPDATE classes SET name = ?, color = ?, grade_k = ?, grade_m = ?, grade_s = ? WHERE user_id = ? AND id = ?")){
        $stmt->bind_param("ssiiisi", $data->name, $data->color, $data->grade_k, $data->grade_m, $data->grade_s, $_SESSION["id"], $data->class_id);
        $stmt->execute();
    }

    // Exit
    exit("SUCCESS");
?>