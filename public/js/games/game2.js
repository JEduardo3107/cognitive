document.addEventListener("DOMContentLoaded", function() {
    let currentLevel = 0;
    let isKeyboardLocked = true;
    let formToSubmit = document.getElementById('game-form');
    let levelCounter = document.getElementById('current-level');

    let slotNumber = 0;
    let cards = document.querySelectorAll('.game-container__panel-card-container');
    let inputsArray = [];
    let userSelection = new Array(10).fill("");

    let inputValueRequired = [];
    let numbersCard = [];
    let previewMessage = [];

    cards.forEach(function(card){
        inputsArray.push(card.querySelector('.game-container__panel-card-input-control'));
        inputValueRequired.push(card.querySelector('.game-container__panel-card-input-required'));
        numbersCard.push(card.querySelector('.game-container__panel-card'));
        previewMessage.push(card.querySelector('.game-container__panel-card-preview-container'));
    });

    startGame(0);

    function startGame(indexLevel){
        cards.forEach(function(card){
            card.classList.remove('game-container__panel-card-container--showing');
        });
        cards[indexLevel].classList.add('game-container__panel-card-container--showing');

        let firstSlot = cards[indexLevel].querySelectorAll('.game-container__panel-card-input')[0];
        firstSlot.classList.add('game-container__panel-card-input--active');   
    }

    let btn_start = document.getElementById('tutorial-card__button');

    btn_start.addEventListener('click', () => {
        firstDisplay();
        console.log("Botón de inicio presionado");
    });

    // Esperar al boton de inicio
    function firstDisplay(){
        // Despues de 3 segundos, tapar el número
        let counterVisible = setTimeout(() => {
            numbersCard[0].classList.add('game-container__panel-card--visible');
            isKeyboardLocked = false;
            
            previewMessage[0].classList.add('game-container__panel-card-preview--hidden');

            let counterVisible2 = setTimeout(() => {
                previewMessage[0].style.width = "0";
                previewMessage[0].style.height = "0";
                clearTimeout(counterVisible2);
            }, 300);

            clearTimeout(counterVisible);
        }, 3000);
    }

    let numberButtons = document.querySelectorAll('.game-container__panel-action-pad-grid-number');

    numberButtons.forEach(function(button){
        button.addEventListener('click', function(){
            let number = this.textContent.trim();
            if(!isNaN(number) && number !== ''){
                if(!isKeyboardLocked){
                    printNumber(number);
                }
            }
        });
    });

    let backButton = document.querySelector('.game-container__panel-action-pad-grid-back');
    if(backButton){
        backButton.addEventListener('click', function(){
            if(!isKeyboardLocked){
                deleteNumer();
            }
        });
    }

    let callButton = document.querySelector('.game-container__panel-action-pad-grid-call');
    if (callButton) {
        callButton.addEventListener('click', function() {
            if(!isKeyboardLocked){
                validateNumber();
            }
        });
    }

    function printNumber(number){
        let slost = cards[currentLevel].querySelectorAll('.game-container__panel-card-input');
        slost[slotNumber].innerHTML = number;
        userSelection[slotNumber] = number;

        inputsArray[currentLevel].value = userSelection.join('');

        let maxSlots = slost.length - 1;
        slotNumber++;

        if(slotNumber >= maxSlots){
            slotNumber = maxSlots;
        }

        slost.forEach(function(slot){
            slot.classList.remove('game-container__panel-card-input--active');
        });
        slost[slotNumber].classList.add('game-container__panel-card-input--active');
    }

    function deleteNumer(){
        let slost = cards[currentLevel].querySelectorAll('.game-container__panel-card-input');

        slost[slotNumber].innerHTML = "";
        userSelection[slotNumber] = "";

        inputsArray[currentLevel].value = userSelection.join('');

        if(slotNumber > 0){
            slotNumber--;
        }

        slost.forEach(function(slot){
            slot.classList.remove('game-container__panel-card-input--active');
        });

        slost[slotNumber].classList.add('game-container__panel-card-input--active');
    }

    function validateNumber(){
        let slost = cards[currentLevel].querySelectorAll('.game-container__panel-card-input');
        let slotsRequired = slost.length;

        let filledSlots = userSelection.filter(function(value){
            return value !== "";
        }).length;

        if(filledSlots == slotsRequired){
            isKeyboardLocked = true;

            let requiredNumber = inputValueRequired[currentLevel].value;
        
            let requiredDigits = requiredNumber.split("");

            slost.forEach(function(slot, index){
                if(userSelection[index] == requiredDigits[index]){
                    slot.classList.add('game-container__panel-card-input--true');
                    slot.classList.remove('game-container__panel-card-input--false');
                }else{
                    slot.classList.add('game-container__panel-card-input--false');
                    slot.classList.remove('game-container__panel-card-input--true');
                }
            });

            numbersCard[currentLevel].classList.remove('game-container__panel-card--visible');

            let counterVisible = setTimeout(() => {
                previewMessage[currentLevel].style.width = "100%";
                previewMessage[currentLevel].style.height = "100%";
                previewMessage[currentLevel].classList.remove('game-container__panel-card-preview--hidden');
                
                let counterVisible2 = setTimeout(() => {
                    nextLevel();
                    clearTimeout(counterVisible2);
                }, 300);

                clearTimeout(counterVisible);
                
            }, 2000);

        }else{
            sendMesaageToToast("info", "Completa los " + slotsRequired + " dígitos antes de continuar.");
        }
    }

    function nextLevel(){
        slotNumber = 0;
        currentLevel++;

        if(currentLevel >= cards.length){
            formToSubmit.submit();
            return;
        }

        levelCounter.innerHTML = currentLevel + 1;

        userSelection = new Array(10).fill("");

        cards.forEach(function(card){
            card.classList.remove('game-container__panel-card-container--showing');
        });

        cards[currentLevel].classList.add('game-container__panel-card-container--showing');

        // Despues de 3 segundos, tapar el número
        let counterVisible = setTimeout(() => {
            numbersCard[currentLevel].classList.add('game-container__panel-card--visible');
            isKeyboardLocked = false;
            
            previewMessage[currentLevel].classList.add('game-container__panel-card-preview--hidden');

            let counterVisible2 = setTimeout(() => {
                previewMessage[currentLevel].style.width = "0";
                previewMessage[currentLevel].style.height = "0";
                clearTimeout(counterVisible2);
            }, 300);

            clearTimeout(counterVisible);
        }, 3000);
    }
});