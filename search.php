<?php
require 'init.php';
require CLASSES_PATH . "/KLogger.php";

$logger = new KLogger(LOG_PATH . '/log.txt', KLogger::DEBUG);
?>
<html>
    <head>
        <title>Pokésearch | </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/pokemon_list.css">
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
            <?php require_once 'layouts/header.php'; ?>
            <span class="content-body">
                <h1>Search</h1>
                <?php
                    //check search query
                    if(strlen($_GET['q']) < 3)
                    {
                        $errors[] = "Search term cannot be less than 3 characters.";
                        $class = "fail";
                    }

                    else
                    {
                        $list = file_get_contents("https://pokeapi.co/api/v2/pokemon-species?offset=0&limit=900");
                        $list = json_decode($list);

                        foreach($list->results as $result)
                        {
                            if(levenshtein(strtolower($_GET['q']), strtolower($result->name), 1, 2, 2) <= 4)
                            {
                                $matches[] = $result->name;
                            }
                        }

                        if(!isset($matches))
                        {
                            $errors[] = "No results found! Try checking your spelling and try again.";
                            $class = "fail";
                        }
                    }

                    //check for error messages
                    if(isset($errors) && !empty($errors))
                    {
                        echo "<div class='messages " . $class . "'>";
                        echo "<p><b>There was a problem with your search:</b></p>";
                        echo "<ul>";
                        foreach($errors as $error)
                        {
                            echo '<li><p>' . $error . '</p></li>';
                        }
                        echo "</ul>";
                        echo "</div>";
                    }

                    else
                    {
                        //check if there is an exact result, else look for close results
                        $url = "https://pokeapi.co/api/v2/pokemon/" . $_GET['q'];
                        $headers = get_headers($url, 1);
                        if(!$headers || $headers[0] == 'HTTP/1.1 404 Not Found')
                        {
                            echo "<h2>Here are your search results:</h2>";
                            echo '<div class="list">';
                            $logger->LogDebug("matchestype: " . gettype($matches));
                            foreach($matches as $match)
                            {
                                $pokemon = file_get_contents("https://pokeapi.co/api/v2/pokemon/" . $match);
                                $pokemon = json_decode($pokemon);

                                echo '<span class="pokemon">';
                                echo '<a href="pokemon.php?id=' . $pokemon->id .'">';
                                echo '<span class="icon">';
                                echo '<img src="' . $pokemon->sprites->front_default . '"/>';
                                echo '</span>';
                                echo '<span class="info">';
                                echo "<h3>" . ucfirst($pokemon->species->name) . "</h3>";
                                echo "<h3>" . formatNum($pokemon->id) . "</h3>";
                                echo '</span>';
                                echo '</a>';
                                echo '</span>';
                            }
                            echo '</div>';
                        }

                        else
                        {
                            $pokemon = file_get_contents($url);
                            $pokemon = json_decode($pokemon);
                            header('Location: pokemon.php?id=' . $pokemon->id);
                            exit;
                        }
                    }
                ?>
            </span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>

<?php
function formatNum($num)
{
    $numDigits = strlen((string) $num);
    $entryNum = "#" . str_pad((string) $num, 3, "0", STR_PAD_LEFT);

    return $entryNum;
}
?>
