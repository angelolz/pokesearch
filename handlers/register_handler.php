<?php
    require_once '../handlers/DBConnection.php';
    require_once '../php_scripts/KLogger.php';
    session_start();

    //get form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confPassword = $_POST['conf-password'];

    $errors = array();

    $dbc = new DBConnection();
    $logger = new KLogger("log.txt", KLogger::WARN);

    //check if email is valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors['email'][]="This email is invalid.";
    }

    //check email length
    if(strlen($email) > 255)
    {
        $errors['email'][]="Your email is too long.";
    }

    //check username length
    if(strlen($username) < 3)
    {
        $errors['username'][]="Your username is too short.";
    }

    else if(strlen($username) > 32)
    {
        $errors['username'][]="Your username is too long.";
    }

    //check password length
    if(strlen($username) < 8)
    {
        $errors['password'][]="Your password is too short.";
    }

    else if(strlen($username) > 32)
    {
        $errors['password'][]="Your password is too long.";
    }

    //check if password fields match
    if(strcmp($password, $confPassword) !== 0)
    {
        $errors['password'][]="The password fields do not match.";
    }

    //errors check
    if(count($errors) > 0)
    {
        $logger->LogWarn(print_r($errors,1));
        $_SESSION['messages'] = $errors;
        $_SESSION['class'] = "fail";
        $_SESSION['form_data'] = $_POST;
        header('Location: ../register.php');
        exit;
    }

    else
    {
        if($dbc->addUser($email, $username, $password))
        {
            $_SESSION['class'] = "success";
            $_SESSION['messages'] = array("You have been successfully registered! Please login below.");
            $_SESSION['form_data'] = array();
            header('Location: ../login.php');
            exit;
        }

        else
        {
            $_SESSION['class'] = "fail";
            $_SESSION['messages'] = array("There is already an account registered with this email and/or username.");
            header('Location: ../register.php');
            exit;
        }
    }
?>
