<?php
    session_start();
    require_once 'init.php';
    require_once CLASSES_PATH . '/KLogger.php';
    $logger = new KLogger(LOG_PATH . '/log.txt', KLogger::DEBUG);
?>
<span class="logo">
    <a href="index.php"><img src="img/logo.png"/></a>
</span>
<span class="userbox">
    <?php
    if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == 'true')
    {
        echo "<p id='loggedin'>Welcome, <strong>{$_SESSION['username']}</strong>!</p>";
        echo '<a href="profile.php" class="user-buttons">Profile</a>';
        echo '<a href="logout.php" class="user-buttons">Logout</a>';
    }

    else
    {
        echo '<p>You are not logged in!</p>';
        echo '<a href="login.php" class="user-buttons">Login</a>';
        echo '<a href="register.php" class="user-buttons">Register</a>';
    }
    ?>
</span>
<span class="search-wrapper">
    <form class="search" role="search" action="wip.php">
        <input type="text" id="query" placeholder="Search anything here..." name="q"></input>
        <select id="type">
            <option value="pokemon">Pokémon</option>
            <option value="moves">Moves</option>
            <option value="items">Items</option>
        </select>
        <button id="submit"><img id="searchicon" src="img/searchicon.png"/></button>
    </form>
</span>
<hr>
<span class="navbar">
    <ul>
        <li><a href="pokemon_list.php">Pokémon</a></li>
        <li><a href="moves.php">Moves</a></li>
        <li><a href="wip.php">Games</a></li>
        <li><a href="wip.php">Items</a></li>
        <li id="last"><a href="wip.php">Regions</a></li>
    </ul>
</span>
<hr>
