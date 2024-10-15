document.addEventListener('DOMContentLoaded', () => {
    const tutorialCard = document.getElementById('tutorial-card');
    const tutorialCard__button = document.getElementById('tutorial-card__button');
    const gameTimer = document.getElementById('game-timer');
    const gameTimerInput = document.getElementById('time');
    let gameTime = 0;

    tutorialCard__button.onclick = () => {
        tutorialCard.clientHeight;
        tutorialCard.classList.add('fade-out');
        
        let counterFadeOut = setTimeout(() => {
            tutorialCard.remove();
            clearTimeout(counterFadeOut);
        }, 700);

        const updateTimer = () => {
            ++gameTime;
            const minutes = Math.floor(gameTime / 60).toString().padStart(2, '0');
            const seconds = (gameTime % 60).toString().padStart(2, '0');
            gameTimer.innerHTML = `${minutes}:${seconds}`;
            gameTimerInput.value = gameTime;
        };

        let gameInterval = setInterval(updateTimer, 1000);
    };
});