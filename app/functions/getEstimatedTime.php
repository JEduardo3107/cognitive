<?php

function getEstimatedTime($numeroPreguntas){
    $totalSegundos = $numeroPreguntas * 15;

    if($totalSegundos < 60){
        return "$totalSegundos segundos";
    }

    // Calcula los minutos y segundos restantes
    $minutos = floor($totalSegundos / 60);
    $segundos = $totalSegundos % 60;

    // Construye la cadena final dependiendo de si hay minutos y segundos
    if ($segundos == 0) {
        return "$minutos minuto" . ($minutos > 1 ? "s" : "");
    }

    return "$minutos minuto" . ($minutos > 1 ? "s" : "") . " $segundos segundos";
}