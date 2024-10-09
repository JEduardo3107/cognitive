<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LoginStreak;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckLoginStreak{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
         // Obtener la fecha de hoy
        $today = Carbon::today()->toDateString();
        $user = Auth::user();
        
       // $currentUser = User::findOrFail(Auth::id());
        // Verificar si el usuario es administrador
        if($user->hasRole('administrador')){
            return $next($request);
        }

         // Verificar si ya hay un registro para el día de hoy del usuario autenticado
        $existingLogin = LoginStreak::where('day_login', $today)
            ->where('user_id', $user->id)
            ->first();

        if(!$existingLogin){
            // Si no existe un registro, crearlo para el usuario autenticado
            LoginStreak::create([
                'day_login' => $today,
                'hour_login' => Carbon::now()->toTimeString(),
                'user_id' => $user->id,
            ]);
        }

        return $next($request);
    }
}