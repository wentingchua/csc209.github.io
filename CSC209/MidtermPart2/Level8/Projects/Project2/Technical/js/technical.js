const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const courses = ["csc209", "csc262", "gov240", "compsci485", "ast103"];
const checkBoxIds = ["className", "dateTime", "location", "courseSyllabus", "lectureSlide", "courseLink"];
const isChecked = [true, true, true, true, true, true];

function toggleText() {
    var text = document.getElementById("secret");
    var button = document.getElementById("secretButton")
    if (text.innerText === "") {
        text.innerText = "This is a secret text!";
        button.innerText = "Hide";
    } else {
        text.innerText = "";
        button.innerText = "ReadMe";
    }
}
function showCredits() {
    var text = document.getElementById("credits");
    var button = document.getElementById("creditButton")
    if (text.innerText === "") {
        text.innerHTML = "<p>This site was created using the tutorials from <a href='https://www.w3schools.com'>www.w3schools.com</a></p>";
        button.innerText = "Hide";
    } else {
        text.innerText = "";
        button.innerText = "Credits";
    }
}
function toggleDate() {
    var text = document.getElementById("date");
    var button = document.getElementById("dateButton");
    if (text.innerText === "") {
        const d = new Date();
        const day = weekday[d.getDay()];
        const date = d.getDate();
        const month = d.getMonth();
        const year = d.getFullYear();
        text.innerText = day + "," + month + "/" + date + "/" + year;
        button.innerText = "Hide";
    } else {
        text.innerText = "";
        button.innerText = "Show date";
    }
}
function toggleSchedule() {
    var schedule = document.getElementById("schedule");
    var button = document.getElementById("scheduleButton");
    if (schedule) {
        if (schedule.style.display == "none") {
            schedule.style.display = "block";
            for (const course of courses) {
                showRow(course)
            }
            button.innerText = "Hide schedule"
        } else {
            schedule.style.display = "none"
            button.innerText = "Show schedule"
        }
    }
}
function toggleMenu() {
    var horiMenu = document.getElementById("horiMenu")
    var vertMenu = document.getElementById("vertMenu")
    isHorizontalMenu = (horiMenu.style.display !== "none")
    if (isHorizontalMenu) {
        horiMenu.style.display = "none"
        vertMenu.style.display = "block"
    } else {
        horiMenu.style.display = "flex"
        vertMenu.style.display = "none"
    }
}
function toggleStyle() {
    var currentStylesheet = document.getElementById("stylesheet");
    var profile = document.getElementById("profile")
    var topImage = document.getElementById("topImage")
    if (currentStylesheet.getAttribute("href") === "css/technicalLight.css") {
        currentStylesheet.href = "css/technicalDark.css";
        topImage.src = "Assets/dark.jpg";
    } else {
        currentStylesheet.href = "css/technicalLight.css";
        topImage.src = "Assets/light.jpg";
    }
}
function hideRow(rowId) {
    var row = document.getElementById(rowId)
    row.style.display = "none"
}
function showRow(rowId) {
    var row = document.getElementById(rowId)
    row.style.display = "table-row"
}
function handleAllFilterCheck() {
    var checkBox = document.getElementById('all');
    var schedule = document.getElementById("schedule")
    if (schedule.style.display == "none") {
        alert("Ensure the 'Show schedule' button is pressed!")
        checkBox.checked = false;
        return;
    }
    if (checkBox.checked) {
        for (let i = 0; i < checkBoxIds.length; i++) {
            const checkBoxId = checkBoxIds[i]
            showCol(checkBoxId, i);
        }
    } else {
        for (let i = 0; i < checkBoxIds.length; i++) {
            const checkBoxId = checkBoxIds[i]
            hideCol(checkBoxId, i);
        }
        toggleSchedule();
    }
}
function handleFilterCheck(checkBoxId) {
    var checkBox = document.getElementById(checkBoxId);
    const colId = checkBoxIds.indexOf(checkBoxId);
    if (checkBox.checked) {
        isChecked[colId] = true;
        updateAllCheckBox();
        showCol(checkBoxId, colId);
    } else {
        isChecked[colId] = false;
        updateAllCheckBox();
        hideCol(checkBoxId, colId);
    }
}
function updateAllCheckBox() {
    var checkBox = document.getElementById('all');
    for (let i = 0; i < isChecked.length; i++) {
        if (!isChecked[i]) {
            checkBox.checked = false;
            return;
        }
    }
    checkBox.checked = true;
}
function hideCol(checkBoxId) {
    var checkBox = document.getElementById(checkBoxId);
    var table = document.getElementById("schedule");
    const colId = checkBoxIds.indexOf(checkBoxId);
    checkBox.checked = false;
    for (let row of table.rows) {
        row.cells[colId].style.display = "none"
    }
}
function showCol(checkBoxId) {
    var checkBox = document.getElementById(checkBoxId);
    var table = document.getElementById("schedule");
    const colId = checkBoxIds.indexOf(checkBoxId);
    checkBox.checked = true;
    for (let row of table.rows) {
        row.cells[colId].style.display = "table-cell"
    }
}