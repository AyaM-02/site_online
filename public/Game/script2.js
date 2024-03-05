// het ophalen van de data selection > rock,paper,scissors
var url_string = window.location.href; 
var url = new URL(url_string);
var token = url.searchParams.get("token");
console.log(token);
const selectionButtons = document.querySelectorAll('[data-selection]')
const finalColumn = document.querySelector('[data-final-column]')
const timeValue = document.getElementById("time");
const computerScoreSpan = document.querySelector('[data-computer-score]')
const yourScoreSpan = document.querySelector('[data-your-score]')
const SELECTIONS = [
    {
        name: 'rock',
        emoji: '✊🏼',
        beats: 'scissors'
    },
    {
        name: 'paper',
        emoji: '✋🏼',
        beats: 'rock'
    },
    {
        name: 'scissors',
        emoji: '✌🏼',
        beats: 'paper'
    },

]

// loopen door elk item in selectionbutton
selectionButtons.forEach(selectionButton => {
    //hang aan elk item een klik event 
    selectionButton.addEventListener('click', e => {
        //een varaible met de naam van de item dat je vast hebt
        const selectionName = selectionButton.dataset.selection;
        const selection = SELECTIONS.find(selection => selection.name === selectionName)
        makeSelection(selection)
    })
})

function makeSelection(selection) {
    const computerSelection = randomSelection()
    const yourWinner = isWinner(selection, computerSelection)
    const computerWinner = isWinner(computerSelection, selection)

    addSelectionResult(computerSelection, computerWinner)
    addSelectionResult(selection, yourWinner)

    if (yourWinner) incrementScore(yourScoreSpan)
    if (computerWinner) incrementScore(computerScoreSpan)
}

function incrementScore(scoreSpan) {
    scoreSpan.innerText = parseInt(scoreSpan.innerText) + 1

}

function addSelectionResult(selection, winner) {
    const div = document.createElement('div')
    div.innerText = selection.emoji
    div.classList.add('result-selection')
    if (winner) div.classList.add('winner')
    finalColumn.after(div)

}

function isWinner(selection, opponentSelection) {
    return selection.beats === opponentSelection.name
}

function randomSelection() {
    const randomIndex = Math.floor(Math.random() * SELECTIONS.length)
    return SELECTIONS[randomIndex]
}

//Initial Time
let seconds = 0,
    minutes = 0;
//For timer
// Definieer de timeGenerator functie
const timeGenerator = () => {
    seconds += 1;
    // Minuten logica
    if (seconds >= 60) {
        minutes += 1;
        seconds = 0;
    }
    // Formateer de tijd voordat je deze weergeeft
    let secondsValue = seconds < 10 ? `0${seconds}` : seconds;
    let minutesValue = minutes < 10 ? `0${minutes}` : minutes;
    // Bijwerken van de innerHTML van het tijdselement
    timeValue.innerHTML = `<span>Time:</span> ${minutesValue}:${secondsValue}`;

    // Controleer of de tijd 60 seconden heeft bereikt
    if (minutes === 0 && seconds === 10) {
        clearInterval(timer); // Stop het interval
        console.log("Game over!"); // Toon een bericht in de console (kan worden vervangen door de gewenste actie)
        showScoreMessage(); // Toon het bericht met de score op het scherm
    }
};

// Roep de timeGenerator functie aan om de tijd te initialiseren
timeGenerator();

// Stel een interval in om de timeGenerator functie elke seconde uit te voeren
const timer = setInterval(timeGenerator, 1000);

// Selecteer het HTML-element waarin het bericht met de score wordt weergegeven
const scoreMessage = document.getElementById('scoreMessage');

// Definieer de functie om het bericht met de score weer te geven
function showScoreMessage() {
    // Maak een bericht met de score
    const yourScore = yourScoreSpan.innerText;
    const yourcomputerScore = computerScoreSpan.innerText;
    console.log(yourcomputerScore);
    console.log(yourScore);

    if ((yourScore > yourcomputerScore)) {
        scoreMessage.innerHTML = `je hebt met ${yourScore} - ${yourcomputerScore} gewonnnen`;
    }
    else if (yourcomputerScore == yourScore) {
        scoreMessage.innerHTML = `beide partijen hebben ${yourcomputerScore} punten!`;
    } else {
        scoreMessage.innerHTML = `je hebt met  ${yourScore} - ${yourcomputerScore} verloren`;
    }

    //computer en de mens 
    


    //postt
    async function savepoints() {
        const apiUrl = "http://127.0.0.1:8000/api/score";//link
        const data = {
            totalPoints: yourScore,
            apiKey: storedApiKey,
            userId: storedUserId,
        };
        try {
            const response = await fetch(apiUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });

            if (response.ok) {
                console.log("data is verstuurd");
                setDataSent(true);
            } else {
                console.error("data niet verstuurd");
            }
        } catch (error) {
            console.error("data niet verstuurd");
        }
    };



}
