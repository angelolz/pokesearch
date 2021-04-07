<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Login</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
        <?php require_once 'layouts/header.php'; ?>
			<span class="content-body">
                <?php
                if(isset($_SESSION['messages']) && !empty($_SESSION['messages']))
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

                if(isset($_SESSION['authenticated']))
                {
                    header('Location: profile.php');
                    exit;
                }
                ?>
    			<h1>Login</h1>
                <div class="input-box">
                    <form method="post" action="private/handlers/login_handler.php">
                        <?php
                        if(isset($_SESSION['form_data']['username']))
                        {
                            echo '<input class="textbox" type="text" value="' . htmlspecialchars($_SESSION['form_data']['username']) . '" name="username" placeholder="Email/Username"/>';
                        }

                        else
                        {
                            echo '<input class="textbox" type="text" name="username" placeholder="Email/Username"/>';
                        }

                        ?>  
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
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
