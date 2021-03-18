<?php
    require_once '../handlers/DBConnection.php';
    require_once '../php_scripts/KLogger.php';
    session_start();

    //get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = array();

    $dbc = new DBConnection();
    $logger = new KLogger("../log.txt", KLogger::DEBUG);

    ///check if password field is blank
    if(strlen($password) == 0)
    {
        $errors[] = "Password field cannot be blank.";
    }

    //check if username field is blank
    if(strlen($username) == 0)
    {
        $errors[] = "Email/Username field cannot be blank.";
    }

    //errors check
    if(count($errors) > 0)
    {
        $logger->LogWarn(print_r($errors,1));
        $_SESSION['messages'] = $errors;
        $_SESSION['class'] = "fail";
        header('Location: ../login.php');
        exit;
    }

    else
    {
        $user = $dbc->userExists($username, $password);
        $_SESSION['authenticated'] = count($user);
        if($_SESSION['authenticated'])
        {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ../profile.php');
            exit;
        }

        else
        {
            $_SESSION['messages'] = array("The email/password you've entered is incorrect.");
            $_SESSION['class'] = "fail";
            header('Location: ../login.php');
            exit;
        }
    }
?>
