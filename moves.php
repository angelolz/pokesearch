<html>
    <head>
        <title>Pokésearch | </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/moves_list.css">
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
            <h1>Moves</h1>
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
                            <option>30</option>
                            <option>60</option>
                            <option>90</option>
                        </select>
                        <label>results per page</label>
                    </form>
                </div>
                <div class="list">
                    <?php
                        for($i = 1; $i <= 30; $i++)
                        {
                            echo '<div class="move">';
                            echo "<a href=\"\"><p>Pokemon Move #{$i}</p></a>";
                            echo '</div>';
                        }
                    ?>
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
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>
