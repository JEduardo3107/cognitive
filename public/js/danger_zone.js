const input_confirm = document.getElementById("input_confirm");
const button_confirm = document.getElementById("button_confirm");

const danger_key = input_confirm.dataset.dangervalue;
danger_key.toLowerCase();

let current_value = "";

input_confirm.addEventListener('keyup', function(){
    current_value = input_confirm.value;
    current_value.toLowerCase();

    if(current_value == danger_key){
        button_confirm.disabled = false;
    }else{
        button_confirm.disabled = true;
    }
});