<?php

function generateRandomId($longitud){
    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numCaracteres = strlen($caracteres);
    $cadenaRandom = '';
    
    for($i = 0; $i < $longitud; $i++){
        $indice = random_int(0, $numCaracteres - 1);
        $cadenaRandom .= $caracteres[$indice];
    }
    
    return $cadenaRandom;
}