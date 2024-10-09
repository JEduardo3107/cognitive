document.addEventListener('DOMContentLoaded', () => {
    const previewCard = document.getElementById('preview-card');
    const previewCard__button = document.getElementById('preview-card__button');

    previewCard__button.onclick = () => {
        previewCard.clientHeight;
        previewCard.classList.add('fade-out');
        
       let counterFadeOut = setTimeout(() => {
            previewCard.remove();
            clearTimeout(counterFadeOut);
        }, 700);
    };
});