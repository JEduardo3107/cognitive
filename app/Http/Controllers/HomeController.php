<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller{
    function index(){
        // Obtener el usuario autenticado
        $user = Auth::user();

        $currentUser = User::findOrFail(Auth::id());

        if(!$currentUser->hasRole('administrador') && !$user->profile_completed){
            return redirect()->route('finishProfile.index');
        }

        // Si el perfil está completo, muestra la vista 'welcome'
        return view('welcome');
    }
}