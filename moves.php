<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | </title>
        <meta charset="UTF-8">
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
            <?php require_once 'layouts/header.php'; ?>
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
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
