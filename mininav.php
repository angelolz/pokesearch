<div id="mininav">
    <span id="mini-logo">
        <a href="index.php"><img class="logo" src="img/logo.png"/></a>
    </span>
    <span class="search-wrapper">
        <form id="search" role="search"action="search.php">
            <input type="text" id="query" placeholder="Search anything here..." name="q"></input>
            <button id="submit"><img id="searchicon" src="img/searchicon.png"/></button>
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
