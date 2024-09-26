<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
    function index(){
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verifica si el perfil está completo
        if(!$user->profile_completed){
            // Redirige a la ruta finishProfile.index si el perfil no está completo
            return redirect()->route('finishProfile.index');
        }

        // Si el perfil está completo, muestra la vista 'welcome'
        return view('welcome');
    }
}