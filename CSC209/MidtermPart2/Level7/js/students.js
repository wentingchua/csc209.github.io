function addRow(name, isPart1Checked, isPart2Checked) {
    const table = document.getElementById("table")
    const checkCross1 = isPart1Checked ? "fa fa-check" : "fa fa-remove";
    const checkCross2 = isPart2Checked ? "fa fa-check" : "fa fa-remove";
    const row = document.createElement("tr");

    const nameData = document.createElement("td");
    const nameValue = document.createTextNode(name);
    nameData.appendChild(nameValue);

    const part1Data = document.createElement("td");
    const part1Value = document.createElement("i");
    part1Value.setAttribute("class", checkCross1);
    part1Data.appendChild(part1Value);

    const part2Data = document.createElement("td")
    const part2Value = document.createElement("i");
    part2Value.setAttribute("class", checkCross2);
    part2Data.appendChild(part2Value);

    row.appendChild(nameData);
    row.appendChild(part1Data);
    row.appendChild(part2Data);
    table.appendChild(row);
}

function addRows() {
    for (let i = 0; i < NRROWS; i++) {
        const isPart1Checked = PART1[i];
        const isPart2Checked = PART2[i];
        const name = NAMES[i];
        addRow(name, isPart1Checked, isPart2Checked);
    }
}
