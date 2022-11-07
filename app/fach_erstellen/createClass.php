<?php 
	// Start the session, to get the dataclass_id
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
    if(isset($_POST["data"])){
        $data = $_POST["data"];
    } else {
        exit("NO DATA RECIEVED");
    }
    $data = json_decode($data);

    // Update DB
    if($stmt = $con->prepare("INSERT INTO classes (name, color, user_id, grade_k, grade_m, grade_s) VALUES (?, ?, ?, ?, ?, ?);")){
        $stmt->bind_param("sssiii", $data->name, $data->color, $_SESSION["id"], $data->grade_k, $data->grade_m, $data->grade_s);
        $stmt->execute();
    }

    // Exit
    exit("SUCCESS");
?>