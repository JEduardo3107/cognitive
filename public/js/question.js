document.addEventListener('DOMContentLoaded', () => {
    // Find all cards
    const cards = document.querySelectorAll('.content-container__card-container');

    // Remove the 'actual' class from all cards and set the clicked card as 'actual'
    cards.forEach(card => {
        const labels = card.querySelectorAll('.content-container__select-option');

        labels.forEach(label => {
            label.addEventListener('click', () => {
                labels.forEach(l => l.classList.remove('content-container__select-option--selected'));
                label.classList.add('content-container__select-option--selected');
            });
        });
    });

    const nextButton = document.getElementById('btn-next');
    const backButton = document.getElementById('btn-back');
    const questionCounter = document.getElementById('question-counter');
    const progressBar = document.getElementById('progress-bar');

    // Progress bar (update - onload)
    function updateProgress(currentIndex){
        const totalQuestions = cards.length;
        questionCounter.textContent = `Pregunta ${currentIndex + 1} de ${totalQuestions}`;
        const progressPercentage = ((currentIndex + 1) / totalQuestions) * 100;
        progressBar.style.width = `${progressPercentage}%`;
    }

    // Button "Next" event
    nextButton.addEventListener('click', () => {
        const currentCard = document.querySelector('.content-container__card-container.actual');
        const nextCard = document.querySelector('.content-container__card-container.siguiente-carta');

        // Verifica si hay un input radio seleccionado en la tarjeta actual
        const selectedInput = currentCard.querySelector('input[type="radio"]:checked');
        if(!selectedInput){
            sendMesaageToToast("info", "Por favor, selecciona una opción antes de continuar.");
            return;
        }

        if(!nextCard){
            nextButton.value = "enviar"; // Cambia el texto del botón a "enviar" si no hay una siguiente carta
            return;
        }

        if(currentCard){
            currentCard.classList.remove('actual');
            currentCard.classList.add('animar-salida');
        }

        // Cambia la siguiente carta a actual
        nextCard.classList.remove('siguiente-carta');
        nextCard.classList.add('actual');

        // Encuentra el índice de la siguiente carta
        let nextIndex = Array.from(cards).indexOf(nextCard);

        // Actualiza el progreso
        updateProgress(nextIndex);

        // Si la siguiente carta es la última, cambia el texto del botón a "enviar"
        if (nextIndex === cards.length - 1) {
            nextButton.value = "enviar";
        }else{
            nextButton.value = "siguiente"; // Asegura que el texto sea "siguiente" si no es la última carta
        }
    });

    // Evento para el botón "Atrás"
    backButton.addEventListener('click', () => {
        const currentCard = document.querySelector('.content-container__card-container.actual');
        const currentIndex = Array.from(cards).indexOf(currentCard);

        // No hacer nada si es la primera carta
        if (currentIndex === 0) {
            //sendMesaageToToast("info", "Ya estás en la primera pregunta.");
            return;
        }

        // Selecciona la carta anterior
        const previousCard = cards[currentIndex - 1];

        if (currentCard) {
            currentCard.classList.remove('actual');
            currentCard.classList.add('siguiente-carta');
        }

        if (previousCard) {
            previousCard.classList.remove('animar-salida');
            previousCard.classList.add('actual');
        }

        // Actualiza el progreso
        updateProgress(currentIndex - 1);

        nextButton.value = "siguiente";
    });

    // Inicializa el contador y la barra de progreso al cargar la página
    updateProgress(0);

});