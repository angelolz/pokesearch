<span class="logo">
    <a href="index.php"><img src="img/logo.png"/></a>
</span>
<span class="userbox">
    <?php
    if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == 'true')
    {
        echo "<p class='loggedin'>Welcome, <strong>{$_SESSION['username']}</strong>!</p>";
        echo '<a href="profile.php" class="user-buttons">Profile</a>';
        echo '<a href="logout.php" class="user-buttons">Logout</a>';
    }

    else
    {
        echo "<p class='not-loggedin'>You are not logged in!</p>";
        echo '<a href="login.php" class="user-buttons">Login</a>';
        echo '<a href="register.php" class="user-buttons">Register</a>';
    }
    ?>
</span>
<span class="search-wrapper">
    <form class="search" role="search" action="search.php">
        <input type="text" placeholder="Search" name="q"></input>
        <select name="type">
            <option value="pokemon">Pokémon</option>
            <option value="moves">Moves</option>
            <option value="items">Items</option>
        </select>
        <button><img id="searchicon" src="img/searchicon.png"/></button>
    </form>
</span>
<hr>
<span class="navbar">
    <ul>
        <li><a href="pokemon_list.php">Pokémon</a></li>
        <li><a href="moves_list.php">Moves</a></li>
        <!-- <li><a href="wip.php">Games</a></li> -->
        <li id="last"><a href="items_list.php">Items</a></li>
        <!-- <li id="last"><a href="wip.php">Regions</a></li> -->
    </ul>
</span>
<hr>
