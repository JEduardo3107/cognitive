<?php

namespace App\Http\Controllers;
use App\Models\AvailableActivity;
use Illuminate\Http\Request;
use App\Models\Games\Game1;
use App\Models\Games\Game1Setting;
use Faker\Factory as Faker;

class GameManagerController extends Controller{
    public function index(AvailableActivity $game){
        switch ($game->game_id){
            case 1:
                // Seleccionar un registro aleatorio de Game1
                $randomLevel = Game1::with(['options' => function ($query) {
                    // Recuperar 9 registros aleatorios de Game1Setting
                    $query->inRandomOrder()->limit(8);
                }])->inRandomOrder()->first();

                return view('games.language.game-1', [
                    'game' => $game,
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

                return view('games.attention.game-1', compact('game', 'numbersDisplayed', 'sequenceToFind', 'sequence'));
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