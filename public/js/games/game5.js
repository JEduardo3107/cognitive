document.addEventListener("DOMContentLoaded", function(){
    let current_level = 1;
    let current_level_container = document.getElementById('current-level');

    let paneles = document.querySelectorAll('.game-dynamic-panel');
    let form = document.getElementById('game-form');
    let submit_button = document.getElementById('finalize-button');

    submit_button.addEventListener('click', function(){
        paneles[current_level - 1].classList.remove('game-dynamic-panel--visible');

        current_level++;

        if(current_level > 4){
            submit_button.innerHTML = 'Finalizar';
        }

        if(current_level > 5){
            form.submit();
            return;
        }

        current_level_container.innerHTML = current_level;
        paneles[current_level - 1].classList.add('game-dynamic-panel--visible');
    });
});