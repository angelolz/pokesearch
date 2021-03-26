window.onscroll = function() {scrollFunction();};

function scrollFunction() {
  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 20) {
    document.getElementById("mininav").style.top = "0";
  } else {
    document.getElementById("mininav").style.top = "-100px";
  }
}
