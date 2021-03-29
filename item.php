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

$url = sprintf("https://pokeapi.co/api/v2/item?offset=%u&limit=%u", ($id-2 < 0 ? 0 : $id-2) , 3);
$items = file_get_contents($url);
$items = json_decode($items);

//get info of pokemon and their species
$itemInfo = file_get_contents(sprintf("https://pokeapi.co/api/v2/item/%u", $id));
$itemInfo = json_decode($itemInfo);
?>

<html>
    <head>
        <title>Pokésearch | Item</title>
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
                if(!$cache)
                {
                    echo '<div class="nav">';

                    //prev item
                    if($id == 1)
                    {
                        echo '<p id="prev" class="hidden">← #???: ???</p>';
                    }

                    else
                    {
                        echo sprintf('<a href="%s?id=%u"><p id="prev">← %s: %s</p></a>', $_SERVER['PHP_SELF'], ($id - 1), formatNum($id - 1), ucwords(str_replace("-", " ", $items->results[0]->name)));
                    }

                    echo '<span class="current-item">';
                    echo '<h1>'. ucwords(str_replace("-", " ", $itemInfo->name)) . '</h1>';
                    echo '</span>';

                    //next item
                    if($id == $count)
                    {
                        echo '<p id="next" class="hidden">#???: ??? →</p>';
                    }

                    else
                    {
                        if($id == 1)
                        {
                            echo sprintf('<a href="%s?id=%u"><p id="next">%s: %s →</p></a>', $_SERVER['PHP_SELF'], ($id + 1), formatNum($id + 1), ucwords(str_replace("-", " ", $items->results[1]->name)));
                        }

                        else
                        {
                            echo sprintf('<a href="%s?id=%u"><p id="next">%s: %s →</p></a>', $_SERVER['PHP_SELF'], ($id + 1), formatNum($id + 1), ucwords(str_replace("-", " ", $items->results[2]->name)));
                        }
                        $logger->LogDebug('formatting number = ' . ($id + 1));
                    }
                    echo '</div>';
                    echo '<div class="viewer">';
                    echo '<span class="image"><img src=' . $itemInfo->sprites->default . '></span>';
                    echo '</div>';

                    echo '<p><i>"' . $itemInfo->flavor_text_entries[0]->text . '"</i></p>';

                    echo '<div class="info">';
                    echo '<div class="col" id="left">';
                    echo '<h2>Item Information</h2>';
                    echo '<div class="stat">';
                    echo '<span class="key">Category</span>';
                    echo '<span class="value">' . ucwords(str_replace("-", " ", $itemInfo->category->name)) . '</span>';
                    echo '</div>';
                    echo '<div class="stat">';
                    echo '<span class="key">Cost</span>';

                    $cost = $itemInfo->cost == 0 ? "N/A" : $itemInfo->cost . "₱";
                    echo '<span class="value">' . $cost . '</span>';
                    echo '</div>';
                    echo '<div class="stat-list">';
                    echo '<span class="name"><h3>Attributes</h3></span>';
                    echo '<span class="list">';
                    foreach($itemInfo->attributes as $attribute)
                    {
                        echo '<h2>' . ucwords(str_replace("-", " ", $attribute->name) . "</h2>");

                        $attrPage = json_decode(file_get_contents($attribute->url));
                        foreach($attrPage->descriptions as $description)
                        {
                            if($description->language->name == "en")
                            {
                                echo '<p>' . $description->description . '.</p>';
                            }
                        }
                    }
                    echo '</span>';
                    echo '</div>';
                    echo '<div class="stat-list">';
                    echo '<span class="name"><h3>Item Effects</h3></span>';
                    echo '<span class="list">';
                    echo '<ul>';
                    foreach($itemInfo->effect_entries as $effect)
                    {
                        if($effect->language->name == "en")
                        {
                            echo '<li>' . $effect->short_effect . '</li>';
                        }
                    }
                    echo '</ul>';
                    echo '</span>';
                    echo '</div>';

                    if($itemInfo->fling_effect != null)
                    {
                        echo '<div class="stat-list">';
                        echo '<span class="name"><h3>Fling Effects</h3></span>';
                        echo '<span class="list">';
                        echo '<div class="stat">';
                        echo '<span class="key">Fling Power</span>';
                        echo '<span class="value">' . $itemInfo->fling_power . '</span>';
                        echo '</div>';

                        $flingPage = json_decode(file_get_contents($itemInfo->fling_effect->url));
                        foreach($flingPage->effect_entries as $effect)
                        {
                            if($effect->language->name == "en")
                            {
                                echo '<p>' . $effect->effect . '</p>';
                            }
                        }
                        echo '</span>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '<div class="col" id="right">';
                    echo '<h2>Pokémon that holds this item:</h2>';

                    if(count($itemInfo->held_by_pokemon) == 0)
                    {
                        echo '<p>No Pokémon holds this item.</p>';
                    }

                    else
                    {
                        echo '<span class="pkmn-list">';
                        foreach($itemInfo->held_by_pokemon as $pokemon)
                        {
                            $pkmnPage = json_decode(file_get_contents($pokemon->pokemon->url));
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
                    echo '</span>';

                    include FUNCTIONS_PATH . '/cacheEnd.php';
                }
                ?>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
