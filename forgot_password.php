<html>
    <head>
        <title>Pokésearch | Forgot Your Password</title>
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
			<h1>Forgot your password?</h1>
            <div class="input-box">
            <p>Enter your username or email below and a password reset link will
                be sent to you in a few minutes.</p>
                <br>
            <p><b>Note: The link will expire in 15 minutes.</b></p>
            <form method="post" action="">
                <input class="textbox" type="text" name="username" placeholder="Email/Username"/>
                <input class="button" type="submit" value="Submit"/>
            </form>
            </div>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>