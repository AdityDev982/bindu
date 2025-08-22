<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Math Challenge Game</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;

    /* Animated gradient background */
    background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #a1c4fd, #c2e9fb);
    background-size: 400% 400%;
    animation: gradientBG 12s ease infinite;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    text-align: center;
    max-width: 400px;
    width: 90%;

    /* Animation */
    animation: fadeIn 1s ease-in-out, float 3s ease-in-out infinite;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

h1 {
    color: #007bff;
    font-size: 2em;
    margin-bottom: 15px;
}

#question {
    font-size: 1.5em;
    margin: 20px 0;
    color: #333;
}

/* Input field */
input[type="number"] {
    padding: 10px;
    font-size: 1em;
    width: 100px;
    border: 2px solid #ddd;
    border-radius: 8px;
    outline: none;
    transition: 0.3s;
}

input[type="number"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
}

/* Button styling */
button {
    padding: 12px 25px;
    font-size: 1em;
    margin-top: 15px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s ease;
}

button:hover {
    background: linear-gradient(45deg, #20c997, #28a745);
    transform: scale(1.05);
}

/* Score & message */
.score-time {
    margin-top: 20px;
    font-weight: bold;
    color: #333;
}

.message {
    margin-top: 15px;
    font-size: 1.1em;
    height: 24px;
    color: #555;
}

</style>
</head>
<body>
<div class="container">
    <h1>Math Challenge</h1>
    <div class="score-time">
        Score: <span id="score">0</span> | Time: <span id="time">60</span>s
    </div>
    <div id="question">Press Start to Begin!</div>
    <input type="number" id="answer" placeholder="Your Answer" disabled>
    <br>
    <button id="start-btn">Start</button>
    <div class="message" id="message"></div>
</div>

<script>
let score = 0;
let time = 60;
let currentAnswer;
let timerInterval;

const scoreDisplay = document.getElementById('score');
const timeDisplay = document.getElementById('time');
const questionDisplay = document.getElementById('question');
const answerInput = document.getElementById('answer');
const messageDisplay = document.getElementById('message');
const startBtn = document.getElementById('start-btn');

function generateQuestion() {
    const num1 = Math.floor(Math.random() * 20) + 1;
    const num2 = Math.floor(Math.random() * 20) + 1;
    const operations = ['+', '-', '*'];
    const op = operations[Math.floor(Math.random() * operations.length)];

    switch(op) {
        case '+': currentAnswer = num1 + num2; break;
        case '-': currentAnswer = num1 - num2; break;
        case '*': currentAnswer = num1 * num2; break;
    }

    questionDisplay.textContent = `${num1} ${op} ${num2} = ?`;
    answerInput.value = '';
    answerInput.focus();
    messageDisplay.textContent = '';
}

function startGame() {
    score = 0;
    time = 60;
    scoreDisplay.textContent = score;
    timeDisplay.textContent = time;
    messageDisplay.textContent = '';
    generateQuestion();
    answerInput.disabled = false;
    startBtn.disabled = true;

    timerInterval = setInterval(() => {
        time--;
        timeDisplay.textContent = time;
        if(time <= 0) {
            endGame();
        }
    }, 1000);
}

function checkAnswer() {
    const userAnswer = Number(answerInput.value);

    if(answerInput.value === '') {
        messageDisplay.textContent = '';
        return;
    }

    if(!isNaN(userAnswer)) {
        if(userAnswer === currentAnswer) {
            score++;
            scoreDisplay.textContent = score;
            messageDisplay.textContent = "Correct!";
            generateQuestion();
        } else {
            messageDisplay.textContent = "Wrong! Try again.";
        }
    }
}

function endGame() {
    clearInterval(timerInterval);
    questionDisplay.textContent = "Game Over!";
    messageDisplay.textContent = `Your final score is ${score}`;
    answerInput.disabled = true;
    startBtn.disabled = false;
}

// Auto-check answer on input
answerInput.addEventListener('input', checkAnswer);

startBtn.addEventListener('click', startGame);
</script>
</body>
</html>
