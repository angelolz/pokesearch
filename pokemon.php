<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Pikachu</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/pokemon.css">
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
            <?php require_once 'layouts/header.php'; ?>
            <span class="content-body">
                <div class="nav">
                    <a href=""><p id="prev">← #024: Arbok</p></a>
                    <span class="current-pokemon">
                        <h1>Pikachu</h1>
                        <h2>#025</h2>
                    </span>
                    <a href=""><p id="next">#026: Raichu →</p></a>
                </div>
                <div class="viewer">
                    <span class="image">
                        <img src="img/pokeball.png"/>
                    </span>
                    <span class="select">
                        <h3>View different forms:</h3>
                        <div class="grid">
                            <p>Gender</p>
                            <button class="active">Male</button>
                            <button class="inactive">Female</button>
                        </div>
                        <div class="grid">
                            <p>Form</p>
                            <button class="active">Normal</button>
                            <button class="inactive">Shiny</button>
                        </div>
                        <div class="grid">
                        <p>Position</p>
                        <button class="active">Front</button>
                        <button class="inactive">Back</button>
                        </div>
                    </span>
                </div>
                <div class="info">
                    <div class="col" id="first">
                        <h2>Basic Information</h2>
                        <div class="stat">
                            <span class="key">Height</span>
                            <span class="value"><p>40cm</p></span>
                        </div>
                        <div class="stat">
                            <span class="key">Weight</span>
                            <span class="value"><p>6kg</p></span>
                        </div>
                        <div class="stat">
                            <span class="key">Type</span>
                            <span class="value"><p>Electric</p></span>
                        </div>
                        <div class="stat">
                            <span class="key">Base EXP</span>
                            <span class="value"><p>112</p></span>
                        </div>
                        <div class="stat">
                            <span class="key">Growth Rate</span>
                            <span class="value"><p>Medium Fast</p></span>
                        </div>
                        <div class="stat">
                            <span class="key">Held Items</span>
                            <span class="value">
                                <p>Oran Berry</p>
                                <p>Light Ball</p>
                            </span>
                        </div>
                    </div>
                    <div class="col" id="second">
                        <h2>Abilities</h2>
                        <span class="bar"><p>Ability #1</p></span>
                        <span class="bar"><p>Ability #2</p></span>

                        <h2>Available Moves</h2>
                        <span class="bar"><p>Move #1</p></span>
                        <span class="bar"><p>Move #2</p></span>
                        <span class="bar"><p>Move #3</p></span>
                        <span class="bar"><p>Move #4</p></span>
                    </div>
                    <div class="col" id="third">
                        <h2>Stats</h2>
                        <div class="bar">
                            <div class="stattext hp">HP: 35</div>
                        </div>
                        <div class="bar">
                            <div class="stattext atk">Attack: 55</div>
                        </div>
                        <div class="bar">
                            <div class="stattext def">HP: 40</div>
                        </div>
                        <div class="bar">
                            <div class="stattext sp-atk">HP: 50</div>
                        </div>
                        <div class="bar">
                            <div class="stattext sp-def">HP: 50</div>
                        </div>
                        <div class="bar">
                            <div class="stattext spd">HP: 50</div>
                        </div>
                    </div>
                </div>
            </span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
