<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserActivity;

class CheckActivityStatus{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{

        $sessionToken = $request->route('sessionToken');
        $game_id = $request->route('game_id');

        if(!$sessionToken || !$game_id){
            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Sesión no válida.'
            ]);
        }

        // Obtener el registro de UserActivity
        $userSession = UserActivity::where('session_id', $sessionToken)->first();

        if(!$userSession){
            return redirect()->route('home.index')->with('notification', [
                'type' => 'error',
                'message' => 'Sesión no válida.'
            ]);
        }

        // Verifica si $game->game_id existe en una de las actividades
        if ($userSession->activity_id_1 == $game_id || $userSession->activity_id_2 == $game_id || $userSession->activity_id_3 == $game_id) {
            if($userSession->created_at->isToday()){
                if (($userSession->activity_id_1 == $game_id && $userSession->activity_1_completed) ||
                    ($userSession->activity_id_2 == $game_id && $userSession->activity_2_completed) ||
                    ($userSession->activity_id_3 == $game_id && $userSession->activity_3_completed)) {
                    return redirect()->route('home.index')->with('notification', [
                        'type' => 'info',
                        'message' => 'La actividad ya fue completada.'
                    ]);
                }
            }else{
                return redirect()->route('home.index')->with('notification', [
                    'type' => 'info',
                    'message' => 'La actividad ha expirado.'
                ]);
            }
        }else{
            return redirect()->route('home.index')->with('notification', [
                'type' => 'info',
                'message' => 'Actividad no disponible.'
            ]);
        }

        return $next($request);
    }
}