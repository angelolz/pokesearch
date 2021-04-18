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
        <script src=https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js></script>
        <script src=js/validation/loginValidation.js></script>
        <script src=js/closeBox.js></script>
			<span class="content-body">
                <?php
                if(isset($_SESSION['messages']) && !empty($_SESSION['messages']))
                {
                    echo "<div class='messages " . $_SESSION['class'] . "'>";
                    echo "<span id='close'>x</span>";
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
                    <form name="login" method="post" action="private/handlers/login_handler.php">
                        <?php
                        echo "<div>";
                        if(isset($_SESSION['form_data']['username']))
                        {
                            echo '<input class="textbox" type="text" value="' . htmlspecialchars($_SESSION['form_data']['username']) . '" name="username" placeholder="Email/Username"/>';
                        }


                        else
                        {
                            echo '<input class="textbox" type="text" name="username" placeholder="Email/Username"/>';
                        }
                        echo "</div>";
                        ?>
                        <div>
                            <input class="textbox"  type="password" name="password" placeholder="Password"/>
                        </div>
                        <input class="button" type="submit" value="Login"/>
                    </form>
                    <p>Don't have an account? <strong>Register <a href="register.php">here</a>!</strong></p>
                </div>
			</span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
