<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Games\Game1Setting;
use App\Models\Result\Game1Result;
use App\Models\Result\Game2Result;
use Illuminate\Support\Str;
use Exception;

class GameProcessController extends Controller{
    public function store1(Request $request){
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

    public function store2(Request $request){
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

            return redirect()->route('index.game2', ['sessionid' => $sessionId]);

           // DB::commit();
        }catch(Exception $e){
            // Si algo falla, hacer rollback
           // DB::rollback();

            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Ocurrió un error inesperado.'
            ]);
        }
    }

}