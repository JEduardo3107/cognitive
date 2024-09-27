const toggle_menu_button = document.getElementById('menu__activador');
const menu = document.getElementById('menu__items');

toggle_menu_button.onclick = function(){
    toggle_menu_button.classList.toggle("menu--active");
    menu.classList.toggle("menu__items--active");
};