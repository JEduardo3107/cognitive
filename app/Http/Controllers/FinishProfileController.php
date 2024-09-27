<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProfileQuestion;
use Illuminate\Support\Facades\Auth;

class FinishProfileController extends Controller{
    public function index(){
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verifica si el perfil está completo
        if($user->profile_completed){
            // Redirige a la ruta finishProfile.index si el perfil no está completo
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
}