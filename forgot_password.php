<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Forgot Your Password</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
        <?php require_once 'layouts/header.php'; ?>
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
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
