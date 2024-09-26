@extends('layouts.base')

@section('pageTitle')
    Cognitive
@endsection

@push('styles')
 
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">

@endpush

@section('content')

    

    <div class="card-container">

        <div class="progress-container">
            <span class="progress-container__title" id="question-counter">
                    Pregunta N/A de N/A
            </span>
            <div class="progress-container__progress">
                <span class="progress-container__progress__bar" id="progress-bar">
                </span>
            </div>
        </div>

        <div class="content-container">

            <div class="content-container__card-container actual" id="card-test-1">

                <div class="content-container__card-title">
                    ¿Con qué frecuencia realiza actividades que ejercitan su mente, como crucigramas, sudokus, o juegos de mesa?
                </div>

                <div class="content-container__card-options">

                    <label for="1" class="content-container__select-option">
                        👀 1 vez por semana
                    </label>

                    <label for="2" class="content-container__select-option">
                        😁 2 veces por semana
                    </label>

                    <label for="3" class="content-container__select-option">
                        ❤️ 2 o más veces por semana
                    </label>

                    <label for="4" class="content-container__select-option">
                        😪 Nunca
                    </label>

                    <input type="radio" id="1" name="question-1" class="displayNone">
                    <input type="radio" id="2" name="question-1" class="displayNone">
                    <input type="radio" id="3" name="question-1" class="displayNone">
                    <input type="radio" id="4" name="question-1" class="displayNone">
                </div>

            </div>

            <div class="content-container__card-container siguiente-carta" id="card-test-2">

                <div class="content-container__card-title">
                    ¿Se siente motivado a aprender cosas nuevas, como un pasatiempo o habilidades tecnológicas?
                </div>

                <div class="content-container__card-options">

                    <label for="2-1" class="content-container__select-option">
                        👀 1 vez por semana
                    </label>

                    <label for="2-2" class="content-container__select-option">
                        😁 2 veces por semana
                    </label>

                    <label for="2-3" class="content-container__select-option">
                        ❤️ 2 o más veces por semana
                    </label>

                    <label for="2-4" class="content-container__select-option">
                        😪 Nunca
                    </label>

                    <input type="radio" id="2-1" name="question-2" class="displayNone">
                    <input type="radio" id="2-2" name="question-2" class="displayNone">
                    <input type="radio" id="2-3" name="question-2" class="displayNone">
                    <input type="radio" id="2-4" name="question-2" class="displayNone">
                </div>

            </div>

            <div class="content-container__card-container siguiente-carta" id="card-test-2">

                <div class="content-container__card-title">
                    ¿Le resulta difícil seguir el hilo de conversaciones complejas o programas de televisión?
                </div>

                <div class="content-container__card-options">

                    <label for="3-1" class="content-container__select-option">
                        👀 1 vez por semana
                    </label>

                    <label for="3-2" class="content-container__select-option">
                        😁 2 veces por semana
                    </label>

                    <label for="3-3" class="content-container__select-option">
                        ❤️ 2 o más veces por semana
                    </label>

                    <label for="3-4" class="content-container__select-option">
                        😪 Nunca
                    </label>

                    <input type="radio" id="3-1" name="question-3" class="displayNone">
                    <input type="radio" id="3-2" name="question-3" class="displayNone">
                    <input type="radio" id="3-3" name="question-3" class="displayNone">
                    <input type="radio" id="3-4" name="question-3" class="displayNone">
                </div>

            </div>


        </div>
    
        <div class="user-control-container">
            <input type="button" class="rounded-button rounded-button--disabled" value="atrás" id="btn-back">
            <input type="button" class="rounded-button" value="siguiente" id="btn-next">
        </div>
    </div>

    {{--<span class="button-test" id="btn_test1">
        Test
    </span>--}}
    

@endsection

@push('script')
    <script src="{{ asset('js/question.js') }}">

    </script>
@endpush