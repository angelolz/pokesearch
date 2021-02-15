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
        <div class="content">
        <?php require 'header.php'; ?>
			<span class="content-body">
    			<h1>Login</h1>
                <div class="input-box">
                    <form method="post" action="profile.php">
                        <input class="textbox" type="text" name="email" placeholder="Email/Username"/>
                        <br>
                        <input class="textbox"  type="password" name="password" placeholder="Password"/>
                        <br>
                        <input class="button" type="submit" value="Login"/>
                        <button class="button" >Forgot your password?</button>
                    </form>
                    <p>Don't have an account? <strong>Register <a href="login.php">here!</a></strong></p>
                </div>
			</span>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>
