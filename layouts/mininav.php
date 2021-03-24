<div id="mininav">
    <span id="mini-logo">
        <a href="index.php"><img class="logo" src="img/logo.png"/></a>
    </span>
    <span class="search-wrapper">
        <form class="search" role="search" action="search.php">
            <input type="text" placeholder="Search anything here..." name="q"></input>
            <select>
                <option value="pokemon">Pokémon</option>
                <option value="moves">Moves</option>
                <option value="items">Items</option>
            </select>
            <button><img id="searchicon" src="img/searchicon.png"/></button>
        </form>
    </span>
</div>

<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 20) {
    document.getElementById("mininav").style.top = "0";
  } else {
    document.getElementById("mininav").style.top = "-100px";
  }
}
</script>
