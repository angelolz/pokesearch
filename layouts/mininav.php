<?php
    session_start();
    require_once 'init.php';
    require_once CLASSES_PATH . '/KLogger.php';
    $logger = new KLogger(LOG_PATH . '/log.txt', KLogger::DEBUG);
?>

<div id="mininav">
    <span id="mini-logo">
        <a href="index.php"><img class="logo" src="img/logo.png"/></a>
    </span>
    <span class="search-wrapper">
        <form class="search" role="search" action="search.php">
            <input type="text" placeholder="Search" name="q"></input>
            <select>
                <option value="pokemon">Pokémon</option>
                <option value="moves">Moves</option>
                <option value="items">Items</option>
            </select>
            <button><img id="searchicon" src="img/searchicon.png"/></button>
        </form>
    </span>
    <span class="userbox">
        <?php
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == 'true')
        {
            echo "<p class='loggedin'>Welcome, <strong>{$_SESSION['username']}</strong>!</p>";
            echo '<span class="mini-button-group">';
            echo '<a href="profile.php" class="mini-user-buttons">Profile</a>';
            echo '<a href="logout.php" class="mini-user-buttons">Logout</a>';
            echo '</span>';
        }

        else
        {
            echo "<p class='not-loggedin'>Not logged in!</p>";
            echo '<span class="mini-button-group">';
            echo '<a href="login.php" class="mini-user-buttons">Login</a>';
            echo '<a href="register.php" class="mini-user-buttons">Register</a>';
            echo '</span>';
        }
        ?>
    </span>
</div>
<script src="js/mininavShow.js"></script>
