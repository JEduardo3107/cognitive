@extends('layouts.guest')

@section('pageTitle')
    Completa tu perfil
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
@endpush

@section('content')
    <div class="preview-card-container" id="preview-card">
        <div class="preview-card-container__content">
            <div class="preview-card-container__image-container">
                <img src="{{ asset('img/banner/Banner.jpeg') }}" alt="Ilustración de perfil" class="preview-card-container__image">
            </div>

            <span class="preview-card-container__author-container">
                Creado por {{ config('app.creator_name') }}
            </span>
            
            <div class="preview-card-container__instructions-container">
                <p>
                    A continuación se te presentará una serie de preguntas que te ayudarán a completar tu perfil.
                </p>
            </div>

            <div class="preview-card-container__time-container">
                <span class="preview-card-container__time-container__title">
                    Tiempo estimado:
                </span>
                <span class="preview-card-container__time-container__time">
                    @php
                        $questionsCounter = 0;

                        foreach($questions as $questionGroup){
                            foreach($questionGroup as $currentQuestion){
                                $questionsCounter++;
                            }
                        }
                    @endphp
                    
                    {{ getEstimatedTime($questionsCounter) }}
                </span>
            </div>
        </div>
        <div class="preview-card-container__actions-container">
            <button class="noDefaultStyle preview-card-container__action" id="preview-card__button">
                Comenzar
            </button>
        </div>
    </div>

    <form action="{{ route('finishProfile.store') }}" method="post" class="card-container unselectable" id="form-to-question-profile">
        @csrf
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
            @php
                $questionIndex = 0;
            @endphp
            @foreach($questions as $questionGroup)
                @foreach($questionGroup as $currentQuestion)
                    <div class="content-container__card-container {{ ($questionIndex == 0) ? 'card-showing' : '' }}{{ ($questionIndex == 1) ? 'card-next' : '' }}">
                        <div class="content-container__card-title">
                            {{ $currentQuestion->question_title }}
                        </div>
                        @php
                            $questionAnswers = $currentQuestion->answers;
                        @endphp
                        <div class="content-container__card-options">
                            @foreach($questionAnswers as $currentAnswer)
                                @php
                                    $randomId = generateRandomId(15);
                                @endphp

                                <label for="{{$randomId}}" class="content-container__select-option">
                                    {{ $currentAnswer->answer_text }}
                                </label>
                                <input type="radio" id="{{$randomId}}" name="question-{{$questionIndex}}" class="displayNone" value="{{ $currentAnswer->id }}">
                            @endforeach
                        </div>
                    </div>
                    @php
                    $questionIndex++;
                @endphp
                @endforeach
            @endforeach
        </div>
        <div class="user-control-container">
            <input type="button" class="rounded-button rounded-button--disabled" value="atrás" id="btn-back">
            <input type="button" class="rounded-button" value="siguiente" id="btn-next">
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('js/preview-card.js') }}">
    </script>
    <script src="{{ asset('js/question.js') }}">
    </script>
@endpush