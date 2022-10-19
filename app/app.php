<?php 
    // Start the session, to get the data
	session_start();
	// If the user is logged in redirect to the app page
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: ./account/');
        exit;
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
    <link rel="manifest" href="/manifest.json">
</head>

<body>
    <nav class="topleiste" id="topleiste">
        <div class="logo" id="top_leiste_icon-name"> <img src="../src/img/logo.png" alt="NotenApp Logo" /> NotenApp</div>
        <div id="topleiste_name" class="name" onclick="location.assign('./account/logout.php')"><?=$_SESSION['displayname']?></div>
        <div class="plus"><i class="fa-solid fa-plus"></i></div>
    </nav>
    <div class="mainbody" id="mainbody">
        <div class="fachliste" id="fachliste">
            <div class="fach-kachel">
                <div class="fach_name">Englisch</div>
                <div class="fach_farbe" style="background-color: #cccc00;"></div>
                <div class="fach_info">Note: 1,25</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Latein</div>
                <div class="fach_farbe" style="background-color: #aa0000;"></div>
                <div class="fach_info">Note: 2,75</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Mathematik</div>
                <div class="fach_farbe" style="background-color: #fff;"></div>
                <div class="fach_info">Note: 1,00</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Geographie</div>
                <div class="fach_farbe" style="background-color: #884400;"></div>
                <div class="fach_info">Note: 2,50</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Deutsch</div>
                <div class="fach_farbe" style="background-color: #0000aa;"></div>
                <div class="fach_info">Note: 3,25</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Biologie</div>
                <div class="fach_farbe" style="background-color: #008800;"></div>
                <div class="fach_info">Note: 2,75</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Chemie</div>
                <div class="fach_farbe" style="background-color: #bb00bb;"></div>
                <div class="fach_info">Note: 2,00</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Wirtschaft</div>
                <div class="fach_farbe" style="background-color: #888800;"></div>
                <div class="fach_info">Note: 2,00</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Politik</div>
                <div class="fach_farbe" style="background-color: #00bbbb;"></div>
                <div class="fach_info">Note: 2,00</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Technik</div>
                <div class="fach_farbe" style="background-color: #dd8800;"></div>
                <div class="fach_info">Note: 1,75</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Informatik</div>
                <div class="fach_farbe" style="background-color: #fc480b;"></div>
                <div class="fach_info">Note: 1,00</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Geschichte</div>
                <div class="fach_farbe" style="background-color: #934014;"></div>
                <div class="fach_info">Note: 3,00</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Kunst</div>
                <div class="fach_farbe" style="background-color: #888888;"></div>
                <div class="fach_info">Note: 3,00</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Physik</div>
                <div class="fach_farbe" style="background-color: #fb0100;"></div>
                <div class="fach_info">Note: 1,75</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Sport</div>
                <div class="fach_farbe" style="background-color: #444444;"></div>
                <div class="fach_info">Note: 3,75</div>
            </div>
            <div class="fach-kachel">
                <div class="fach_name">Religion</div>
                <div class="fach_farbe" style="background-color: #78fc5c;"></div>
                <div class="fach_info">Note: 1,75</div>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>

</html>