function addRow(name, isPart1Checked, isPart2Checked) {
    const checkCross1 = isPart1Checked ? "fa fa-check" : "fa fa-remove";
    const checkCross2 = isPart2Checked ? "fa fa-check" : "fa fa-remove";
    const newRow = ROW.replace("TEXT", name).replace("CHECKCROSS1", checkCross1).replace("CHECKCROSS2", checkCross2);
    const table = document.getElementById("table");
    table.innerHTML += newRow;
}