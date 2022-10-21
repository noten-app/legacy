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

    // Get params
    $class = $_POST["class"];
    $grade = $_POST["grade"];
    $type = $_POST["type"];
    $note = $_POST["note"];

    // Get class
    if ($stmt = $con->prepare('SELECT user_id FROM classes WHERE id = ?')) {
        $stmt->bind_param('s', $class);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        if($user_id !== $_SESSION["id"]){
            $user_id = "";
            exit("ERROR | Class not owned by executing user");
        }
        $stmt->close();
    } else {
        exit("DB ERROR in place 1");
    }

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
    $date = date('Y-m-d');

    // Insert values
    if ($stmt = $con->prepare("INSERT INTO grades (user_id, class, type, note, date, grade) VALUES (?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param('sissss', $_SESSION["id"], $class, $type, $note, $date, $grade);
        $stmt->execute();
        $stmt->close();
        $con->close();
        exit("SUCCESS");
    } else {
        exit("DB ERROR in place 2");
    }
?>