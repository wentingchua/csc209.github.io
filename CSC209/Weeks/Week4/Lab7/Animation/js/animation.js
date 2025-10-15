
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


