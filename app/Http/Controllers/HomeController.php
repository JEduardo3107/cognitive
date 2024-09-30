<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProfileAnswer;
use App\Models\ProfileQuestion;

class HomeController extends Controller{
    public function index(){
        // Obtener el usuario autenticado
        $user = Auth::user();
        $currentUser = User::findOrFail(Auth::id());
    
        if($currentUser->hasRole('administrador')){
            return view('welcome');
        }
    
        $answeredQuestionIds = ProfileAnswer::where('user_id', $user->id)
            ->pluck('question_id');
    
        $pendingQuestionsCount = ProfileQuestion::where('is_enabled', true)
            ->whereHas('answers')
            ->whereNotIn('id', $answeredQuestionIds)
            ->count();

        if ($pendingQuestionsCount > 0) {
            return redirect()->route('finishProfile.index');
        }
    
        return view('welcome');
    }
}