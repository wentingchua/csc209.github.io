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

function addLinks() {
    const menu = document.getElementById("menu");
    for (let i = 0; i < NRPROJECTS; i++) {
        var link = document.createElement("a");
        if (i < REFS.length) { //using first 3 values of array
            link.setAttribute("href", REFS[i])
            var label = document.createTextNode(LABELS[i]);
            link.appendChild(label);
        } else { //using last value of array as dummy value
            link.setAttribute("href", REFS[NRPROJECTS.length - 1])
            var label = document.createTextNode(LABELS[NRPROJECTS.length - 1]);
            link.appendChild(label);
        }
        menu.appendChild(link);
    }
}