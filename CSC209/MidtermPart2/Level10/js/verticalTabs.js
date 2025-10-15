function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function createTabs() {
    for (let i = 0; i < NRCITIES; i++) {
        var tab = document.createElement("div");
        tab.setAttribute("class", "tabcontent");
        var header = document.createElement("h3");
        var paragraph = document.createElement("p");
        if (i < CITIES.length) {
            tab.setAttribute("id", CITIES[i]);
            header.innerHTML = CITIES[i];
            paragraph.innerHTML = DESC[i];
        } else {
            //use last value as dummy value
            tab.setAttribute("id", `${CITIES[CITIES.length - 1]}-${i}`)
            header.innerHTML = CITIES[CITIES.length - 1];
            paragraph.innerHTML = DESC[CITIES.length - 1];
        }
        tab.appendChild(header);
        tab.appendChild(paragraph);
        document.body.appendChild(tab)
    }
    createCities();
}

function createCities() {
    var buttons = document.getElementById("buttons");
    for (let i = 0; i < NRCITIES; i++) {
        var button = document.createElement("button");
        button.setAttribute("class", "tablinks");
        if (i < CITIES.length) {
            button.setAttribute("onclick", `openCity(event, '${CITIES[i]}')`);
            if (i == 0) {
                //set default open for first item
                button.setAttribute("id", "defaultOpen")
            }
            var label = document.createTextNode(CITIES[i])
        } else {
            //use last value as dummy value
            button.setAttribute("onclick", `openCity(event, '${CITIES[CITIES.length - 1]}')`);
            var label = document.createTextNode(CITIES[CITIES.length - 1]);
        }
        button.appendChild(label)
        buttons.appendChild(button)
    }
    defaultOpen();
}

function defaultOpen() {
    document.getElementById("defaultOpen").click();
}