<?php
require_once 'init.php';
require_once CLASSES_PATH . "/KLogger.php";
require_once FUNCTIONS_PATH . "/createPagination.php";

$logger = new KLogger(LOG_PATH . "/log.txt", KLogger::DEBUG);
?>

<html>
    <head>
        <title>Pokésearch | Moves</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/pagination.css">
        <link rel="stylesheet" type="text/css" href="css/moves_list.css">
        <script src="js/rpp.js"></script>
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
        <?php require_once 'layouts/header.php'; ?>
			<span class="content-body">
                <?php
                //get current page
                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    $page = (int) $_GET['page'];
                }

                else
                {
                    $page = 1;
                }

                //get results per page (rpp)
                if(isset($_GET['rpp']) && is_numeric($_GET['rpp']))
                {
                    $rpp = in_array($_GET['rpp'], array(30, 60, 90)) ? (int) $_GET['rpp'] : 30;
                }

                else
                {
                    $rpp = 25;
                }

                //get the list of moves and how many pages there should be based on rpp
                $list = file_get_contents(sprintf("https://pokeapi.co/api/v2/move?offset=%u&limit=%u", (($page - 1) * $rpp), $rpp));
                $list = json_decode($list);
                $maxPages = ceil($list->count / $rpp);
                ?>

                <h1>Moves</h1>

                <?php
                //if cache exists, load cache
                include FUNCTIONS_PATH . '/cacheListingStart.php';

                //else, prepare cache if there are results
                createPagination($page, $rpp, $maxPages, $list->count, array(30,60,90));
                echo '<div class="list">';
                if(count($list->results) == 0)
                {
                    echo '<h3>No results found!</h3>';
                }

                for($i = 1; $i <= count($list->results); $i++)
                {
                    $name = ucwords(str_replace("-", " ", $list->results[($i - 1)]->name));
                    $no = $i + (($page - 1) * $rpp);

                    echo '<div class="move">';
                    echo '<a href="item.php?id=' . $no .'"><p>' . $name . '</p></a>';
                    echo '</div>';
                }
                echo '</div>';
                createPagination($page, $rpp, $maxPages, $list->count, array(30,60,90));

                include FUNCTIONS_PATH . '/cacheListingEnd.php';
                ?>
            </span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
