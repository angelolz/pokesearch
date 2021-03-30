<?php
require_once 'init.php';
require_once CLASSES_PATH . "/KLogger.php";
require FUNCTIONS_PATH . "/formatNum.php";

$logger = new KLogger(LOG_PATH . "/log.txt", KLogger::DEBUG);

//get total pokemon
$url = "https://pokeapi.co/api/v2/pokemon-species";
$count = json_decode(file_get_contents($url))->count;

//check if invalid national dex entry # in query
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    if($id > $count)
    {
        $id = 1;
    }
}

$url = sprintf("https://pokeapi.co/api/v2/pokemon-species?offset=%u&limit=%u", ($id-2 < 0 ? 0 : $id-2) , 3);
$pkmns = file_get_contents($url);
$pkmns = json_decode($pkmns);

//get info of pokemon and their species
$pkmnInfo = file_get_contents(sprintf("https://pokeapi.co/api/v2/pokemon/%u", $id));
$pkmnInfo = json_decode($pkmnInfo);

$pkmnSpInfo = file_get_contents(sprintf("https://pokeapi.co/api/v2/pokemon-species/%u", $id));
$pkmnSpInfo = json_decode($pkmnSpInfo);
?>

<html>
    <head>
        <title>Pokésearch | Pokémon</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/pokemon.css">
        <script src='js/changeBarStats.js'></script>
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body onload="changeBar()">
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
            <?php require_once 'layouts/header.php'; ?>
            <span class="content-body">
                    <?php
                    //previous pokemon
                    include FUNCTIONS_PATH . '/cacheStart.php';

                    if(!$cache)
                    {
                        echo '<div class="nav">';
                        if($id == 1)
                        {
                            echo '<p id="prev" class="hidden">← #???: ???</p>';
                        }

                        else
                        {
                            echo sprintf('<a href="%s?id=%u"><p id="prev">← %s: %s</p></a>', $_SERVER['PHP_SELF'], ($id - 1), formatNum($id - 1), ucfirst($pkmns->results[0]->name));
                        }

                        echo '<span class="current-pokemon">';
                        echo '<h1>'. ucfirst($pkmnSpInfo->name) . '</h1>';
                        echo '<h2>'. formatNum($id) . '</h2>';
                        echo '</span>';

                        //next pokemon
                        if($id == $count)
                        {
                            echo '<p id="next" class="hidden">#???: ??? →</p>';
                        }

                        else
                        {
                            if($id == 1)
                            {
                                echo sprintf('<a href="%s?id=%u"><p id="next">%s: %s →</p></a>', $_SERVER['PHP_SELF'], ($id + 1), formatNum($id + 1), ucfirst($pkmns->results[1]->name));
                            }

                            else
                            {
                                echo sprintf('<a href="%s?id=%u"><p id="next">%s: %s →</p></a>', $_SERVER['PHP_SELF'], ($id + 1), formatNum($id + 1), ucfirst($pkmns->results[2]->name));
                            }
                            $logger->LogDebug('formatting number = ' . ($id + 1));
                        }
                        echo '</div>';

                        //image
                        echo '<div class="viewer">';
                        echo '<span class="image">';
                        echo "<img src='{$pkmnInfo->sprites->front_default}'/>";
                        echo '</span>';
                        echo '</div>';

                        echo '<div class="info">';

                        echo '<div class="col" id="first">';
                        echo '<h2>Basic Information</h2>';
                        echo '<div class="stat">';
                        echo '<span class="key">Height</span>';
                        echo "<span class='value'><p>" . ($pkmnInfo->height / 10) . "m</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Weight</span>';
                        echo "<span class='value'><p>" . ($pkmnInfo->weight / 10) . "kg</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Type</span>';
                        if(count($pkmnInfo->types) == 2)
                        {
                            $type = sprintf("%s - %s", ucfirst($pkmnInfo->types[0]->type->name),
                                                       ucfirst($pkmnInfo->types[1]->type->name));
                        }

                        else
                        {
                            $type = ucfirst($pkmnInfo->types[0]->type->name);
                        }
                        echo "<span class='value'><p>{$type}</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Base EXP</span>';
                        echo "<span class='value'><p>{$pkmnInfo->base_experience}</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Growth Rate</span>';
                        echo "<span class='value'><p>" . ucfirst($pkmnSpInfo->growth_rate->name) . "</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Held Items</span>';
                        echo '<span class="value">';
                        if(count($pkmnInfo->held_items) != 0)
                        {
                            foreach($pkmnInfo->held_items as $item)
                            {
                                echo "<p>" . ucwords(str_replace("-", " ", $item->item->name)) . "</p>";
                            }
                        }

                        else
                        {
                            echo "<p><i>None</i></p>";
                        }
                        echo '</span>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="col" id="second">';
                        echo '<h2>Species Information</h2>';
                        echo '<div class="stat">';
                        echo '<span class="key">Color</span>';
                        echo "<span class='value'><p>" . ucfirst($pkmnSpInfo->color->name) . "</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Base Happiness</span>';
                        echo "<span class='value'><p>{$pkmnSpInfo->base_happiness}</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Capture Rate</span>';
                        echo "<span class='value'><p>{$pkmnSpInfo->capture_rate}</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Gender Ratio</span>';
                        echo sprintf("<span class='value'><p>%u ♀ : %u ♂</p></span>", $pkmnSpInfo->gender_rate, (8 - $pkmnSpInfo->gender_rate));
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Generation</span>';

                        $generation = json_decode(file_get_contents($pkmnSpInfo->generation->url));
                        $region = ucwords($generation->main_region->name);
                        echo "<span class='value'><p>{$region}</p></span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Egg Groups</span>';

                        echo "<span class='value'>";
                        foreach($pkmnSpInfo->egg_groups as $egg_group)
                        {
                            echo "<p>" . ucwords($egg_group->name) . "</p>";
                        }
                        echo "</span>";
                        echo '</div>';
                        echo '<div class="stat">';
                        echo '<span class="key">Hatch Counter</span>';
                        echo "<span class='value'><p>{$pkmnSpInfo->hatch_counter}</p></span>";
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="col" id="third">';
                        echo '<h2>Stats</h2>';
                        foreach($pkmnInfo->stats as $stat)
                        {
                            switch($stat->stat->name)
                            {
                                case "hp":
                                    $name = "HP";
                                    break;
                                case "attack":
                                    $name = "Attack";
                                    break;
                                case "defense":
                                    $name = "Defense";
                                    break;
                                case "special-attack":
                                    $name = "Sp. Atk";
                                    break;
                                case "special-defense":
                                    $name = "Sp. Atk";
                                    break;
                                case "speed":
                                    $name = "Speed";
                                    break;
                                default:
                                    $name = "????";
                                    break;
                            }

                            echo '<div class="bar">';
                            echo sprintf("<div class='stattext' id='%s' value='%u'>%s: %u</div>",
                                        $stat->stat->name, $stat->base_stat, $name, $stat->base_stat);
                            echo '</div>';
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
