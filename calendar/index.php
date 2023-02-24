<?php 

    // Check login state
    session_start();
    require("../res/php/checkLogin.php");
    if(!checkLogin()) header("Location: ../account/login");

    // Get config
    require("../config.php");

    // DB Connection
    $con = mysqli_connect(
        config_db_host,
        config_db_user,
        config_db_password,
        config_db_name
    );
    if(mysqli_connect_errno()) exit("Error with the Database");

    // Get calendar events
    if($stmt = $con->prepare("SELECT * FROM calendar WHERE user_id = ?")) {
        $stmt->bind_param("i", $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $cal_events = $result->fetch_all(MYSQLI_ASSOC);
    }
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
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./fullcalendar.css">
</head>

<body>
    <nav>
        <div class="nav_top_buttons">
            <a href="/" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-home"></i>
                </div>
            </a>
            <a href="/calendar/" class="nav-link">
                <div class="navbar_icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </a>
            <a href="/homework/" class="nav-link">
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
        <div class="calendar-actions">
            <p class="mintext-caledit">
                You can edit Calendar entries by clicking on them!<br>
                You can also create new entries by clicking on the calendar grid.
            </p>
        </div>
        <div class="calendar_list" id="calendar_list"></div>
        <div class="calendar_grid" id="calendar_grid"></div>
    </main>
    <script src="/res/js/themes/themes.js"></script>
    <script src="/res/js/shortcuts/shortcuts.js"></script>
    <script src="/res/js/fullcalendar-6.1.4/dist/index.global.min.js"></script>
    <script>
        // Get calendar events
        const cal_events = <?php 
        echo "[";
            foreach ($cal_events as $item) {
                echo "{";
                if(isset($item["title"])) echo "'title': '" . $item["title"] . "',";
                if(isset($item["date"])) echo "'start': '" . $item["date"] . "',";
                if(isset($item["entry_id"])) echo "'id': '" . $item["entry_id"] . "',";
                if(isset($item["groupId"])) echo "'groupId': '" . $item["groupId"] . "'";
                echo "}";
                if($item != end($cal_events)) echo ",";
            }
        echo "]";
        ?>
    </script>
    <script src="./calendar-actions.js"></script>
</body>

</html>