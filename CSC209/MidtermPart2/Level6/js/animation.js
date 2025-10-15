const NRSquares = 8;
const squaresInfo = [
    {
        id: "square1",
        xCord: 0,
        yCord: 350,
        moveX: 0.1,
        moveY: -1,
        endYCord: 1,
        revEndYCord: 349,
        color: "red"
    },
    {
        id: "square2",
        xCord: 100,
        yCord: 350,
        moveX: 0.1,
        moveY: -1,
        endYCord: 0,
        revEndYCord: 349,
        color: "orange"
    },
    {
        id: "square3",
        xCord: 200,
        yCord: 350,
        moveX: 0.1,
        moveY: -1,
        endYCord: 0,
        revEndYCord: 349,
        color: "yellow"
    },
    {
        id: "square4",
        xCord: 300,
        yCord: 350,
        moveX: 0.1,
        moveY: -1,
        endYCord: 0,
        revEndYCord: 349,
        color: "green"
    },
    {
        id: "square5",
        xCord: 50,
        yCord: 0,
        moveX: -0.1,
        moveY: 1,
        endYCord: 349,
        revEndYCord: 1,
        color: "blue"
    },
    {
        id: "square6",
        xCord: 150,
        yCord: 0,
        moveX: -0.1,
        moveY: 1,
        endYCord: 349,
        revEndYCord: 1,
        color: "darkcyan"
    },
    {
        id: "square7",
        xCord: 250,
        yCord: 0,
        moveX: -0.1,
        moveY: 1,
        endYCord: 349,
        revEndYCord: 1,
        color: "pink"
    },
    {
        id: "square8",
        xCord: 350,
        yCord: 0,
        moveX: -0.1,
        moveY: 1,
        endYCord: 349,
        revEndYCord: 1,
        color: "purple"
    },
]
//For Part 1
function moveRed() {
    var redSquare = document.getElementById("redSq");
    var redSpeed = document.getElementById("redSpeed").value;
    var redPos = 0;
    var stepRedId = setInterval(stepRed, redSpeed); //call stepRed every 10 ms

    function stepRed() {
        if (redPos == 350) { //when square hits bottom right of canvas
            clearInterval(stepRedId); //this stops the timer set by stepRedId and hence stop calling stepRed()
        } else {
            redPos++;
            redSquare.style.top = redPos + 'px'; //increases the space between the top of the screen and itself, making the square move downwards
            redSquare.style.left = redPos + 'px'; //increases the space between the left part of the screen and itself, making the square move rightwards
        }
    }
}

function moveBlue() {
    var blueSquare = document.getElementById("blueSq");
    var blueSpeed = document.getElementById("blueSpeed").value;
    var bluePos = 350;
    var stepBlueId = setInterval(stepBlue, blueSpeed);

    function stepBlue() {
        if (bluePos == 0) {
            clearInterval(stepBlueId);
        } else {
            bluePos--;
            blueSquare.style.top = bluePos + 'px';
            blueSquare.style.left = bluePos + 'px';
        }
    }
}

var factor = 1;
function handleButtonPressed() {
    if (factor == 1) {
        moveSquares(factor);
        factor = -1;
    } else {
        moveSquares(factor);
        factor = 1;
    }
}

function moveSquares(factor) {
    var squareSpeed = document.getElementById("squareSpeed").value;
    //Since all the squares will 'reach' at the same time, we will use a single set interval for all the squares
    var stepSquareId = setInterval(stepSquare, squareSpeed);
    // if we make stepSquareId global, then we can bring stepSqaure() outside e.g. VAR STEPSQUAREID
    function stepSquare() {
        var squarePosX, squarePosY
        for (let i = 0; i < NRSquares; i++) {
            var square = document.getElementById(squaresInfo[i].id);
            var stopYCord = factor == 1 ? squaresInfo[i].endYCord : squaresInfo[i].revEndYCord;
            if (squaresInfo[i].yCord == stopYCord) {
                clearInterval(stepSquareId);
            }

            squarePosY = squaresInfo[i].yCord + factor * squaresInfo[i].moveY;
            squarePosX = squaresInfo[i].xCord + factor * squaresInfo[i].moveX;

            square.style.top = squarePosY + 'px';
            squaresInfo[i].yCord = squarePosY;
            square.style.left = squarePosX + 'px';
            squaresInfo[i].xCord = squarePosX;
            console.log(squaresInfo[i].yCord)
        }
    }
}

function createSquares() { //max is 8, create more in dictionary if required
    let container = document.getElementById("myContainer");
    for (let i = 0; i < NRSquares; i++) {
        let squareDiv = document.createElement("div");
        squareDiv.setAttribute("id", squaresInfo[i].id);
        squareDiv.style.width = '50px';
        squareDiv.style.height = '50px';
        squareDiv.style.position = 'absolute';
        squareDiv.style.top = squaresInfo[i].yCord + 'px';
        squareDiv.style.left = squaresInfo[i].xCord + 'px';
        squareDiv.style.background = squaresInfo[i].color;
        container.appendChild(squareDiv);
    }
}
