document.addEventListener("DOMContentLoaded", function() {
    let board = document.querySelector('.memory-board');
    let cards = board.querySelectorAll('.memory-card');
    let flippedCards = []; // Para almacenar las cartas volteadas
    let correctas = 0; // Contador de aciertos

    // Función para mezclar las cartas
    function shuffleCards() {
        let cardArray = Array.from(cards);
        let shuffledArray = cardArray.sort(() => Math.random() - 0.5);
        shuffledArray.forEach(card => {
            board.appendChild(card); // Reorganiza las cartas en el DOM
        });
    }

    shuffleCards(); // Mezclamos las cartas al inicio

    cards.forEach(element => {
        element.onclick = () => {
            // Si la carta ya está correctamente emparejada, no hacer nada
            if (element.classList.contains('memory-card--solid') || flippedCards.length >= 2) {
                return;
            }

            // Volteamos la carta
            element.classList.add('memory-card--active');
            flippedCards.push(element);

            // Si ya tenemos dos cartas volteadas
            if (flippedCards.length === 2) {
                setTimeout(() => {
                    // Comparamos si las cartas son iguales
                    if (flippedCards[0].dataset.cardId === flippedCards[1].dataset.cardId) {
                        // Si son iguales, las dejamos volteadas y cambiamos a "solid"
                        flippedCards[0].classList.remove('memory-card--active');
                        flippedCards[1].classList.remove('memory-card--active');
                        flippedCards[0].classList.add('memory-card--solid');
                        flippedCards[1].classList.add('memory-card--solid');

                        correctas++; // Aumentamos el contador de aciertos
                        flippedCards = []; // Reseteamos las cartas volteadas

                        if (correctas === 8) { // 8 pares encontrados
                            document.getElementById('finalize-button').disabled = false; // Habilitamos el botón
                        }
                    } else {
                        // Si no son iguales, las volteamos de nuevo
                        flippedCards[0].classList.remove('memory-card--active');
                        flippedCards[1].classList.remove('memory-card--active');
                        flippedCards = []; // Reseteamos las cartas volteadas
                    }
                }, 500); // Esperamos 1 segundo antes de comparar
            }
        }
    });
});