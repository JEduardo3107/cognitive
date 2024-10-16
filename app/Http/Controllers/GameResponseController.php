<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Result\Game1Result;
use App\Models\Result\Game2Result;
use App\Models\Result\Game3Result;

class GameResponseController extends Controller{
    public function index1(string $sessionid){
        $responses = Game1Result::where('session_id', $sessionid)
            ->with('word')
            ->get();

        $aciertos = $responses->where('status', true)->count();
        $totalAcierto = $responses->count();

        if($totalAcierto > 0){
            $percentage = ($aciertos / $totalAcierto) * 100;
        }else{
            $percentage = 0;
        }

        $time = 0;

        if($percentage < 30){
            $message = "¡No te rindas! Cada error es una oportunidad para aprender.";
        }elseif($percentage < 50){
            $message = "¡Buen intento! Estás en el camino correcto, sigue practicando.";
        }elseif($percentage < 70){
            $message = "¡Vas bien! Un poco más de esfuerzo y lo lograrás.";
        }else{
            $message = "¡Excelente trabajo! Has hecho un gran esfuerzo.";
        }

        $timeInSeconds = $responses->first()->time ?? 0;

        $minutes = floor($timeInSeconds / 60);
        $seconds = $timeInSeconds % 60;
        $formattedTime = sprintf('%02d:%02d', $minutes, $seconds);

        return view('responses.language.game-1', compact('responses', 'aciertos', 'totalAcierto', 'formattedTime', 'message'));
    }

    public function index2(string $sessionid){


        $responses = Game2Result::where('session_id', $sessionid)->first();

        // Inicializar un array vacío para los resultados de coincidencia
        $results = [];
        $aciertos = 0;
        $totalAcierto = 4;

        // Iterar sobre los números requeridos y las selecciones del usuario
        for ($i = 1; $i <= 4; $i++) {
            $number = $responses->{"number_$i"}; // Número requerido
            $userSelection = $responses->{"number_{$i}_response"}; // Selección del usuario

            // Calcular el porcentaje de coincidencia
            $percentage = $this->calculatePercentage($number, $userSelection);

            if($percentage == 100){
                $aciertos++;
            }

            // Almacenar el resultado
            $results[] = [
                "coincidencia" => $percentage,
                "number" => $number,
                "user_selection" => $userSelection,
            ];
        }

        $timeInSeconds = $responses->time ?? 0;

        $minutes = floor($timeInSeconds / 60);
        $seconds = $timeInSeconds % 60;
        $formattedTime = sprintf('%02d:%02d', $minutes, $seconds);

        if($aciertos < 1){
            $message = "¡No te rindas! Cada error es una oportunidad para aprender.";
        }elseif($aciertos < 2){
            $message = "¡Buen intento! Estás en el camino correcto, sigue practicando.";
        }elseif($aciertos < 3){
            $message = "¡Vas bien! Un poco más de esfuerzo y lo lograrás.";
        }else{
            $message = "¡Excelente trabajo! Has hecho un gran esfuerzo.";
        }


        return view('responses.memory.game-1', compact('results', 'formattedTime', 'aciertos', 'totalAcierto', 'message'));
    }

    // Método para calcular el porcentaje de coincidencia
    private function calculatePercentage($required, $user){
        // Convertir números a cadenas para facilitar la comparación
        $requiredStr = strval($required);
        $userStr = strval($user);

        // Inicializar variables
        $totalLength = max(strlen($requiredStr), strlen($userStr));
        $matchCount = 0;

        // Comparar caracteres por posición
        for ($i = 0; $i < $totalLength; $i++) {
            if (isset($requiredStr[$i]) && isset($userStr[$i]) && $requiredStr[$i] === $userStr[$i]) {
                $matchCount++;
            }
        }

        // Calcular porcentaje
        if ($totalLength > 0) {
            $percentage = ($matchCount / $totalLength) * 100;
        } else {
            $percentage = 0; // Evitar división por cero
        }

        return round($percentage, 2); // Redondear a dos decimales
    }

    public function index3(string $sessionid){
        $responses = Game3Result::where('session_id', $sessionid)->get();
        $originalSequence = $responses->first()->sequence_data;

        $originalSequence = json_decode($originalSequence, true); 

        $timeInSeconds = $responses->first()->time ?? 0;

        $minutes = floor($timeInSeconds / 60);
        $seconds = $timeInSeconds % 60;
        $formattedTime = sprintf('%02d:%02d', $minutes, $seconds);

        return view('responses.attention.game-1', compact('responses', 'formattedTime', 'originalSequence'));
    }
}