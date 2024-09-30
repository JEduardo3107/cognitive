<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\ProfileQuestion;
use App\Models\AvailableArea;
use Illuminate\Support\Facades\Validator;
use Exception;

use function Ramsey\Uuid\v1;

class QuestionsController extends Controller implements HasMiddleware{
    public static function middleware(): array{
        return [
            new Middleware('role:administrador', only: ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy'])
        ];
    }

    public function index(){
        $areas = AvailableArea::where('is_enabled', true)
        ->with(['questions' => function($query) {
            $query->where('is_enabled', true)->with('answers');
        }])->get();

        return view('pages.questions', [
            'areas' => $areas
        ]);
    }

    public function show(ProfileQuestion $question){
        if($question->is_enabled == false){
            abort(404);
        }

        $answers = $question->answers;

        return view('pages.question-details', [
            'question' => $question,
            'answers' => $answers
        ]);
    }

    public function create(AvailableArea $area){
        return view('pages.create-question', [
            'area' => $area
        ]);
    }

    public function store(AvailableArea $area, Request $request){
        $rules = [
            'question' => 'required|string|min:10|max:250',
        ];
        
        $messages = [
            'question.required' => 'La pregunta es requerida.',
            'question.string' => 'La pregunta no es compatible.',
            'question.min' => 'La pregunta debe tener al menos :min caracteres.',
            'question.max' => 'La pregunta no puede tener más de :max caracteres.',
        ];

        $validator = Validator::make([
            'question' => $request->input('question')
        ], $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try{
            $orderPosition = ProfileQuestion::where('is_enabled', true)->count() + 1;

            ProfileQuestion::create([
                'area_id' => $area->id,
                'question_title' => $request->input('question'),
                'is_enabled' => true,
                'order_position' => $orderPosition
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Hubo un error al crear la pregunta. Por favor, inténtelo de nuevo.'
            ]);
        }

        return redirect()->route('questions.index')->with('notification', [
            'type' => 'success',
            'message' => 'Pregunta creada correctamente.'
        ]);
    }

    public function edit(ProfileQuestion $question){
        if($question->is_enabled == false){
            abort(404);
        }

        return view('pages.show-question', [
            'question' => $question
        ]);
    }

    public function update(ProfileQuestion $question, Request $request){
        if($question->is_enabled == false){
            abort(404);
        }

        $rules = [
            'question' => 'required|string|min:10|max:250',
        ];
        
        $messages = [
            'question.required' => 'La pregunta es requerida.',
            'question.string' => 'La pregunta no es compatible.',
            'question.min' => 'La pregunta debe tener al menos :min caracteres.',
            'question.max' => 'La pregunta no puede tener más de :max caracteres.',
        ];

        $validator = Validator::make([
            'question' => $request->input('question')
        ], $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try{
            $question->update([
                'question_title' => $request->input('question')
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Hubo un error al actualizar la pregunta. Por favor, inténtelo de nuevo.'
            ]);
        }

        return redirect()->route('questions.index')->with('notification', [
            'type' => 'success',
            'message' => 'Pregunta actualizada correctamente.'
        ]);
    }

    public function destroy(ProfileQuestion $question){
        if($question->is_enabled == false){
            abort(404);
        }

        try{
            $question->update([
                'is_enabled' => false
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Hubo un error al desactivar la pregunta. Por favor, inténtelo de nuevo.'
            ]);
        }

        return redirect()->route('questions.index')->with('notification', [
            'type' => 'success',
                'message' => 'La pregunta ha sido desactivada correctamente.'
        ]);
    }
}