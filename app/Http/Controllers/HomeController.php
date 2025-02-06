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

                // Obtener los IDs de las actividades
                $activitiesIds = [
                    $userActivity->activity_id_1,
                    $userActivity->activity_id_2,
                    $userActivity->activity_id_3,
                    $userActivity->activity_id_4,
                    $userActivity->activity_id_5,
                    $userActivity->activity_id_6,
                ];

                // Obtener las actividades en una sola consulta y asegurarnos de mantener el orden
                $activitiesCollection = AvailableActivity::whereIn('id', $activitiesIds)->get()->keyBy('id');

                // Mapear las actividades asegurando que estén bien asignadas
                $activities = collect($activitiesIds)->map(function ($id, $index) use ($userActivity, $activitiesCollection) {
                    return [
                        'activity' => $activitiesCollection->get($id), // Obtener la actividad por ID
                        'is_completed' => $userActivity->{'activity_' . ($index + 1) . '_completed'}, // Obtener el estado correspondiente
                    ];
                })->toArray();
            }else{

                $activityAreas = ActivityArea::has('availableActivities')
                    ->inRandomOrder()
                    ->take(4)
                    ->with(['availableActivities' => function ($query) {
                        $query->inRandomOrder()->take(2); // Tomar 2 actividades por área
                    }])
                    ->get();

                // Obtener las 6 actividades en total
                $activities = $activityAreas->pluck('availableActivities')->flatten()->take(6);
                $activitiesIds = $activities->pluck('id')->toArray();

                // Crear el registro en UserActivity
                $userRegister = UserActivity::create([
                    'user_id' => $user->id,
                    'activity_id_1' => $activitiesIds[0] ?? null, // Verifica si existe el índice
                    'activity_id_2' => $activitiesIds[1] ?? null,
                    'activity_id_3' => $activitiesIds[2] ?? null,
                    'activity_id_4' => $activitiesIds[3] ?? null,
                    'activity_id_5' => $activitiesIds[4] ?? null,
                    'activity_id_6' => $activitiesIds[5] ?? null
                ]);

                $session_id = $userRegister->session_id;

                $activities = $activities->map(fn($activity) => [
                    'activity' => $activity,
                    'is_completed' => false,
                ])->toArray();
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