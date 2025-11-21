function startTimer() {
    loginStartTime = new Date();
}

function timeLoggedIn() {
    if (!loginStartTime) {
        return 0;
    }
    const current = new Date();
    const diff_ms = current - loginStartTime;
    const diff_m = Math.floor(diff_ms / 60000);
    loginDuration = diff_m;
    return diff_m;
}

function handleLogout() {
    const mins = timeLoggedIn();
    document.getElementById("minutesLoggedIn").value = mins;
    document.getElementById("folderNumber").value = folderNumber;
    document.getElementById("logoutForm").submit();
}