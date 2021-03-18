<html>
    <head>
        <title>Pokésearch | Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&display=swap" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="fav/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png">
        <link rel="manifest" href="fav/site.webmanifest">
        <link rel="mask-icon" href="fav/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <?php require 'mininav.php'; ?>
        <div class="content">
        <?php require 'header.php'; ?>
			<span class="content-body">
                <?php
                if(isset($_SESSION['messages']))
                {
                    echo "<div class='messages " . $_SESSION['class'] . "'>";
                    if($_SESSION['class'] == "fail")
                    {
                        echo "<p><b>There was a problem with logging in:</b></p>";
                        echo "<ul>";
                        foreach($_SESSION['messages'] as $message)
                        {
                            echo "<li>{$message}</li>";
                        }
                        echo "</ul>";
                    }

                    else
                    {
                        foreach($_SESSION['messages'] as $message)
                        {
                            echo "<b>{$message}</b>";
                        }
                    }

                    echo '</div>';

                    $_SESSION['messages'] = null;
                }
                ?>
    			<h1>Login</h1>
                <div class="input-box">
                    <form method="post" action="handlers/login_handler.php">
                        <input class="textbox" type="text" name="username" placeholder="Email/Username"/>
                        <br>
                        <input class="textbox"  type="password" name="password" placeholder="Password"/>
                        <br>
                        <input class="button" type="submit" value="Login"/>
                        <button class="button" id="forgot"><a href="forgot_password.php">Forgot your password?</a></button>
                    </form>
                    <p>Don't have an account? <strong>Register <a href="register.php">here</a>!</strong></p>
                </div>
			</span>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>
