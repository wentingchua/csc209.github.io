function handleRefresh() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        users = JSON.parse(this.responseText)
        makeTable(users)
    }
    xhttp.open("GET", "../php/userJson.php")
    xhttp.send()
}

function handleDeleteButtonPressed(username) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const resp = this.responseText.trim();
        if (resp === "Delete Success") {
            handleRefresh();
        } else {
            console.error("Delete failed:", resp);
        }
    };
    xhttp.open("POST", "../php/deleteUser.php")
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + encodeURIComponent(username));
}

function handleEditButtonPressed(username, password, field) {
    let newValue = field == "username" ? prompt("Change username to: ", username) : prompt("Change password to: ", password);
    if (newValue) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            const resp = this.responseText.trim();
            if (resp === "Edit Success") {
                handleRefresh();
            } else {
                console.error("Edit failed:", resp);
            }
        };
        const params = new URLSearchParams();
        params.append('username', username);
        params.append('value', newValue);
        params.append('field', field);
        xhttp.open("POST", "../php/editUser.php")
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(params.toString());
    }
}

function editComplete(username, password) {

}