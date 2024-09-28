<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProfileQuestion;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProfileQuestionController extends Controller implements HasMiddleware{
    public static function middleware(): array{
        return [
            new Middleware('role:administrador', only: ['index'])
        ];
    }

    public function index(){
        // En tu controlador
        $questions = ProfileQuestion::where('is_enabled', true)
        ->with([
            'answers' => function($query) {
                $query->orderBy('order_position', 'asc')
                    ->withCount('answersSelected');
            }
        ])->orderBy('order_position')
        ->get()->groupBy('area');


        return view('pages.manage-questions', [
            'questions' => $questions
        ]);
    }
}