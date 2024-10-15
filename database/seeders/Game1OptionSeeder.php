<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Games\Game1;
use App\Models\Games\Game1Setting;
use Exception;

class Game1OptionSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{

        DB::beginTransaction();

        try{
            $games = [
                [
                    'id' => 'bdc645c4-ac02-443e-9dd7-d7c44eefa9a6',
                    'name' => 'sc',
                    'option1' => 's',
                    'option2' => 'c',
                    'settings' => [
                        ['display_word' => 're*ibo', 'valid_option' => 'c'], // recibo
                        ['display_word' => 'fortale*er', 'valid_option' => 'c'], // fortalecer
                        ['display_word' => 'mú*ica', 'valid_option' => 's'], // musica
                        ['display_word' => 'pre*ión', 'valid_option' => 's'], // presion
                        ['display_word' => '*erca', 'valid_option' => 'c'], // cerca
                        ['display_word' => 'expre*ión', 'valid_option' => 's'], // expresion
                        ['display_word' => 'fá*il', 'valid_option' => 'c'], // facil
                        ['display_word' => 'silen*io', 'valid_option' => 'c'], // silencio
                        ['display_word' => '*erveza', 'valid_option' => 'c'], // cerveza
                        ['display_word' => '*entir', 'valid_option' => 's'], // sentir
                        ['display_word' => '*ilbar', 'valid_option' => 's'], // silbar
                        ['display_word' => 'lu*ir', 'valid_option' => 'c'], // lucir
                        ['display_word' => 'proce*o', 'valid_option' => 's'], // proceso
                        ['display_word' => '*ena', 'valid_option' => 'c'], // cena
                        ['display_word' => 'va*ilar', 'valid_option' => 'c'], // vacilar
                        ['display_word' => 'a*iento', 'valid_option' => 's'], // asiento
                        ['display_word' => 'finan*iar', 'valid_option' => 'c'], // financiar
                        ['display_word' => 'profe*ión', 'valid_option' => 's'], // profesión
                        ['display_word' => 'redu*ir', 'valid_option' => 'c'], // reducir
                        ['display_word' => 'pa*ión', 'valid_option' => 's'], // pasión
                    ],
                ],
                [
                    'id' => '29a58223-1683-4845-9732-f5b85225a291',
                    'name' => 'vb',
                    'option1' => 'v',
                    'option2' => 'b',
                    'settings' => [
                        ['display_word' => '*aquero', 'valid_option' => 'v'], // vaquero
                        ['display_word' => 'nu*e', 'valid_option' => 'b'], // nube
                        ['display_word' => '*urro', 'valid_option' => 'b'], // burro
                        ['display_word' => '*aile', 'valid_option' => 'b'], // baile
                        ['display_word' => '*elocidad', 'valid_option' => 'v'], // velocidad
                        ['display_word' => '*ecino', 'valid_option' => 'v'], // vecino
                        ['display_word' => 'ca*allo', 'valid_option' => 'b'], // caballo
                        ['display_word' => 'a*ismo', 'valid_option' => 'b'], // abismo
                        ['display_word' => 'sa*er', 'valid_option' => 'b'], // saber
                        ['display_word' => 'e*itar', 'valid_option' => 'v'], // evitar
                        ['display_word' => 'in*ierno', 'valid_option' => 'v'], // invierno
                        ['display_word' => 'be*er', 'valid_option' => 'b'], // beber
                        ['display_word' => '*ajo', 'valid_option' => 'b'], // bajo
                        ['display_word' => '*erano', 'valid_option' => 'v'], // verano
                        ['display_word' => '*aca', 'valid_option' => 'v'], // vaca
                        ['display_word' => '*otella', 'valid_option' => 'b'], // botella
                        ['display_word' => '*ioma', 'valid_option' => 'b'], // bioma
                        ['display_word' => '*iento', 'valid_option' => 'v'], // viento
                        ['display_word' => '*entana', 'valid_option' => 'v'], // ventana
                        ['display_word' => '*ueno', 'valid_option' => 'b'], // bueno
                    ],
                ],
                // Añadir más combinaciones aquí...
            ];

            // Insertar las combinaciones en la tabla Game1
            foreach ($games as $game) {
                $gameModel = Game1::create([
                    'id' => $game['id'],
                    'activity_id' => '5c5511a7-010c-40d7-b904-ea79f9c14e81',
                    'name' => $game['name'],
                    'option1' => $game['option1'],
                    'option2' => $game['option2'],
                ]);

                // Insertar las configuraciones para cada combinación en Game1Setting
                foreach ($game['settings'] as $setting) {
                    Game1Setting::create([
                        'id' => Str::uuid(),
                        'game_id' => $gameModel->id, // Referencia al game recién creado
                        'display_word' => $setting['display_word'],
                        'valid_option' => $setting['valid_option'],
                    ]);
                }
            }

            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            throw $e;
        } 
    }
}