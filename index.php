<?php 

    // Check login state
    session_start();
    require("./res/php/checkLogin.php");
    if(!checkLogin()) header("Location: ./account/login");

    // Get config
    require("./config.php");

    // DB Connection
    $con = mysqli_connect(
        config_db_host,
        config_db_user,
        config_db_password,
        config_db_name
    );
    if(mysqli_connect_errno()) exit("Error with the Database");
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotenApp</title>
    <link rel="icon" type="image/x-icon" href="/res/img/favicon.ico" />
    <link rel="stylesheet" href="/res/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/res/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/res/css/fonts.css">
    <link rel="stylesheet" href="/res/css/main.css">
    <link rel="stylesheet" href="/res/css/navbar.css">
</head>

<body>
    <nav>
        <div class="nav_top_buttons">
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-home"></i>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </a>
            <a href="/grades/" class="nav-link">
                <div class="navbar_icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-book"></i>
                </div>
            </a>
            <a href="#" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-book-open"></i>
                </div>
            </a>
        </div>
        <div class="nav_bottom_buttons">
            <a href="#" class="nav-link nav-bottom" id="theme-link" onclick="">
                <div class="navbar_icon" id="settings-icon">
                    <div>
                        <i class="fas fa-cog"></i>
                    </div>
                </div>
            </a>
            <a href="#" class="nav-link nav-bottom" id="theme-link" onclick="cycleTheme();">
                <div class="navbar_icon" id="theme-icon">
                    <div>
                        <i class="fas fa-adjust"></i>
                    </div>
                </div>
            </a>
        </div>
    </nav>
    <main id="main">
    </main>
    <script src="/res/js/themes/themes.js"></script>
    <script src="/res/js/shortcuts/shortcuts.js"></script>
</body>

</html>