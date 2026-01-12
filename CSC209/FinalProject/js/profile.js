function handleLogout() {
    document.getElementById("logoutForm").submit();
}

function updateUserDetailsTable(userDetails) {
    const usernameRow = document.getElementById("usernameRow")
    usernameRow.innerText = userDetails["username"]
    const passwordRow = document.getElementById("passwordRow")
    passwordRow.innerText = userDetails["password"]
    const addressRow = document.getElementById("addressRow")
    addressRow.innerText = userDetails["shipping_address"]
    const emailRow = document.getElementById("emailRow")
    emailRow.innerText = userDetails["email"]
    const contactRow = document.getElementById("contactRow")
    contactRow.innerText = userDetails["contact"]
}

function fillEditModal(userDetails, userId) {
    const usernameRow = document.getElementById("updateUsername")
    usernameRow.setAttribute("value", userDetails["username"])
    const passwordRow = document.getElementById("updatePassword")
    passwordRow.setAttribute("value", userDetails["password"])
    const emailRow = document.getElementById("updateEmail")
    emailRow.setAttribute("value", userDetails["email"])
    const contactRow = document.getElementById("updateContact")
    contactRow.setAttribute("value", userDetails["contact"])
    //address is of text area type
    const addressRow = document.getElementById("updateAddress")
    addressRow.innerText = userDetails["shipping_address"]
    //fill in userId hidden input
    const userIdRow = document.getElementById("userId")
    console.log("teest", userId)
    userIdRow.setAttribute("value", userId)
}