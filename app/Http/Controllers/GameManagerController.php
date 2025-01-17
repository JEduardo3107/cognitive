<?php

namespace App\Http\Controllers;
use App\Models\AvailableActivity;
use Illuminate\Http\Request;
use App\Models\Games\Game1;
use App\Models\Games\Game1Setting;
use App\Models\UserActivity;
use Faker\Factory as Faker;

class GameManagerController extends Controller{
    public function index(string $sessionid, AvailableActivity $game){
        // Obtener el registro de UserActivity
        $userSession = UserActivity::where('session_id', $sessionid)->first();
        $game_id = $game->id;

        // Verifica si $game->game_id existe en una de las actividades
        if($userSession->activity_id_1 == $game_id || $userSession->activity_id_2 == $game_id || $userSession->activity_id_3 == $game_id){
            if($userSession->created_at->isToday()){
                if(($userSession->activity_id_1 == $game_id && $userSession->activity_1_completed) ||
                    ($userSession->activity_id_2 == $game_id && $userSession->activity_2_completed) ||
                    ($userSession->activity_id_3 == $game_id && $userSession->activity_3_completed)){
                    return redirect()->route('home.index')->with('notification', [
                        'type' => 'info',
                        'message' => 'La actividad ya fue completada.'
                    ]);
                }
            }else{
                return redirect()->route('home.index')->with('notification', [
                    'type' => 'info',
                    'message' => 'La actividad ha expirado.'
                ]);
            }
        }else{
            return redirect()->route('home.index')->with('notification', [
                'type' => 'info',
                'message' => 'Actividad no disponible.'
            ]);
        }

        // La logica continua aqui
        $sessionToken = $userSession->session_id;

        switch($game->game_id){
            case 1:
                // Seleccionar un registro aleatorio de Game1
                $randomLevel = Game1::with(['options' => function ($query) {
                    // Recuperar 9 registros aleatorios de Game1Setting
                    $query->inRandomOrder()->limit(8);
                }])->inRandomOrder()->first();

                return view('games.language.game-1', [
                    'game' => $game,
                    'sessionToken' => $sessionToken,
                    'randomLevel' => $randomLevel,
                ]);
            case 2:
                $phoneNumbers = [];
                $currentLength = 3;
                $names = [];
                // Crear una instancia de Faker
                $faker = Faker::create();

                for($i = 0; $i < 4; $i++){
                    $phoneNumbers[] = $this->generateRandomNumber($currentLength++);

                    $firstName = $faker->firstName;  // Solo el primer nombre
                    $lastName = $faker->lastName;    // Solo el apellido
                    $names[] = $firstName . ' ' . $lastName;  // Nombre y apellido
                }
            
                return view('games.memory.game-1', [
                    'game' => $game,
                    'sessionToken' => $sessionToken,
                    'phoneNumbers' => $phoneNumbers,
                    'names' => $names,
                ]);
            case 3:
                $possibleSequence = [5, 10, 15, 20, 30, 50];
                $sequence = $possibleSequence[rand(0, count($possibleSequence) - 1)];

                $numbersDisplayed = [];
                $currentValue = 0;
                $sequenceToFind = [];

                $exclusionCount = 5;
                $exclusions = array_rand(array_flip(range(1, 18)), $exclusionCount);

                if(!is_array($exclusions)){
                    $exclusions = [$exclusions];
                }

                for($i = 0; $i < 20; $i++){
                    $currentValue += $sequence;
                    if(in_array($i, $exclusions)){
                        $numbersDisplayed[] = '*';
                        $sequenceToFind[] = $currentValue;
                    }else{
                        $numbersDisplayed[] = $currentValue;
                    }
                }

                return view('games.attention.game-1', [
                    'game' => $game,
                    'sessionToken' => $sessionToken,
                    'numbersDisplayed' => $numbersDisplayed,
                    'sequenceToFind' => $sequenceToFind,
                    'sequence' => $sequence,
                ]);

            default:
                abort(404);
        }
    }

    private function generateRandomNumber($length){
        $number = '';
        for($i = 0; $i < $length; $i++){
            if($i == 0){
                $number .= rand(5, 7);
            }else if($i < 3 &&  $i != 0){
                $number .= rand(2, 5);
            }else{
                $number .= rand(0, 9);
            }
            
        }
        return $number;
    }
}