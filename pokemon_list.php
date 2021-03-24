<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Pokémon</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/pokemon_list.css">
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

                $pkmnList = file_get_contents(sprintf("https://pokeapi.co/api/v2/pokemon-species?offset=%u&limit=%u", (($page - 1) * $rpp), $rpp));
                $pkmnList = json_decode($pkmnList);
                $maxPages = ceil($pkmnList->count / $rpp);
                ?>
                <h1>Pokémon</h1>
                <div class="nav">
                    <?php createPagination($page, $rpp, $maxPages, $pkmnList->count); ?>
                </div>
                <div class="list">
                    <?php
                        if(count($pkmnList->results) == 0)
                        {
                            echo '<h3>No results found!</h3>';
                        }
                        for($i = 1; $i <= count($pkmnList->results); $i++)
                        {
                            $name = ucfirst($pkmnList->results[($i - 1)]->name);
                            $no = $i + (($page - 1) * $rpp);
                            $img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/" . $no . ".png";

                            echo '<span class="pokemon">';
                            echo '<a href="pokemon.php?id=' . $no .'">';
                            echo '<span class="icon">';
                            echo '<img src="' . $img . '"/>';
                            echo '</span>';
                            echo '<span class="info">';
                            echo "<h3>{$name}</h3>";
                            echo "<h3>#{$no}</h3>";
                            echo '</span>';
                            echo '</a>';
                            echo '</span>';
                        }
                    ?>
                </div>
                <div class="nav">
                    <?php createPagination($page, $rpp, $maxPages, $pkmnList->count); ?>
                </div>
            </span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>

<?php
    function createPagination(int $pageNum, int $rpp, int $maxPages, int $pkmnCount)
    {
        echo '<ul class="pagination">';

        //prev button
        if($pageNum == 1)
        {
            echo '<li id="prev">← prev</li>';
        }

        else
        {
            echo sprintf('<li id="prev"><a href="%s?page=%u&rpp=%u">← prev</a></li>', $_SERVER['PHP_SELF'], ($pageNum - 1), $rpp);
        }

        //if there are 10 pages or less
        if($maxPages <= 10)
        {
            for($i = 1; $i <= $maxPages; $i++)
            {
                if($i == $pageNum)
                {
                    echo "<li>{$pageNum}</li>";
                }

                else
                {
                    echo sprintf('<li><a href="%s?page=%u&rpp=%u">%u</a></li>', $_SERVER['PHP_SELF'], $i, $rpp, $i);
                }
            }
        }

        //more than 10 pages
        else
        {
            if($pageNum <= 5)
            {
                for($i = 1; $i < 10; $i++)
                {
                    if($i == $pageNum)
                    {
                        echo "<li>{$pageNum}</li>";
                    }

                    else
                    {
                        echo sprintf('<li><a href="%s?page=%u&rpp=%u">%u</a></li>', $_SERVER['PHP_SELF'], $i, $rpp, $i);
                    }
                }
            }

            //current page num is in the middle
            else
            {
                //if you're on the last 5 pages...
                if($pageNum >= $maxPages - 4)
                {
                    for($i = $maxPages - 8; $i <= $maxPages; $i++)
                    {
                        if($i == $pageNum)
                        {
                            echo "<li>{$pageNum}</li>";
                        }

                        else
                        {
                            echo sprintf('<li><a href="%s?page=%u&rpp=%u">%u</a></li>', $_SERVER['PHP_SELF'], $i, $rpp, $i);
                        }
                    }
                }

                else
                {
                    for($i = $pageNum - 4; $i <= $pageNum + 4; $i++)
                    {
                        if($i == $pageNum)
                        {
                            echo "<li>{$pageNum}</li>";
                        }

                        else
                        {
                            echo sprintf('<li><a href="%s?page=%u&rpp=%u">%u</a></li>', $_SERVER['PHP_SELF'], $i, $rpp, $i);
                        }
                    }
                }
            }
        }

        //next button
        if($pageNum == $maxPages)
        {
            echo '<li id="prev">next →</li>';
        }

        else
        {
            echo sprintf('<li id="next"><a href="%s?page=%u&rpp=%u">next →</a></li>', $_SERVER['PHP_SELF'], ($pageNum + 1), $rpp);
        }

        echo '</ul>';

        //results per page
        echo "<form>";
        echo '<label>show </label>';
        echo '<input id="currentPage" type="hidden" name="page" value="' . $pageNum . '">';
        echo sprintf('<select id="numResults" name="rpp" onchange="changeRPP(%s,%u);">', "this.form", $pkmnCount);

        $options = array(25, 50, 100);
        foreach($options as $option)
        {
            if($option == $rpp)
            {
                echo sprintf('<option value="%u" selected>%u</option>', $option, $option);
            }

            else
            {
                echo sprintf('<option value="%u">%u</option>', $option, $option);
            }
        }

        echo '</select>';
        echo '<label> results per page</label>';
        echo '</form>';
    }
?>
