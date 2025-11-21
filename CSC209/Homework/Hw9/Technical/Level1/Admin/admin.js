function handleRefresh() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        users= JSON.parse(this.responseText)
        makeTable(users)        
    }   
    xhttp.open("GET", "userJson.php")
    xhttp.send()
}