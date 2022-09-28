<?php
	// Start the session, to get the data
	session_start();
	// If the user is logged in redirect to the app page
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        header('Location: ../app.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NotenApp - Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="status_container status"></div>
        <div id="center_parent">
            <div class="left-right_divider">
                <div class="left flex_center_parent">
                    <fieldset>
                        <legend>
                            <div id="login_title">
                                <h1>Login</h1>
                            </div>
                        </legend>
                        <form action="login.php" method="post">
                            <input type="text" name="username" placeholder="Benutzername" id="username" required>
                            <input type="password" name="password" placeholder="Passwort" id="password" required>
                            <input type="submit" value="Einloggen">
                        </form>
                    </fieldset>

                </div>
                <div class="right flex_center_parent">
                    <fieldset>
                        <legend>
                            <div id="register_title">
                                <h1>Registration</h1>
                            </div>
                        </legend>
                        <form action="register.php" method="post">
                            <input type="text" name="email" placeholder="E-Mail" id="email" required>
                            <input type="text" name="username" placeholder="Nutzername" id="username" required>
                            <input type="password" name="password" placeholder="Passwort" id="password" required>
                            <input type="password" name="password_repeat" placeholder="Passwort wiederholen" id="password_repeat" required>
                            <input id="submitButton" type="submit" value="Registrieren">
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/cuzimbisonratte/status_box@v1.0.0/statusbox.js"></script>
    </body>
</html>