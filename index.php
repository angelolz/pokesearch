<?php require_once 'init.php'; ?>

<html>
    <head>
        <title>Pokésearch | Home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <?php require_once 'layouts/favicon.php'; ?>
    </head>
    <body>
        <?php require_once 'layouts/mininav.php'; ?>
        <div class="content">
        <?php require_once 'layouts/header.php'; ?>
			<span class="content-body">
			<p>Hello, Welcome to <strong>Pokésearch</strong>, an advanced
				information lookup page that allows you to find any information
				that you want relating to the Pokémon franchise!</p>
			<p>You can search information about Pokémon, their evolution chains,
				specific stuff about the Pokémon games, items and so much more!</p>
			<p>To start, click on one of the links above or type in whatever you're
				looking for in the search bar!</p>
			</span>
        </div>
        <?php require_once 'layouts/footer.php'; ?>
    </body>
</html>
