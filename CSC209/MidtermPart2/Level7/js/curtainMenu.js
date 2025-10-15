function toggleNav() {
    var navWidth = document.getElementById("myNav").style.width;
    if (navWidth == "100%") {
        //close
        document.getElementById("myNav").style.width = "0%";
    } else {
        //open
        document.getElementById("myNav").style.width = "100%";
    }
}