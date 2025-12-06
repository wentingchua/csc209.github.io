function generateBarChartSalesByQuantity() {
    const ctx = document.getElementById('productSalesByQuantity').getContext('2d');
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        salesData = JSON.parse(this.responseText);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: salesData["labels"],
                datasets: [{
                    label: "Sales (Quantity)",
                    data: salesData["data"],
                }]
            }
        })
    }
    xhttp.open("GET", "../php/overview/quantitySales.php");
    xhttp.send();
}

// function generatePieChart() {
//     const ctx = document.getElementById("pieChart").getContext('2d');
    
// }