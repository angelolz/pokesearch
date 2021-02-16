<html>
    <head>
        <title>Pokésearch | Pikachu</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/pokemon_list.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&display=swap" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="fav/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png">
        <link rel="manifest" href="fav/site.webmanifest">
        <link rel="mask-icon" href="fav/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <?php require 'mininav.php'; ?>
        <div class="content">
        <?php require 'header.php'; ?>
			<span class="content-body">
                <h1>Pokémon</h1>
                <div class="nav">
                    <ul id="pagination">
                        <li id="prev"><a href="">← prev</a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">5</a></li>
                        <li>...</li>
                        <li><a href="">45</a></li>
                        <li id="next"><a href="">next →</a></li>
                    </ul>
                    <form>
                        <label>show</label>
                        <select>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <label>results per page</label>
                    </form>
                </div>
                <div class="list">
                    <?php
                        for($i = 1; $i <= 25; $i++)
                        {

                            echo '<span class="pokemon">';
                            echo '<a href="pokemon.php">';
                            echo '<span class="icon">';
                            echo '<img src="img/pokeball.png"/>';
                            echo '</span>';
                            echo '<span class="info">';
                            echo '<h3>Pokémon</h3>';
                            echo "<h3>#{$i}</h3>";
                            echo '</span>';
                            echo '</a>';
                            echo '</span>';
                        }
                    ?>
                    <!-- <span class="pokemon">
                        <a href="pokemon.php">
                            <span class="icon">
                                    <img src="img/pokeball.png"/>
                            </span>
                            <span class="info">
                                <h3>Pokémon</h3>
                                <h3>#001</h3>
                            </span>
                        </a>
                    </span> -->
                </div>
                <div class="nav">
                    <ul id="pagination">
                        <li id="prev"><a href="">← prev</a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">5</a></li>
                        <li>...</li>
                        <li><a href="">45</a></li>
                        <li id="next"><a href="">next →</a></li>
                    </ul>
                    <form>
                        <label>show</label>
                        <select>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <label>results per page</label>
                    </form>
                </div>
            </span>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>
