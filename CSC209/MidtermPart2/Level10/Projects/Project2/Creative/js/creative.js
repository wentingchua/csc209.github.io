const sentences = [
    'Can we go to the park.',
    'Where is the orange cat? Said the big black dog.',
    'We can make the bird fly away if we jump on something.',
    'We can go down to the store with the dog. It is not too far away.',
    'My big yellow cat ate the little black bird.',
    'I like to read my book at school.',
    'We are going to swim at the park.'
];
var counter = 0; //between 0 and 6
var score = 0;

function handleSubmit() {
    const textInput = document.getElementById("answer").value;
    const question = document.getElementById("question");
    const scoreBoard = document.getElementById("score");
    const remark = document.getElementById("remark");
    if (textInput == sentences[counter]) {
        console.log("correct");
        textInput.value = '';
        addCounter();
        score += 10;
        scoreBoard.innerText = score;
        question.innerText = sentences[counter];
        remark.innerText = "CORRECT !";
        remark.style.color = "green";
    } else {
        console.log("wrong");
        remark.innerText = "WRONG !";
        remark.style.color = "red";
    }
}

function addCounter() {
    if (counter == 6) {
        counter = 0;
        return;
    }
    counter++;
}