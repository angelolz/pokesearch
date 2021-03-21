<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Profile</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
        <?php require 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require 'layouts/mininav.php'; ?>
        <div class="content">
            <?php require 'layouts/header.php'; ?>
            <?php
                if(!isset($_SESSION['authenticated']))
                {
                    $_SESSION['messages'][] = array("You must be logged in to view this page.");
                    $_SESSION['class'] = 'fail';
                    header('Location: login.php');
                    exit;
                }
            ?>
            <div class="container">
                <div class="sidebar left">
                    <h3>Your Teams</h3>
                    <span class="manage-teams">
                        <button>+ Team</button>
                        <button>+ Folder</button>
                    </span>
                    <span class="teams-list">
                        <ul id="list">
                            <li class="folder">
                                Favorite Builds
                                <ul class="nested">
                                    <li>Team 1</li>
                                    <li>Team 2</li>
                                </ul>
                            </li>
                            <li class="folder">
                                Experimental Builds
                                <ul class="nested">
                                    <li>Team 3</li>
                                    <li>Team 4</li>
                                </ul>
                            </li>
                        </ul>
                    </span>

                    <script>
                        var toggler = document.getElementsByClassName("folder");
                        var i;

                        for (i = 0; i < toggler.length; i++) {
                          toggler[i].addEventListener("click", function() {
                            this.parentElement.querySelector(".nested").classList.toggle("active");
                            this.classList.toggle("folder-open");
                          });
                        }
                    </script>
                </div>
                <div class="sidebar right">
                    <h1>Team 1</h1>
                    <?php
                        for($i = 1; $i <= 6; $i++)
                        {
                            echo '<div class="pokemon">';
                            echo '<div class="lefthalf">';
                            echo '<span class="icon">';
                            echo '<img src="img/pokeball.png"/>';
                            echo '</span>';
                            echo '<span class="manage">';
                            echo '<a href=""><img src="img/edit.png"/></a>';
                            echo '<a href=""><img src="img/delete.png"/></a>';
                            echo '</span>';
                            echo '</div>';
                            echo '<div class="righthalf">';
                            echo '<span class="info">';
                            echo "<h2>Pokemon #{$i}</h2>";
                            echo '<p>Item: Dragon Fang</p>';
                            echo '<p>Ability: Intimidate</p>';
                            echo '</span>';
                            echo '<div class="moveset">';
                            echo '<button>Example Move</button>';
                            echo '<button>Example Move</button>';
                            echo '<button>Example Move</button>';
                            echo '<button>Example Move</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                    <!-- <div class="pokemon">
                        <div class="lefthalf">
                            <span class="icon">
                                <img src="img/pokeball.png"/>
                            </span>
                            <span class="manage">
                                <a href=""><img src="img/edit.png"/></a>
                                <a href=""><img src="img/delete.png"/></a>
                            </span>
                        </div>
                        <div class="righthalf">
                            <span class="info">
                                <h2>Pokemon #1</h2>
                                <p>Item: Dragon Fang</p>
                                <p>Ability: Intimidate</p>
                            </span>
                            <div class="moveset">
                                <button>Example Move</button>
                                <button>Example Move</button>
                                <button>Example Move</button>
                                <button>Example Move</button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

        <?php require 'layouts/footer.php'; ?>
    </body>
</html>
