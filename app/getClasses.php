<?php 
	// Start the session, to get the data
	session_start();

    // Variables
    $db_config = require('../config.php');

    // Conect to database
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'notenapp');
    if (mysqli_connect_errno()) {
        header("Location: ./account/index.html?c=98");
    }

    // Get all apps
    $applist = array();
    $query=$con->query("SELECT name, color, id, last_used, average FROM classes WHERE user_id = \"".$_SESSION['id']."\"");
    if($query){
        while($row = mysqli_fetch_array($query)){
            array_push($applist, json_encode(array("class_name" => $row["name"], "class_color" => $row["color"], "class_id" => $row["id"], "class_last_use" => $row["last_used"], "average" => $row["average"])));
        }
    }

    // Exit
    exit(json_encode($applist));
?>