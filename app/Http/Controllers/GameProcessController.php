<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Games\Game1Setting;
use App\Models\Result\Game1Result;
use App\Models\Result\Game2Result;
use App\Models\Result\Game3Result;
use App\Models\Result\Game4Result;
use App\Models\Result\Game5Result;
use App\Models\Result\Game6Result;
use App\Models\UserActivity;
use Illuminate\Support\Str;
use Exception;

class GameProcessController extends Controller{
    public function store1(string $sessionToken, string $game_id, Request $request){
        $rules = [];
        $wordIds = [];

        // Recorrer todas las entradas del request para agregar las reglas de validación
        foreach ($request->all() as $key => $value) {
            // Verificar que el campo siga el patrón 'word_'
            if (preg_match('/^word_\d+$/', $key)) {
                // Agregar la regla para verificar que el valor exista en la tabla game1Settings en el campo id
                $rules[$key] = 'required|string|uuid|exists:game1Settings,id';
                // Guardar el ID de la palabra
                $wordIds[] = $value;
            }
        }

        try {
            // Validar los datos
            $validatedData = $request->validate($rules);

            $words = Game1Setting::whereIn('id', $wordIds)
            ->orderBy('id', 'ASC') // Ajusta el orden según tus necesidades
            ->get();

            // Obtener el user_id del usuario autenticado
            $userId = Auth::user()->id;

            // Inicializar el array de evaluación
            $evaluacion = [];

            foreach ($wordIds as $key => $wordId) {
                // Busca la palabra que corresponde al ID actual
                $word = $words->firstWhere('id', $wordId);
            
                // seleccion es selection_ + $key porque tienen el mismo orden que en el formulario
                $selectionKey = 'selection_' . $key;
            
                $userSelection = $request->input($selectionKey);
            
                // Compara la selección del usuario con la opción válida
                $estado = ($word->valid_option == $userSelection);
            
                $evaluacion[] = [
                    'word_id' => $word->id,
                    'user_selection' => $userSelection,
                    'status' => $estado
                ];
            }

            // Iniciar una transacción
            DB::beginTransaction();

            // GENERAR UN UUID PARA LA SESION
            $sessionId = Str::uuid();

            $timeRequired = $request->input('time');

            if(!$timeRequired){
                $timeRequired = 0;
            }

            foreach ($evaluacion as $key => $gameResult) {
                Game1Result::create([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'word_id' => $gameResult['word_id'],
                    'user_selection' =>  $gameResult['user_selection'],
                    'status' => $gameResult['status'],
                    'time' => $timeRequired,
                ]);
            }
            
            $this->markActivityAsCompleted($sessionToken, $game_id);
            DB::commit();

            return redirect()->route('index.game1', ['sessionid' => $sessionId]);
        } catch (Exception $e) {
            // Si algo falla, hacer rollback
            DB::rollback();

            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Ocurrió un error inesperado.'
            ]);
        }
    }

    public function store2(string $sessionToken, string $game_id, Request $request){
        $rules = [
            'time' => 'required|integer',
            'number_value_required_0' => 'required|integer',
            'number_value_selected_0' => 'required|integer',
            'number_value_required_1' => 'required|integer',
            'number_value_selected_1' => 'required|integer',
            'number_value_required_2' => 'required|integer',
            'number_value_selected_2' => 'required|integer',
            'number_value_required_3' => 'required|integer',
            'number_value_selected_3' => 'required|integer',
        ];

        try{
            // Validar los datos
            $validatedData = $request->validate($rules);

            // Iniciar una transacción
            DB::beginTransaction();

            // GENERAR UN UUID PARA LA SESION
            $sessionId = Str::uuid();

            $timeRequired = $request->input('time');

            if(!$timeRequired){
                $timeRequired = 0;
            }

            // Obtener el user_id del usuario autenticado
            $userId = Auth::user()->id;

            Game2Result::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'time' => $timeRequired,
                'number_1' => $request->input('number_value_required_0'),
                'number_1_response' => $request->input('number_value_selected_0'),
                'number_2' => $request->input('number_value_required_1'),
                'number_2_response' => $request->input('number_value_selected_1'),
                'number_3' => $request->input('number_value_required_2'),
                'number_3_response' => $request->input('number_value_selected_2'),
                'number_4' => $request->input('number_value_required_3'),
                'number_4_response' => $request->input('number_value_selected_3'), 
            ]);

            $this->markActivityAsCompleted($sessionToken, $game_id);
            DB::commit();

            return redirect()->route('index.game2', ['sessionid' => $sessionId]);
        }catch(Exception $e){
            // Si algo falla, hacer rollback
            DB::rollback();

            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Ocurrió un error inesperado.'
            ]);
        }
    }

    public function store3(string $sessionToken, string $game_id, Request $request){
        $rules = [
            'values' => 'required|string', // Validamos que 'values' sea un JSON válido
            'time' => 'required|integer|min:0', // Validamos que el tiempo sea un número entero positivo
        ];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_sequence_') !== false) {
                // Reglas para cada campo 'user_sequence_*' que esté presente
                $rules[$key] = 'required|integer';
            }
            if (strpos($key, 'required_sequence_') !== false) {
                // Reglas para cada campo 'required_sequence_*' que esté presente
                $rules[$key] = 'required|integer';
            }
        }

        try{
            // Validar los datos
            $validatedData = $request->validate($rules);

            // Inicializar el array donde se almacenarán las secuencias
            $sequences = [];

            // Iniciar una transacción
            DB::beginTransaction();

            // GENERAR UN UUID PARA LA SESION
            $sessionId = Str::uuid();

            // Obtener el user_id del usuario autenticado
            $userId = Auth::user()->id;

            $timeRequired = $request->input('time');

            if(!$timeRequired){
                $timeRequired = 0;
            }

            // Recorrer todos los campos enviados en la solicitud
            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'user_sequence_') !== false) {
                    // Obtener el índice actual del número de secuencia
                    $index = str_replace('user_sequence_', '', $key);

                    // Obtener el número ingresado por el usuario y el número requerido
                    $userSequence = $request->input("user_sequence_$index");
                    $requiredSequence = $request->input("required_sequence_$index");

                    // Comparar los valores para determinar si la secuencia es válida
                    $isValid = ($userSequence == $requiredSequence);

                    // Añadir al array de secuencias
                    $sequences[] = [
                        'original' => $requiredSequence,  // Número requerido
                        'seleccion_usuario' => $userSequence,  // Número ingresado por el usuario
                        'secuencia_valida' => $isValid  // Si la secuencia es correcta o no
                    ];
                }
            }

            foreach($sequences as $key => $sequenceResult){
                Game3Result::create([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'time' => $timeRequired,

                    'number_required' => $sequenceResult['original'],
                    'user_input' => $sequenceResult['seleccion_usuario'],
                    'is_valid' => $sequenceResult['secuencia_valida'],
                    'sequence_data' => $request->input('values'),
                ]);
            }

            $this->markActivityAsCompleted($sessionToken, $game_id);

            DB::commit();

            return redirect()->route('index.game3', ['sessionid' => $sessionId]);

        }catch(Exception $e){
            DB::rollback();
            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Ocurrió un error inesperado.'
            ]);
        }
    }

    public function store4(string $sessionToken, string $game_id, Request $request){
        
        $rules = [
            'time' => 'required|integer',
            'winner' => 'required|integer',
            'cube_top' => 'required|integer',
            'cube_center' => 'required|integer',
            'cube_bottom' => 'required|integer',
        ];

        try{
            // Validar los datos
            $validatedData = $request->validate($rules);

            // Iniciar una transacción
            DB::beginTransaction();

            // GENERAR UN UUID PARA LA SESION
            $sessionId = Str::uuid();

            $timeRequired = $request->input('time');

            if(!$timeRequired){
                $timeRequired = 0;
            }

            // Obtener el user_id del usuario autenticado
            $userId = Auth::user()->id;

            $percentage_earned = 0;

            $number_winner = $request->input('winner');
            $number_top = $request->input('cube_top');
            $number_center = $request->input('cube_center');
            $number_bottom = $request->input('cube_bottom');

            $matches = 0;

            if($number_top == $number_winner){
                $matches++;
            }
            if($number_center == $number_winner){
                $matches++;
            }
            if($number_bottom == $number_winner){
                $matches++;
            }

            $percentage_earned = intval(($matches / 3) * 100);

            Game4Result::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'time' => $timeRequired,
                'number_winner' => $number_winner,
                'number_top' => $number_top,
                'number_center' => $number_center,
                'number_bottom' => $number_bottom,

                'percentage' => $percentage_earned,
            ]);

            $this->markActivityAsCompleted($sessionToken, $game_id);
            DB::commit();

            return redirect()->route('index.game4', ['sessionid' => $sessionId]);
        }catch(Exception $e){
            // Si algo falla, hacer rollback
            DB::rollback();

            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Ocurrió un error inesperado.'
            ]);
        }
    }

    public function store5(string $sessionToken, string $game_id, Request $request){
        $rules = [
            'time' => 'required|integer',
            'option_1' => 'required|uuid',
            'option_2' => 'required|uuid',
            'option_3' => 'required|uuid',
            'option_4' => 'required|uuid',
            'option_5' => 'required|uuid',
            'user_selection_1' => 'required|uuid',
            'user_selection_2' => 'required|uuid',
            'user_selection_3' => 'required|uuid',
            'user_selection_4' => 'required|uuid',
            'user_selection_5' => 'required|uuid',
        ];

        try{
            // Validar los datos
            $validatedData = $request->validate($rules);

            // Iniciar una transacción
            DB::beginTransaction();

            // GENERAR UN UUID PARA LA SESION
            $sessionId = Str::uuid();

            $timeRequired = $request->input('time');

            if(!$timeRequired){
                $timeRequired = 0;
            }

            // Obtener el user_id del usuario autenticado
            $userId = Auth::user()->id;

            // Valores correctos y seleccionados
            $value_1 = $request->input('option_1');
            $user_selection_1 = $request->input('user_selection_1');

            $value_2 = $request->input('option_2');
            $user_selection_2 = $request->input('user_selection_2');

            $value_3 = $request->input('option_3');
            $user_selection_3 = $request->input('user_selection_3');

            $value_4 = $request->input('option_4');
            $user_selection_4 = $request->input('user_selection_4');

            $value_5 = $request->input('option_5');
            $user_selection_5 = $request->input('user_selection_5');

            $percentage_earned = 0;

            if($value_1 == $user_selection_1){
                $percentage_earned += 1;
            }
            if($value_2 == $user_selection_2){
                $percentage_earned += 1;
            }
            if($value_3 == $user_selection_3){
                $percentage_earned += 1;
            }
            if($value_4 == $user_selection_4){
                $percentage_earned += 1;
            }
            if($value_5 == $user_selection_5){
                $percentage_earned += 1;
            }

            Game5Result::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'time' => $timeRequired,

                'value_1' => $value_1,
                'user_selection_1' => $user_selection_1,
                'value_2' => $value_2,
                'user_selection_2' => $user_selection_2,
                'value_3' => $value_3,
                'user_selection_3' => $user_selection_3,
                'value_4' => $value_4,
                'user_selection_4' => $user_selection_4,
                'value_5' => $value_5,
                'user_selection_5' => $user_selection_5,

                'percentage' => $percentage_earned,
            ]);

            $this->markActivityAsCompleted($sessionToken, $game_id);
            DB::commit();

            return redirect()->route('index.game5', ['sessionid' => $sessionId]);
        }catch(Exception $e){
            // Si algo falla, hacer rollback
            DB::rollback();

            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Ocurrió un error inesperado.'
            ]);
        }
    }

    public function store6(string $sessionToken, string $game_id, Request $request){
        $rules = [
            'time' => 'required|integer',
        ];

        // Game6Result
        try{
            // Validar los datos
            $validatedData = $request->validate($rules);

            // Iniciar una transacción
            DB::beginTransaction();

            // GENERAR UN UUID PARA LA SESION
            $sessionId = Str::uuid();

            $timeRequired = $request->input('time');

            if(!$timeRequired){
                $timeRequired = 0;
            }

            // Obtener el user_id del usuario autenticado
            $userId = Auth::user()->id;

            Game6Result::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'time' => $timeRequired,
            ]);

            $this->markActivityAsCompleted($sessionToken, $game_id);
            DB::commit();

            return redirect()->route('index.game6', ['sessionid' => $sessionId]);
        }catch(Exception $e){
            // Si algo falla, hacer rollback
            DB::rollback();

            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Ocurrió un error inesperado.'
            ]);
        }
    }

    /*private function markActivityAsCompleted(string $sessionToken, string $game_id){
        $sessionRecord = UserActivity::where('session_id', $sessionToken)->first();

        $updated = false;

        if($sessionRecord){
            if($sessionRecord->activity_id_1 == $game_id){
                $sessionRecord->activity_1_completed = true;
                $updated = true;
            }elseif($sessionRecord->activity_id_2 == $game_id){
                $sessionRecord->activity_2_completed = true;
                $updated = true;
            }elseif($sessionRecord->activity_id_3 == $game_id){
                $sessionRecord->activity_3_completed = true;
                $updated = true;
            }

            if($updated){
                $sessionRecord->save();
            }
        }

        return $updated;
    }*/

    private function markActivityAsCompleted(string $sessionToken, string $game_id) {
        $sessionRecord = UserActivity::where('session_id', $sessionToken)->first();
    
        if (!$sessionRecord) {
            return false;
        }
    
        // Crear un array con las actividades y sus estados
        $activities = [
            'activity_id_1' => 'activity_1_completed',
            'activity_id_2' => 'activity_2_completed',
            'activity_id_3' => 'activity_3_completed',
            'activity_id_4' => 'activity_4_completed',
            'activity_id_5' => 'activity_5_completed',
            'activity_id_6' => 'activity_6_completed',
        ];
    
        // Buscar la actividad y marcarla como completada
        foreach ($activities as $activityIdField => $completedField) {
            if ($sessionRecord->$activityIdField == $game_id) {
                $sessionRecord->$completedField = true;
                $sessionRecord->save();
                return true;
            }
        }
    
        return false;
    }
}