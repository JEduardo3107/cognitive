document.addEventListener("DOMContentLoaded", function() {
    let firstElementToFind = document.getElementById('first-element-to-find');
    let buttonStart = document.getElementById('tutorial-card__button');

    let inputs = document.querySelectorAll('.game-container__sequence-item-input');
    const finalizeButton = document.getElementById('finalize-button');

    buttonStart.addEventListener('click', function() {
        console.log("Button clicked");
        let focusCounter = setTimeout(() => {
            firstElementToFind.focus();

            clearTimeout(focusCounter);
        }, 1000);
    });

     function checkInputs() {
        let allFilled = true;
        
        inputs.forEach(input => {
            if (input.value == '') {
                allFilled = false;
            }
        });

        if (allFilled) {
            finalizeButton.disabled = false;
        } else {
            finalizeButton.disabled = true;
        }
    }

    inputs.forEach(input => {
        input.addEventListener('input', checkInputs);
    });

    checkInputs();
});