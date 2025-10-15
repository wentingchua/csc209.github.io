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

function drawSolidParticles() {
    var numOfPoints = document.getElementById("numOfPoints").value;
    clearCanvas();
    circles = [];

    const interval = 50;
    const startX = 50;
    const startY = 450;

    let row = 0;
    let col = 0;

    for (let i = 0; i < numOfPoints; i++) {
        const x = startX + col * interval;
        const y = startY - row * interval;

        const vx = 1 / randomNumberGenerator(-100, 100);
        const vy = 1 / randomNumberGenerator(-100, 100);

        circles.push({
            oriX: x,
            oriY: y,
            x: x,
            y: y,
            vx: vx,
            vy: vy,
            color: COLORS[i % COLORS.length]
        });
        drawCircle(x, y, COLORS[i % COLORS.length], vx, vy, 1.0);
        col++;
        if (startX + col * interval > 450) {
            col = 0;
            row++;
        }
    }
}

function drawLiquidParticles() {
    var numOfPoints = document.getElementById("numOfPoints").value;
    clearCanvas();
    circles = [];

    for (let i = 0; i < numOfPoints; i++) {
        const x = randomNumberGenerator(50, 450);
        const y = randomNumberGenerator(250, 450);

        const vx = randomNumberGenerator(-3, 3);
        const vy = randomNumberGenerator(-3, 3);

        circles.push({
            oriX: x,
            oriY: y,
            x: x,
            y: y,
            vx: vx,
            vy: vy,
            color: COLORS[i % COLORS.length]
        });

        drawCircle(x, y, COLORS[i % COLORS.length], vx, vy, 1.0);
    }
}

function drawGasParticles() {
    var numOfPoints = document.getElementById("numOfPoints").value;
    clearCanvas();
    circles = [];

    for (let i = 0; i < numOfPoints; i++) {
        const x = randomNumberGenerator(50, 450);
        const y = randomNumberGenerator(50, 450);

        const vx = randomNumberGenerator(-8, 8);
        const vy = randomNumberGenerator(-8, 8);

        circles.push({
            oriX: x,
            oriY: y,
            x: x,
            y: y,
            vx: vx,
            vy: vy,
            color: COLORS[i % COLORS.length]
        });

        drawCircle(x, y, COLORS[i % COLORS.length], vx, vy, 1.0);
    }
}

function animateCircles() {
    let step = 0;
    var showTrace = document.getElementById("showTrace").checked;
    const state = document.getElementById("state").value;
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
            if (state === "gas") {
                if (circles[i].x - RADIUS < 0 || circles[i].x + RADIUS > 500) {
                    circles[i].vx *= -1;
                }
                if (circles[i].y - RADIUS < 0 || circles[i].y + RADIUS > 500) {
                    circles[i].vy *= -1;
                }
            }
            if (state === "liquid") {
                const numOfRows = Math.ceil(circles.length / 10);
                const maxHeight = numOfRows * (RADIUS * 2) + RADIUS;
                if (circles[i].x - RADIUS < 0 || circles[i].x + RADIUS > 500) {
                    circles[i].vx *= -1;
                }
                if (circles[i].y - RADIUS < 0 || circles[i].y + RADIUS > maxHeight) {
                    circles[i].vy *= -1;
                }
            }
            if (state === "solid") {
                if (circles[i].x - RADIUS < circles[i].x - RADIUS - 0.5 || circles[i].x + RADIUS > circles[i].x - RADIUS + 0.5) {
                    circles[i].vx *= -1;
                }
                if (circles[i].y - RADIUS < circles[i].y - RADIUS - 0.5 || circles[i].y + RADIUS > circles[i].y - RADIUS + 0.5) {
                    circles[i].vy *= -1;
                }
            }
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

function handleChange() {
    const state = document.getElementById("state").value;
    switch (state) {
        case "solid":
            drawSolidParticles();
            break;
        case "liquid":
            drawLiquidParticles();
            break;
        case "gas":
            drawGasParticles();
            break;
    }

}
