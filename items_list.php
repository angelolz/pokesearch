<?php
require_once 'init.php';
require_once FUNCTIONS_PATH . "/createPagination.php";
?>

<html>
    <head>
        <title>Pokésearch | Items</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/pagination.css">
        <link rel="stylesheet" type="text/css" href="css/items_list.css">
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
                    $rpp = in_array($_GET['rpp'], array(25, 50, 100)) ? (int) $_GET['rpp'] : 25;
                }

                else
                {
                    $rpp = 25;
                }

                $itemList = file_get_contents(sprintf("https://pokeapi.co/api/v2/item?offset=%u&limit=%u", (($page - 1) * $rpp), $rpp));
                $itemList = json_decode($itemList);
                $maxPages = ceil($itemList->count / $rpp);
                ?>
                <h1>Items</h1>
                <div class="nav">
                    <?php createPagination($page, $rpp, $maxPages, $itemList->count, array(25,50,100)); ?>
                </div>
                <div class="list">
                    <?php
                        if(count($itemList->results) == 0)
                        {
                            echo '<h3>No results found!</h3>';
                        }

                        for($i = 1; $i <= count($itemList->results); $i++)
                        {
                            $name = ucwords(str_replace("-", " ", $itemList->results[($i - 1)]->name));
                            $no = $i + (($page - 1) * $rpp);
                            $img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/" . $itemList->results[($i - 1)]->name . ".png";

                            echo '<span class="item">';
                            echo '<a href="item.php?id=' . $no .'">';
                            echo '<span class="icon">';
                            echo '<img src="' . $img . '"/>';
                            echo '</span>';
                            echo '<span class="info">';
                            echo "<h3>{$name}</h3>";
                            echo '</span>';
                            echo '</a>';
                            echo '</span>';
                        }
                    ?>
                </div>
                <div class="nav">
                    <?php createPagination($page, $rpp, $maxPages, $itemList->count, array(25,50,100)); ?>
                </div>
            </span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
