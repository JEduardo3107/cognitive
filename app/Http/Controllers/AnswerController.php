<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\ProfileQuestion;
use App\Models\ProfileQuestionAnswer;
use Illuminate\Support\Facades\Validator;
use Exception;

class AnswerController extends Controller implements HasMiddleware{
    public static function middleware(): array{
        return [
            new Middleware('role:administrador', only: ['create', 'store', 'show', 'update', 'destroy'])
        ];
    }
    public function create(ProfileQuestion $question){
        return view('pages.create-answer', [
            'question' => $question
        ]);
    }

    public function store(ProfileQuestion $question, Request $request){
        $rules = [
            'answer' => 'required|string|min:1|max:50',
        ];
        
        $messages = [
            'answer.required' => 'La respuesta es requerida.',
            'answer.string' => 'La respuesta no es compatible.',
            'answer.min' => 'La respuesta debe tener al menos :min caracteres.',
            'answer.max' => 'La respuesta no puede tener más de :max caracteres.',
        ];

        $validator = Validator::make([
            'answer' => $request->input('answer')
        ], $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try{
            $orderPosition = ProfileQuestionAnswer::where('is_enabled', true)->count() + 1;

            ProfileQuestionAnswer::create([
                'profile_question_id' => $question->id,
                'answer_text' => $request->input('answer'),
                'is_enabled' => true,
                'order_position' => $orderPosition
            ]);

        }catch(Exception $e){
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Hubo un error al crear la respuesta. Por favor, inténtelo de nuevo.'
            ]);
        }

        return redirect()->route('questions.index')->with('notification', [
            'type' => 'success',
            'message' => 'Respuesta creada correctamente.'
        ]);
    }

    public function show(ProfileQuestionAnswer $answer){
        if($answer->is_enabled == false){
            abort(404);
        }

        return view('pages.show-answer', [
            'answer' => $answer
        ]);

    }

    public function update(ProfileQuestionAnswer $answer, Request $request){

        if($answer->is_enabled == false){
            abort(404);
        }

        $rules = [
            'answer' => 'required|string|min:1|max:50',
        ];
        
        $messages = [
            'answer.required' => 'La respuesta es requerida.',
            'answer.string' => 'La respuesta no es compatible.',
            'answer.min' => 'La respuesta debe tener al menos :min caracteres.',
            'answer.max' => 'La respuesta no puede tener más de :max caracteres.',
        ];

        $validator = Validator::make([
            'answer' => $request->input('answer')
        ], $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try{
            $answer->update([
                'answer_text' => $request->input('answer')
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Hubo un error al actualizar la respuesta. Por favor, inténtelo de nuevo.'
            ]);
        }

        return redirect()->route('questions.index')->with('notification', [
            'type' => 'success',
            'message' => 'Respuesta actualizada correctamente.'
        ]);
    }

    public function destroy(ProfileQuestionAnswer $answer){
        try{
            $answer->update([
                'is_enabled' => false
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Hubo un error al desactivar la respuesta. Por favor, inténtelo de nuevo.'
            ]);
        }

        return redirect()->route('questions.index')->with('notification', [
            'type' => 'success',
                'message' => 'La respuesta ha sido desactivada correctamente.'
        ]);
    }
}