<?php
    require_once '../../init.php';
    require_once FUNCTIONS_PATH . '/profileHelper.php';
    require_once CLASSES_PATH . '/DBConnection.php';
    require_once CLASSES_PATH . '/KLogger.php';

    session_start();

    //get form data
    $teamName = trim($_POST['team-name']);

    $errors = array();

    $dbc = new DBConnection();
    $logger = new KLogger(LOG_PATH . '/log.txt', KLogger::DEBUG);

    if(empty($teamName))
    {
        $errors[] = "Team name cannot be blank.";
    }

    if(strlen($teamName) > 20)
    {
        $errors[]="Your team name is too long.";
    }

    if(!preg_match("/^[A-Za-z\s]+$/", $teamName))
    {
        $errors[]="Your team name can only contain letters and spaces.";
    }

    //errors check
    if(count($errors) > 0)
    {
        $dbc->logger->LogWarn(print_r($errors,1));
        $_SESSION['messages'] = $errors;
        $_SESSION['class'] = "fail";
        $_SESSION['form_data'] = $_POST;
        header('Location:  ../../profile.php');
        exit;
    }

    else
    {
        $latestTeam = addTeam($_SESSION['user_id'], $teamName);
        $dbc->logger->LogDebug("created new team: " . $teamName);
        if($latestTeam)
        {
            $_SESSION['class'] = "success";
            $_SESSION['messages'][] = "Your team was created successfully.";
            header('Location:  ../../profile.php');
            exit;
        }

        else
        {
            $errors[] = "We experienced a problem creating your team.";
            $_SESSION['messages'] = $errors;
            $_SESSION['class'] = "fail";
            $_SESSION['form_data'] = $_POST;
            header('Location:  ../../profile.php');
            exit;
        }
    }
?>
