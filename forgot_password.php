<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Forgot Your Password</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <?php require 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require 'layouts/mininav.php'; ?>
        <div class="content">
        <?php require 'layouts/header.php'; ?>
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
        <?php require 'layouts/footer.php'; ?>
    </body>
</html>
