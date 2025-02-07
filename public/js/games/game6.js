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
            // Si la carta ya está emparejada o ya está volteada, no hacer nada
            if (element.classList.contains('memory-card--solid') || 
                element.classList.contains('memory-card--active') || 
                flippedCards.length >= 2) {
                return;
            }

            // Volteamos la carta
            element.classList.add('memory-card--active');
            flippedCards.push(element);

            // Si ya tenemos dos cartas volteadas
            if (flippedCards.length === 2) {
                setTimeout(() => {
                    let [card1, card2] = flippedCards;

                    // Comparamos si las cartas son iguales
                    if (card1.dataset.cardId === card2.dataset.cardId) {
                        // Si son iguales, las dejamos volteadas y cambiamos a "solid"
                        card1.classList.remove('memory-card--active');
                        card2.classList.remove('memory-card--active');
                        card1.classList.add('memory-card--solid');
                        card2.classList.add('memory-card--solid');

                        correctas++; // Aumentamos el contador de aciertos

                        if (correctas === 8) { // 8 pares encontrados
                            document.getElementById('finalize-button').disabled = false;
                        }
                    } else {
                        // Si no son iguales, las volteamos de nuevo
                        card1.classList.remove('memory-card--active');
                        card2.classList.remove('memory-card--active');
                    }

                    flippedCards = []; // Reseteamos las cartas volteadas
                }, 500); // Esperamos 0.5 segundos antes de comparar
            }
        };
    });
});