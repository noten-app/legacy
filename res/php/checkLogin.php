<?php 

    if(!isset($_SESSION)) session_start();

    // Not logged in
    function checkLogin(){
        return !(
            !isset($_SESSION['id']) ||
            !isset($_SESSION['username']) ||
            !isset($_SESSION['displayname']) ||
            !isset($_SESSION['auth_type']) ||
            !isset($_SESSION['email']) 
        );
    }

?>