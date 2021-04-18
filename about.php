<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | About Us</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/about.css">
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
        <?php require_once 'layouts/header.php'; ?>
        <span class="content-body">
            <h1>About</h1>
            <div class="text-block">

            <p>Hey there! Welcome to Pokésearch. I made this website as my project
                for my <i>Intro to Web Development Class</i>. The class was really fun and
                I've learned so much stuff from this class, even though I've faced
                many, many difficulties as I was creating this site.
            </p>

            <p>When I was thinking of a website to make, I decided to do something that would
                be API-driven. I was used to using APIs already since I've used an Animal Crossing
                Lookup API called <a href="https://api.nookipedia.com/">Nookipedia</a> for my
                <a href="https://top.gg/bot/701038771776520222">Animal Crossing Discord bot</a> before. Turns out
                that there was a <a href="https://pokeapi.co/">nice API</a> for Pokémon games, and I figured that it would be
                easy to make a website that implements this API! <i>(Spoiler alert: it wasn't.)</i>
            </p>

            <p>Despite the hardships that I've went through, it was really fun for me to create this website and figure out
                how I would be able to use 5 different languages/markups <i>(PHP, JS, MySQL, CSS, HTML)</i> in one semester.
            </p>

            <p>I wanna thank all my friends who gave me improvements to make while I was making this website, especially helping me
                figure out what some of the information from the PokéRest API meant (since I don't really play Pokémon games, oops).
                I also want to thank my professor for making a class fun and interesting to learn about, while still teaching the content
                excellently.
            </p>

            <p>I hope you enjoy the website, and if you like it, please consider showing some of your support through
                <a href="https://ko-fi.com/angelolz">Ko-Fi</a>! If you discover any problems or would like to give some suggestions, please
                <a href="contact.php">contact me</a>.
            </div>
        </span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
