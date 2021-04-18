<?php
    require_once '../../init.php';
    require_once CLASSES_PATH . '/DBConnection.php';
    require_once CLASSES_PATH . '/KLogger.php';
    require_once FUNCTIONS_PATH . '/emailUsernameExists.php';

    session_start();

    //get form data
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confPassword = trim($_POST['conf-password']);

    $errors = array();

    $dbc = new DBConnection();
    $logger = new KLogger(LOG_PATH . '/log.txt', KLogger::DEBUG);

    //check if email is valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors[]="This email is invalid.";
    }

    //check username length
    if(strlen($username) < 3)
    {
        $errors[]="Your username is too short.";
    }

    else if(strlen($username) > 32)
    {
        $errors[]="Your username is too long.";
    }

    //check username if it meets reqs
    if (!preg_match("/^[a-zA-Z_\-\d]+$/", $username))
    {
        $errors[]="Only lowercase/uppercase letters, numbers, dashes and underscores are allowed.";
    }

    //check password length
    if(strlen($password) < 8)
    {
        $errors[]="Your password is too short.";
    }

    //check if password meets requirements
    if(!preg_match("#[0-9]+#", $password))
    {
        $errors[]="Your password must contain one number!";
    }

    if(!preg_match("#[A-Z]+#", $password))
    {
        $errors[]="Your password must contain one uppercase letter!";
    }

    if(!preg_match("#[a-z]+#", $password))
    {
        $errors[]="Your password must contain one lowercase letter!";
    }

    if(!preg_match("#[^\w]#", $password))
    {
        $errors[]="Your password must contain one special symbol!";
    }

    //check if password fields match
    if(strcmp($password, $confPassword) !== 0)
    {
        $errors[]="The password fields do not match.";
    }

    //errors check
    if(count($errors) > 0)
    {
        $logger->LogWarn(print_r($errors,1));
        $_SESSION['messages'] = $errors;
        $_SESSION['class'] = "fail";
        $_SESSION['form_data'] = $_POST;
        header('Location:  ../../register.php');
        exit;
    }

    else
    {
        if($dbc->addUser($email, $username, $password))
        {
            $_SESSION['class'] = "success";
            $_SESSION['messages'][] = "You have been successfully registered! Please login below.";
            $_SESSION['form_data'] = array();
            header('Location:  ../../login.php');
            exit;
        }

        else
        {
            $_SESSION['class'] = "fail";
            $usernameTaken = usernameTaken($username);
            $emailExists = emailExists($email);

            if($usernameTaken['exists'] == 1)
            {
                $_SESSION['messages'][] = "That username is already taken.";
            }

            if($emailExists['exists'] == 1)
            {
                $_SESSION['messages'][] = "That email is already in use.";
            }

            header('Location:  ../../login.php');
            exit;
        }
    }
?>
