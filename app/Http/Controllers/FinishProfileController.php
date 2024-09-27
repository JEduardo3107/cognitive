<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProfileQuestion;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
}