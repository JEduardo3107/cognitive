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
use Carbon\Carbon;

class HomeController extends Controller{
    public function index(){
        // Obtener el usuario autenticado
        $user = Auth::user();
        $streakCount = 0;
        $daysRequired = env('APP_DAYS_REQUIRED_TO_STREAK', 2);
        $activities = [];
        
        if(!$user->hasRole('administrador')){
            $activities = AvailableActivity::with('activityArea')->get();

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
        }
    
        return view('welcome', [
            'streakCount' => $streakCount,
            'daysRequired' => $daysRequired,
            'activities' => $activities
        ]);
    }
}