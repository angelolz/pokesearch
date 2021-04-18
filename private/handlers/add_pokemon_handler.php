<?php
    require_once '../../init.php';
    require_once FUNCTIONS_PATH . '/profileHelper.php';
    require_once CLASSES_PATH . '/DBConnection.php';
    require_once CLASSES_PATH . '/KLogger.php';

    session_start();

    //get form data
    $teamId = trim($_POST['teamId']);
    $pkmnName = trim($_POST['pokemon']);
    $move1 = trim($_POST['move-1']);
    $move2 = trim($_POST['move-2']);
    $move3 = trim($_POST['move-3']);
    $move4 = trim($_POST['move-2']);

    $errors = array();
    $dbc = new DBConnection();
    $logger = new KLogger(LOG_PATH . '/log.txt', KLogger::DEBUG);

    if(empty($pkmnName))
    {
        $errors[] = "Pokémon name cannot be blank.";
    }

    if(empty($move1) && empty($move2) && empty($move3) && empty($move4))
    {
        $errors[] = "There should be at least 1 move.";
    }

    $pokemonTeam = getPokemon($teamId);
    if(count($pokemonTeam) == 6)
    {
        $errors[] = "There cannot be more than 6 Pokémon in a team.";
    }

    //check if pokemon is valid
    $url = "https://pokeapi.co/api/v2/pokemon/" . str_replace(" ", "-", strtolower($pkmnName));
    $headers = get_headers($url, 1);
    if(!$headers || $headers[0] == 'HTTP/1.1 404 Not Found')
    {
        $errors[] = "No Pokémon found. Please check the spelling.";
    }
    //check if move is valid
    for($i = 1; $i <= 4; $i++)
    {
        if(!empty(${"move" . $i}))
        {
            $url = "https://pokeapi.co/api/v2/move/" . str_replace(" ", "-", strtolower(${"move" . $i}));
            $headers = get_headers($url, 1);

            if(!$headers || $headers[0] == 'HTTP/1.1 404 Not Found')
            {
                $errors[] = "Move {$i} is invalid. Please check the spelling.";
            }
        }
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
        $success = addPokemon($teamId, $pkmnName, $move1, $move2, $move3, $move4);
        if($success)
        {
            $dbc->logger->LogInfo("added pokemon");
            $_SESSION['class'] = "success";
            $_SESSION['messages'][] = "Your Pokémon was added successfully.";
        }

        else
        {
            $_SESSION['class'] = "fail";
            $_SESSION['form_data'] = $_POST;
            $_SESSION['messages'][] = "There was a problem adding your Pokémon.";
        }

        header('Location:  ../../profile.php?team=' . $teamId);
        exit;
    }
