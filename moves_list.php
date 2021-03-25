<?php
require_once 'init.php';
require_once FUNCTIONS_PATH . "/createPagination.php";
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

                $moveList = file_get_contents(sprintf("https://pokeapi.co/api/v2/move?offset=%u&limit=%u", (($page - 1) * $rpp), $rpp));
                $moveList = json_decode($moveList);
                $maxPages = ceil($moveList->count / $rpp);
                ?>
                <h1>Moves</h1>
                <div class="nav">
                    <?php createPagination($page, $rpp, $maxPages, $moveList->count, array(30,60,90)); ?>
                </div>
                <div class="list">
                    <?php
                        if(count($moveList->results) == 0)
                        {
                            echo '<h3>No results found!</h3>';
                        }

                        for($i = 1; $i <= count($moveList->results); $i++)
                        {
                            $name = ucwords(str_replace("-", " ", $moveList->results[($i - 1)]->name));
                            $no = $i + (($page - 1) * $rpp);

                            echo '<div class="move">';
                            echo '<a href="item.php?id=' . $no .'"><p>' . $name . '</p></a>';
                            echo '</div>';
                        }
                    ?>
                </div>
                <div class="nav">
                    <?php createPagination($page, $rpp, $maxPages, $moveList->count, array(30,60,90)); ?>
                </div>
            </span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
