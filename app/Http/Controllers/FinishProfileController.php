<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProfileQuestion;

class FinishProfileController extends Controller{
    public function index(){
        $questions = ProfileQuestion::with(['answers'])
        ->where('is_enabled', true)
        ->orderBy('order_position')
        ->get()->groupBy('area');

        return view('complete-profile', [
            'questions' => $questions
        ]);
    }
}