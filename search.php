<?php
require 'init.php';
require CLASSES_PATH . "/KLogger.php";
require FUNCTIONS_PATH . "/formatNum.php";

$logger = new KLogger(LOG_PATH . '/log.txt', KLogger::DEBUG);

if(isset($_GET['type']))
{
    $type = in_array($_GET['type'], array("pokemon", "moves", "items")) ? $_GET['type'] : 'pokemon';
}

else
{
    $type = 'pokemon';
}

switch($type)
{
    case "pokemon":
        $endpoint = "pokemon-species";
        $css = "pokemon_list";
        $php = "pokemon";
        break;
    case "moves":
        $endpoint = "move";
        $css = "moves_list";
        $php = "move";
        break;
    case "items":
        $endpoint = "item";
        $css = "items_list";
        $php = "item";
        break;
}
?>
<html>
    <head>
        <title>Pokésearch | Search</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <?php echo '<link rel="stylesheet" type="text/css" href="css/' . $css . '.css">'; ?>
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
            <?php require_once 'layouts/header.php'; ?>
            <script src=https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js></script>
            <script src=js/closeBox.js></script>
            <span class="content-body">
                <h1>Search</h1>
                <?php
                    //check search query
                    if(strlen($_GET['q']) < 4)
                    {
                        $errors[] = "Search term cannot be less than 4 characters.";
                        $class = "fail";
                    }

                    else
                    {
                        $list = file_get_contents("https://pokeapi.co/api/v2/{$endpoint}?offset=0&limit=1000");
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
                        echo "<span id='close'>x</span>";
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

                        //the url accepts numbers for an id,
                        //so doing this line prevents people from just searching numbers
                        $url = "https://pokeapi.co/api/v2/{$endpoint}/" . str_replace(" ", "-", strtolower($_GET['q']));
                        $headers = get_headers($url, 1);
                        include FUNCTIONS_PATH . '/cacheSearchStart.php';


                        if(!$headers || $headers[0] == 'HTTP/1.1 404 Not Found')
                        {
                            if(!$cache)
                            {
                                echo "<h2>Here are your search results:</h2>";
                                echo '<div class="list">';
                                foreach($matches as $match)
                                {
                                    $json = file_get_contents("https://pokeapi.co/api/v2/{$php}/" . $match);
                                    $json = json_decode($json);

                                    switch($type)
                                    {
                                        case "pokemon":
                                            echo '<span class="pokemon">';
                                            echo '<a href="pokemon.php?id=' . $json->id .'">';
                                            echo '<span class="icon">';
                                            echo '<img src="' . $json->sprites->front_default . '"/>';
                                            echo '</span>';
                                            echo '<span class="info">';
                                            echo "<h3>" . ucfirst($json->species->name) . "</h3>";
                                            echo "<h3>" . formatNum($json->id) . "</h3>";
                                            echo '</span>';
                                            echo '</a>';
                                            echo '</span>';
                                            break;
                                        case "moves":
                                            $name = ucwords(str_replace("-", " ", $json->name));

                                            echo '<div class="move">';
                                            echo '<a href="move.php?id=' . $json->id .'"><p>' . $name . '</p></a>';
                                            echo '</div>';
                                            break;
                                        case "items":
                                            $name = ucwords(str_replace("-", " ", $json->name));

                                            echo '<span class="item">';
                                            echo '<a href="item.php?id=' . $json->id .'">';
                                            echo '<span class="icon">';
                                            echo '<img src="' . $json->sprites->default . '"/>';
                                            echo '</span>';
                                            echo '<span class="info">';
                                            echo "<h3>{$name}</h3>";
                                            echo '</span>';
                                            echo '</a>';
                                            echo '</span>';
                                            break;
                                    }
                                }
                                echo '</div>';
                                include FUNCTIONS_PATH . '/cacheEnd.php';
                            }
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
