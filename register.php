<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Register</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <?php require 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require 'layouts/mininav.php'; ?>
        <div class="content">
        <?php require 'layouts/header.php'; ?>
			<span class="content-body">
                <?php
                    if(isset($_SESSION['messages']))
                    {
                        echo "<div class='messages " . $_SESSION['class'] . "'>";
                        echo "<p><b>There was a problem with registering:</b></p>";
                        echo "<ul>";
                        foreach($_SESSION['messages'] as $message)
                        {
                            echo "<li>{$message}</li>";
                        }
                        echo "</ul>";
                        echo '</div>';

                        $_SESSION['messages'] = null;
                    }

                    if(isset($_SESSION['authenticated']))
                    {
                        header('Location: profile.php');
                        exit;
                    }
                ?>
    			<h1>Register</h1>
                <div class="input-box">
                    <form method="post" action="handlers/register_handler.php">
                        <input class="textbox" type="text" name="email" placeholder="Email"/>
                        <br>
                        <input class="textbox" type="text" name="username" placeholder="Username: 3-30 chars"/>
                        <br>
                        <input class="textbox" type="password" name="password" placeholder="Password: 8-32 chars"/>
                        <br>
                        <input class="textbox" type="password" name="conf-password" placeholder="Confirm Password"/>
                        <br>
                        <input class="button" type="submit" value="Register"/>
                    </form>
                    <p>Already have an account? <strong>Login <a href="login.php">here</a>!</strong></p>
                </div>
			</span>
        </div>
        <?php require 'layouts/footer.php'; ?>
    </body>
</html>
