<?php
require_once 'init.php';
require_once CLASSES_PATH . "/KLogger.php";
require FUNCTIONS_PATH . "/formatNum.php";

$logger = new KLogger(LOG_PATH . "/log.txt", KLogger::DEBUG);

//get total pokemon
$url = "https://pokeapi.co/api/v2/item";
$count = json_decode(file_get_contents($url))->count;

//check if invalid national dex entry # in query
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    if($id > $count)
    {
        $id = 1;
    }
}

$url = sprintf("https://pokeapi.co/api/v2/move?offset=%u&limit=%u", ($id-2 < 0 ? 0 : $id-2) , 3);
$moves = file_get_contents($url);
$moves = json_decode($moves);

//get info of pokemon and their species
$moveInfo = file_get_contents(sprintf("https://pokeapi.co/api/v2/move/%u", $id));
$moveInfo = json_decode($moveInfo);
?>

<html>
    <head>
        <title>Pokésearch | Move</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/item.css">
        <script src='js/changeBarStats.js'></script>
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
            <?php require_once 'layouts/header.php'; ?>
            <span class="content-body">
                <?php
                include FUNCTIONS_PATH . '/cacheStart.php';
                echo '<div class="nav">';

                if(!$cache)
                {
                    //prev move
                    if($id == 1)
                    {
                        echo '<p id="prev" class="hidden">← #???: ???</p>';
                    }

                    else
                    {
                        echo sprintf('<a href="%s?id=%u"><p id="prev">← %s</p></a>', $_SERVER['PHP_SELF'], ($id - 1), ucfirst($moves->results[0]->name));
                    }

                    echo '<span class="current-item">';
                    echo '<h1>'. ucwords(str_replace("-", " ", $moveInfo->name)) . '</h1>';
                    echo '</span>';

                    //next move
                    if($id == $count)
                    {
                        echo '<p id="next" class="hidden">#???: ??? →</p>';
                    }

                    else
                    {
                        if($id == 1)
                        {
                            echo sprintf('<a href="%s?id=%u"><p id="next">%s →</p></a>', $_SERVER['PHP_SELF'], ($id + 1), ucfirst($moves->results[1]->name));
                        }

                        else
                        {
                            echo sprintf('<a href="%s?id=%u"><p id="next">%s →</p></a>', $_SERVER['PHP_SELF'], ($id + 1), ucfirst($moves->results[2]->name));
                        }
                    }
                    echo '</div>';

                    echo '<p><i>"' . $moveInfo->flavor_text_entries[0]->flavor_text . '"</i></p>';

                    echo '<div class="info">';
                    echo '<div class="col" id="left">';
                    echo '<h2>Move Information</h2>';
                    echo '<div class="stat">';
                    echo '<span class="key">Type</span>';
                    echo '<span class="value">' . ucfirst($moveInfo->type->name) . '</span>';
                    echo '</div>';
                    echo '<div class="stat">';
                    echo '<span class="key">Power</span>';
                    echo '<span class="value">' . $moveInfo->power . '</span>';
                    echo '</div>';
                    echo '<div class="stat">';
                    echo '<span class="key">Accuracy</span>';
                    echo '<span class="value">' . $moveInfo->accuracy . '</span>';
                    echo '</div>';
                    echo '<div class="stat">';
                    echo '<span class="key">PP</span>';
                    echo '<span class="value">' . $moveInfo->pp . '</span>';
                    echo '</div>';
                    echo '<div class="stat">';
                    echo '<span class="key">Damage Class</span>';
                    echo '<span class="value">' . ucfirst($moveInfo->damage_class->name) . '</span>';
                    echo '</div>';
                    echo '<div class="stat">';
                    echo '<span class="key">Effect Chance</span>';
                    echo '<span class="value">' . ($moveInfo->effect_chance == null ? "N/A" : $moveInfo->effect_chance . "%") . '</span>';
                    echo '</div>';
                    echo '<div class="stat-list">';
                    echo '<span class="name"><h3>Target</h3></span>';
                    echo '<span class="list">';
                    echo '<h2>' . ucwords(str_replace("-", " ", $moveInfo->target->name) . "</h2>");
                    $targetPage = json_decode(file_get_contents($moveInfo->target->url));
                    foreach($targetPage->descriptions as $description)
                    {
                        if($description->language->name == "en")
                        {
                            echo '<p>' . $description->description . '</p>';
                        }
                    }
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="stat-list">';
                    echo '<span class="name"><h3>Move Effects</h3></span>';
                    echo '<span class="list">';
                    echo '<ul>';
                    foreach($moveInfo->effect_entries as $effect)
                    {
                        if($effect->language->name == "en")
                        {
                            echo '<li>' . str_replace('$effect_chance', $moveInfo->effect_chance, $effect->short_effect) . '</li>';
                        }
                    }
                    echo '</ul>';
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="stat-list">';
                    echo '<span class="name"><h3>Stat Changes</h3></span>';
                    echo '<span class="list">';
                    if(count($moveInfo->stat_changes) == 0)
                    {
                        echo '<p>No changes.</p>';
                    }

                    else
                    {
                        echo '<ul>';
                        foreach($moveInfo->stat_changes as $stat)
                        {
                            echo sprintf("<li>%s %s</li>", $stat->change, ucfirst($stat->stat->name));
                        }
                        echo '</ul>';
                    }
                    echo '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col" id="right">';
                    echo '<h2>Pokémon that can learn this move:</h2>';

                    if(count($moveInfo->learned_by_pokemon) == 0)
                    {
                        echo '<p>No Pokémon learns this move.</p>';
                    }

                    else
                    {
                        echo '<span class="pkmn-list">';
                        foreach($moveInfo->learned_by_pokemon as $pokemon)
                        {
                            $pkmnPage = json_decode(file_get_contents($pokemon->url));
                            $pkmnSpPage = json_decode(file_get_contents($pkmnPage->species->url));

                            echo '<div class="pokemon">';
                            echo '<a href="pokemon.php?id=' . $pkmnSpPage->id . '">';
                            echo '<span class="icon">';
                            echo '<img src="' . $pkmnPage->sprites->front_default . '">';
                            echo '</span>';
                            echo '<span class="info">';
                            echo '<h3>'. ucfirst($pkmnSpPage->name) . '</h3>';
                            echo '<h3>'. formatNum($pkmnSpPage->id) . '</h3>';
                            echo '</span>';
                            echo '</a>';
                            echo '</div>';
                        }
                        echo '</span>';
                    }

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    include FUNCTIONS_PATH . '/cacheEnd.php';
                }
                ?>
            </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
