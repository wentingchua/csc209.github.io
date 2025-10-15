function drawCircle(centerX, centerY, color, vX, vY, opacity) {
    const canvas = document.getElementById("myCanvas");
    const ctx = canvas.getContext("2d");

    const endX = centerX + LINE_LENGTH * vX;
    const endY = centerY + LINE_LENGTH * vY;
    ctx.beginPath();
    ctx.arc(centerX, centerY, RADIUS, 0, 2 * Math.PI);
    ctx.moveTo(centerX, centerY);
    ctx.lineTo(endX, endY);
    ctx.lineWidth = LINE_WIDTH;
    ctx.strokeStyle = color;
    ctx.globalAlpha = opacity;
    ctx.stroke();
}

function clearCanvas() {
    const canvas = document.getElementById("myCanvas");
    const ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, 500, 500);
}

//Adapted from W3 Schools
function randomNumberGenerator(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function spawnCirclesRandomly() {
    var numOfPoints = document.getElementById("numOfPoints").value;
    clearCanvas();
    circles = [];
    for (let i = 0; i < numOfPoints; i++) {
        const threshold = RADIUS + LINE_LENGTH;
        const randomX = randomNumberGenerator(threshold, 500 - threshold);
        const randomY = randomNumberGenerator(threshold, 500 - threshold);
        const randomVx = randomNumberGenerator(-10, 10);
        const randomVy = randomNumberGenerator(-10, 10);
        color = COLORS[i];
        circles.push({
            oriX: randomX,
            oriY: randomY,
            x: randomX,
            y: randomY,
            vx: randomVx,
            vy: randomVy,
            color: color
        })
        drawCircle(randomX, randomY, color, randomVx, randomVy);
    }
}

function animateCircles() {
    let step = 0;
    var showTrace = document.getElementById("showTrace").checked;
    console.log(showTrace);
    clearCanvas();
    for (let i = 0; i < circles.length; i++) {
        drawCircle(circles[i].x, circles[i].y, circles[i].color, circles[i].vx, circles[i].vy, 0.1);
    }
    const interval = setInterval(() => {
        if (step >= NRSTEPS) {
            clearInterval(interval);
            clearCanvas();
            for (let i = 0; i < circles.length; i++) {
                drawCircle(circles[i].x, circles[i].y, circles[i].color, circles[i].vx, circles[i].vy, 1.0);
            }
            return;
        }
        if (!showTrace) {
            clearCanvas();
        }
        for (let i = 0; i < circles.length; i++) {
            circles[i].x += circles[i].vx;
            circles[i].y += circles[i].vy;
            if (showTrace) {
                drawCircle(circles[i].x, circles[i].y, circles[i].color, circles[i].vx, circles[i].vy, 0.1);
            } else {
                drawCircle(circles[i].x, circles[i].y, circles[i].color, circles[i].vx, circles[i].vy, 1);
            }
        }
        step++;
    }, 50);
}

function resetToOriginalPosition() {
    clearCanvas();
    for (let i = 0; i < circles.length; i++) {
        circles[i].x = circles[i].oriX;
        circles[i].y = circles[i].oriY;
        drawCircle(circles[i].oriX, circles[i].oriY, circles[i].color, circles[i].vx, circles[i].vy, 1);
    }
}