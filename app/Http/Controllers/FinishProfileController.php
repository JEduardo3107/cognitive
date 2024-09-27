<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProfileQuestion;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProfileAnswer;
use Illuminate\Support\Facades\DB;
use Exception;

class FinishProfileController extends Controller{
    public function index(){
        // Obtener el usuario autenticado
        $user = Auth::user();

        $currentUser = User::findOrFail(Auth::id());

        if($currentUser->hasRole('administrador')){
            return redirect()->route('home.index');
        }

        // Verifica si el perfil está completo
        if($user->profile_completed){
            return redirect()->route('home.index');
        }

        $questions = ProfileQuestion::with(['answers'])
        ->where('is_enabled', true)
        ->orderBy('order_position')
        ->get()->groupBy('area');

        return view('pages.complete-profile', [
            'questions' => $questions
        ]);
    }

    public function store(Request $request){
        $rules = [];

        // Recorrer todas las entradas del request para agregar las reglas de validación
        foreach ($request->all() as $key => $value) {
            // Verificar que el campo siga el patrón 'question-'
            if (preg_match('/^question-\d+$/', $key)) {
                // Agregar la regla para verificar que el valor exista en la tabla profile_question_answers en el campo id
                $rules[$key] = 'required|string|uuid|exists:profile_question_answers,id';
            }
        }

        try {
            // Intentar validar los datos
            $validatedData = $request->validate($rules);

            // Obtener el user_id del usuario autenticado
            $userId = Auth::user()->id;

            // Iniciar una transacción
            DB::beginTransaction();

            // Insertar las respuestas en la base de datos
            foreach ($validatedData as $key => $value) {
                ProfileAnswer::create([
                    'user_id' => $userId,
                    'user_question_answer_selected' => $value,
                ]);
            }

            // Actualizar el campo 'profile_completed' del usuario
            $currentUser = User::findOrFail($userId);
            $currentUser->profile_completed = true;
            $currentUser->save();

            // Si todo fue bien, hacer commit
            DB::commit();


            return redirect()->route('home.index')->with('notification', [
                'type' => 'success',
                'message' => 'Datos guardados correctamente.'
            ]);
        } catch(Exception $e) {
            // Si algo falla, hacer rollback
            DB::rollback();

            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Ocurrió un error inesperado. Por favor, intenta de nuevo.'
            ]);
        }
    }
}