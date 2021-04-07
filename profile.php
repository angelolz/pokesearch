<?php
require_once 'init.php';
require_once FUNCTIONS_PATH . "/profileHelper.php";
require_once CLASSES_PATH . "/KLogger.php";

$logger = new KLogger(LOG_PATH . "/log.txt", KLogger::DEBUG);

if(!isset($_GET['team']))
{
    $teamId = 0;
}

else
{
    if(!is_numeric($_GET['team']))
    {
        $teamId = 0;
    }

    else
    {
        $teamId = $_GET['team'];
    }
}
?>

<html>
    <head>
        <title>Pokésearch | Profile</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/profile.css">

        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
            <?php
                require_once 'layouts/header.php';
                if(!isset($_SESSION['authenticated']))
                {
                    $_SESSION['messages'][] = "You must be logged in to view this page.";
                    $_SESSION['class'] = 'fail';
                    header('Location: login.php');
                    exit;
                }
            ?>
            <script src="js/createTeamBox.js"></script>
            <?php
                if(isset($_SESSION['messages']) && !empty($_SESSION['messages']))
                {
                    echo "<div class='messages " . $_SESSION['class'] . "'>";
                    if($_SESSION['class'] == "fail")
                    {
                        echo "<p><b>There was a problem with managing your team:</b></p>";
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
            ?>
            <div class="container">
                <div class="sidebar left">
                    <h3>Your Teams</h3>
                    <span class="manage-teams">
                        <button id="create-team">+ Create Team</button>
                    </span>
                    <div id="create-team-box" class="hidden">
                        <h3>Enter your new Team Name:</h3>
                        <form method="post" action="private/handlers/create_team_handler.php">
                            <input type="textbox" type="text" name="team-name" placeholder="Team Name"></input>
                            <button id="createbutton">Create</button>
                        </form>
                        <p>Your team name must be 20 characters max, and can only contain letters and spaces.</p>
                    </div>
                    <span class="teams-list">
                        <?php
                        $teams = getTeams($_SESSION['user_id']);

                        if(count($teams) == 0)
                        {
                            echo "<p> You haven't created a team yet!</p>";
                        }

                        else
                        {
                            if($teamId == 0)
                            {
                                $teamId = $teams[0]['team_id'];
                            }

                            echo '<ul id="list">';
                            foreach($teams as $team)
                            {
                                if($team['team_id'] == $teamId)
                                {
                                    echo sprintf('<li><b>%s</b></li>', htmlspecialchars($team['team_name']));
                                }

                                else
                                {
                                    echo sprintf('<a href="profile.php?team=%u"><li>%s</li></a>', $team['team_id'], htmlspecialchars($team['team_name']));
                                }
                            }
                            echo '</ul>';
                        }

                        echo '</span>';
                        echo '</div>';

                        echo '<div class="sidebar right">';

                        $queryTeam = getTeam($teamId);
                        if(count($teams) == 0)
                        {
                            echo "<h3>You don't have a team yet, create one at the left sidebar!</h3>";
                        }

                        else
                        {
                            if(count($queryTeam) == 0)
                            {
                                $teamId = $teams[0]['team_id'];
                            }

                            else if($queryTeam[0]['owner'] != $_SESSION['user_id'])
                            {
                                $teamId = $teams[0]['team_id'];
                            }

                            $currentTeam = getTeam($teamId);

                            echo '<h1>' . htmlspecialchars($currentTeam[0]['team_name']) . '</h1>';
                            $pokemonTeam = getPokemon($teamId);

                            if(count($pokemonTeam) < 6)
                            {
                                echo '<button id="addPokemon">+ Add Pokemon</button>';
                            }
                        }

                        ?>
                        <div id="addPokemonForm" class="hidden">
                            <form method="post" action="private/handlers/add_pokemon_handler.php">
                                <p><b>Add a Pokémon:</b></p>
                                <?php echo '<input type="hidden" name="teamId" value="' . $teamId . '">'; ?>
                                <input id="pkmnName" type="text" name="pokemon" placeholder="Pokemon Name"/>
                                <div class="moveset-form">
                                    <?php for ($i = 1; $i <= 4; $i++)
                                    {
                                        echo '<input class="textbox" type="text" name="move-' . $i . '" placeholder="Move ' . $i . '"/>';
                                    }
                                    ?>
                                </div>
                                <button id="addPokemonButton">Submit</button>
                            </form>
                        </div>

                        <?php
                        if(!count($teams) == 0)
                        {
                            if(count($pokemonTeam) == 0)
                            {
                                echo "<p>There are no Pokémon in this team!
                                      Use the button above to add one!</p>";
                            }

                            else
                            {
                                foreach($pokemonTeam as $pokemon)
                                {
                                    $pkmnJson = json_decode(file_get_contents("https://pokeapi.co/api/v2/pokemon/" . strtolower($pokemon['pokemon_name'])));
                                    $pkmnSpJson = json_decode(file_get_contents("https://pokeapi.co/api/v2/pokemon-species/" . strtolower($pokemon['pokemon_name'])));
                                    echo '<div class="pokemon">';
                                    echo '<div class="lefthalf">';
                                    echo '<span class="icon">';
                                    echo sprintf('<a href="pokemon.php?id=%u"><img src="%s"/></a>', $pkmnSpJson->id, $pkmnJson->sprites->front_default);
                                    echo '</span>';
                                    echo '<span class="manage">';
                                    // echo '<a href=""><img src="img/edit.png"/></a>';
                                    // echo '<a href=""><img src="img/delete.png"/></a>';
                                    echo '</span>';
                                    echo '</div>';
                                    echo '<div class="righthalf">';
                                    echo '<span class="info">';
                                    echo sprintf('<a href="pokemon.php?id=%u"><h2>%s</h2></a>', $pkmnSpJson->id, ucfirst($pkmnJson->name));
                                    echo '</span>';
                                    echo '<div class="moveset">';
                                    $moveset = getMoveSet($pokemon['moveset_id']);
                                    $logger->LogDebug(print_r($moveset, true));
                                    for($i = 1; $i <= 4; $i++)
                                    {
                                        if(!empty($moveset[0]["move" . $i]))
                                        {
                                            $moveJson = json_decode(file_get_contents("https://pokeapi.co/api/v2/move/" . str_replace(" ", "-", strtolower($moveset[0]["move" . $i]))));
                                            $id = $moveJson->id;
                                            $name = ucwords(str_replace("-", " ", $moveJson->name));

                                            echo sprintf('<a href="move.php?id=%u"><button>%s</button></a>', $id, $name);
                                        }

                                        else
                                        {
                                            echo '<button>--</button>';
                                        }
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
