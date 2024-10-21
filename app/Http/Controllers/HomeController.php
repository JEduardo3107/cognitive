<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProfileAnswer;
use App\Models\ActivityArea;
use App\Models\AvailableActivity;
use App\Models\ProfileQuestion;
use App\Models\LoginStreak;
use App\Models\UserActivity;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeController extends Controller{
    public function index(){
        // Obtener el usuario autenticado
        $user = Auth::user();
        $streakCount = 0;
        $daysRequired = env('APP_DAYS_REQUIRED_TO_STREAK', 2);
        $activities = [];
        $session_id = "";
        
        if(!$user->hasRole('administrador')){
            $answeredQuestionIds = ProfileAnswer::where('user_id', $user->id)
            ->pluck('question_id');
    
            $pendingQuestionsCount = ProfileQuestion::where('is_enabled', true)
                ->whereHas('answers')
                ->whereNotIn('id', $answeredQuestionIds)
                ->count();

            if($pendingQuestionsCount > 0){
                return redirect()->route('finishProfile.index');
            }

            $today = Carbon::today();
            $selectedDay = env('APP_DAY_RESET_STREAK', 'Friday');

            // Obtener el día de la semana en forma de número (1 = domingo, 7 = sábado)
            $dayOfWeek = Carbon::parse($selectedDay)->dayOfWeek;

            $nextSelectedDay = $today->isToday() && $today->dayOfWeek === $dayOfWeek 
                ? $today->toDateString() 
                : $today->next($selectedDay)->toDateString();

            $lastSelectedDay = $today->previous($selectedDay)->toDateString();
            $streakCount = LoginStreak::where('user_id', $user->id)
                            ->whereBetween('day_login', [$lastSelectedDay, $nextSelectedDay])
                            ->count();

            // TODO: ACTIVIDADES DEL USUARIO
            // Obtener el registro de actividades del usuario para el día actual
            $userActivity = UserActivity::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->first();

            // Si se encontró el registro del día, recuperar las 3 actividades
            if($userActivity){
                $session_id = $userActivity->session_id;

                $activities = [
                    [
                        'activity' => AvailableActivity::find($userActivity->activity_id_1),
                        'is_completed' => $userActivity->activity_1_completed,
                    ],
                    [
                        'activity' => AvailableActivity::find($userActivity->activity_id_2),
                        'is_completed' => $userActivity->activity_2_completed,
                    ],
                    [
                        'activity' => AvailableActivity::find($userActivity->activity_id_3),
                        'is_completed' => $userActivity->activity_3_completed,
                    ],
                ];
            }else{

                // Seleccionar 3 áreas de actividad aleatorias con al menos una actividad disponible
                $activityAreas = ActivityArea::has('availableActivities')
                    ->inRandomOrder()
                    ->take(3)
                    ->get();

                $activitiesIds = [];

                foreach ($activityAreas as $activityArea) {
                    // Seleccionar una actividad aleatoria por cada área de actividad
                    $activity = $activityArea->availableActivities()
                                ->inRandomOrder()
                                ->first();

                    if ($activity) {
                        $activitiesIds[] = $activity->id;
                    }
                }

                // Crear el registro en UserActivity
                $userRegister = UserActivity::create([
                    'user_id' => $user->id,
                    'activity_id_1' => $activitiesIds[0] ?? null, // Verifica si existe el índice
                    'activity_id_2' => $activitiesIds[1] ?? null,
                    'activity_id_3' => $activitiesIds[2] ?? null
                ]);

                $session_id = $userRegister->session_id;

                $activities = [
                    [
                        'activity' => AvailableActivity::find($userRegister->activity_id_1),
                        'is_completed' => false,
                    ],
                    [
                        'activity' => AvailableActivity::find($userRegister->activity_id_2),
                        'is_completed' => false,
                    ],
                    [
                        'activity' => AvailableActivity::find($userRegister->activity_id_3),
                        'is_completed' => false,
                    ],
                ];
            }
        }
    
        return view('welcome', [
            'session_id' => $session_id,
            'streakCount' => $streakCount,
            'daysRequired' => $daysRequired,
            'activities' => $activities,
        ]);
    }
}