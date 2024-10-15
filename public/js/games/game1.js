
document.addEventListener('DOMContentLoaded', function () {
    const selects = document.querySelectorAll('.game-container__lineal-card-selection-element');
    const finalizeButton = document.getElementById('finalize-button');

    // Función para habilitar o deshabilitar el botón "Finalizar"
    function checkSelects() {
        let allSelected = true;

        selects.forEach(select => {
            if (select.value === "") {
                allSelected = false; // Si algún select es nulo, deshabilitar el botón
            }
        });

        finalizeButton.disabled = !allSelected; // Habilitar o deshabilitar el botón según el estado
    }

    // Comprobar selectores al cambiar
    selects.forEach(select => {
        select.addEventListener('change', checkSelects);
    });

    // Comprobar selectores al cargar la página
    checkSelects();

    // Evento para el botón "Finalizar"
    finalizeButton.addEventListener('click', function () {
        let allValid = true;

        selects.forEach(select => {
            if (select.value === "") {
                allValid = false; // Verificar si algún select es nulo
            }
        });

        if (!allValid) {
            console.log('Seleccione todo antes de enviar'); // Imprimir en consola si no se completaron todos los selects
        } else {
            // Aquí puedes agregar la lógica para finalizar el juego
            console.log('Juego finalizado'); // Imprimir que el juego ha finalizado
        }
    });
});