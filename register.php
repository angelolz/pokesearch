<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Register</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">

        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
        <?php require_once 'layouts/header.php'; ?>
        <script type="text/javascript" src="js/register_tooltips.js"></script>
        <script src=js/closeBox.js></script>
			<span class="content-body">
                <?php
                    if(isset($_SESSION['messages']) && !empty($_SESSION['messages']))
                    {
                        echo "<div class='messages " . $_SESSION['class'] . "'>";
                        echo "<span id='close'>x</span>";
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
                    <form method="post" action="private/handlers/register_handler.php">
                        <?php
                        if(isset($_SESSION['form_data']['email']))
                        {
                            echo '<input class="textbox" type="text" value="' . htmlspecialchars($_SESSION['form_data']['email']) .'" name="email" placeholder="Email"/>';
                        }

                        else
                        {
                            echo '<input class="textbox" type="text" name="email" placeholder="Email"/>';
                        }
                        ?>

                        <br>
                        <span class="username-field">
                            <?php
                            if(isset($_SESSION['form_data']['email']))
                            {
                                echo '<input class="textbox" type="text" value="' . htmlspecialchars($_SESSION['form_data']['username']) . '" name="username" placeholder="Username"/>';
                            }

                            else
                            {
                                echo '<input class="textbox" type="text" name="username" placeholder="Username"/>';
                            }
                            ?>
                            <span id="username-tooltip">
                                <ul>
                                    <li>3-30 characters</li>
                                    <li>A-Z, 0-9, -, _ are allowed</li>
                                </ul>
                            </span>
                        </span>
                        <br>
                        <span class="password-field">
                            <input class="textbox" type="password" name="password" placeholder="Password"/>
                            <span id="password-tooltip">
                                <ul>
                                    <li>At least 8 characters</li>
                                    <li>Must have one number</li>
                                    <li>Must have one capital and lowercase letter</li>
                                    <li>Must have one symbol</li>
                                </ul>
                            </span>
                        </span>
                        <br>
                        <input class="textbox" type="password" name="conf-password" placeholder="Confirm Password"/>
                        <br>
                        <input class="button" type="submit" value="Register"/>
                    </form>
                    <p>Already have an account? <strong>Login <a href="login.php">here</a>!</strong></p>
                </div>
			</span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
