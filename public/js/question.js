document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.content-container__card-container');
    const nextButton = document.getElementById('btn-next');
    const backButton = document.getElementById('btn-back');
    const questionCounter = document.getElementById('question-counter');
    const progressBar = document.getElementById('progress-bar');

    function updateProgress(currentIndex) {
        const totalQuestions = cards.length;
        questionCounter.textContent = `Pregunta ${currentIndex + 1} de ${totalQuestions}`;
        const progressPercentage = ((currentIndex + 1) / totalQuestions) * 100;
        progressBar.style.width = `${progressPercentage}%`;
    }

    cards.forEach(card => {
        const labels = card.querySelectorAll('.content-container__select-option');

        labels.forEach(label => {
            label.addEventListener('click', () => {
                labels.forEach(l => l.classList.remove('content-container__select-option--selected'));
                label.classList.add('content-container__select-option--selected');
            });
        });
    });

    nextButton.addEventListener('click', () => {
        const currentCard = document.querySelector('.content-container__card-container.card-showing');
        const currentIndex = Array.from(cards).indexOf(currentCard);
        const selectedInput = currentCard.querySelector('input[type="radio"]:checked');

        if (!selectedInput) {
            sendMesaageToToast("info", "Por favor, selecciona una opción antes de continuar.");
            return;
        }

        // Si estamos en la última tarjeta, evitar cambios
        if (currentIndex === cards.length - 1) {
            // Aquí podrías manejar el envío del formulario o lo que necesites
            alert("Formulario enviado"); // O el código que uses para enviar el formulario
            return; // Salir de la función
        }

        // Actualiza la tarjeta actual
        if (currentCard) {
            currentCard.classList.remove('card-showing');
            currentCard.classList.add('card-leave');
        }

        const nextCard = cards[currentIndex + 1];
        if (nextCard) {
            nextCard.classList.remove('card-next');
            nextCard.classList.add('card-showing');

            // Asigna la clase siguiente-carta a la tarjeta que sigue de la actual
            if (currentIndex + 2 < cards.length) {
                cards[currentIndex + 2].classList.add('card-next');
            }

            updateProgress(currentIndex + 1);

            nextButton.value = (currentIndex + 1 === cards.length - 1) ? "Finalizar" : "siguiente";
        }
    });

    backButton.addEventListener('click', () => {
        const currentCard = document.querySelector('.content-container__card-container.card-showing');
        const currentIndex = Array.from(cards).indexOf(currentCard);

        if (currentIndex === 0) {
            return; // No hacer nada si ya estás en la primera tarjeta
        }

        const previousCard = cards[currentIndex - 1];

        if (currentCard) {
            currentCard.classList.remove('card-showing');
            currentCard.classList.add('card-next');
        }

        if (previousCard) {
            previousCard.classList.remove('card-leave');
            previousCard.classList.add('card-showing');
        }

        // Reasigna la clase siguiente-carta si es posible
        if (currentIndex < cards.length) {
            cards[currentIndex].classList.add('card-next');
        }

        updateProgress(currentIndex - 1);
        nextButton.value = "siguiente";
    });

    // Inicializa el contador y la barra de progreso al cargar la página
    updateProgress(0);
});