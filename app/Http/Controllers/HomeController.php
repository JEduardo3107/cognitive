<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileQuestion;

class HomeController extends Controller{
    function index(){

        //$questions = ProfileQuestion::with('answers')->where('is_enabled', true)->get();
        $questions = ProfileQuestion::where('is_enabled', true)->get()->groupBy('area');

        return view('welcome', [
            'questions' => $questions
        ]);
    }
}
