@extends('layouts.app')

@section('pageTitle')
    Preguntas
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/containers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainDashboard.css') }}">
@endpush

@section('content')
    {{-- Importar menu --}}
    <x-menu-component />

    <section class="section-container">
        <span class="section-container__title-container">
            Detalles
        </span>

        <a href="{{ route('questions.edit', ['question' => $question->id]) }}" class="noDefaultStyle unselectable section-container__question-edit-container">
            {{ $question->question_title }}
        </a>

        <div class="section-container__selection-container">
            @foreach ($answers as $currentAnswer)
                <a href="{{ route('answer.show', ['answer' => $currentAnswer->id]) }}" class="noDefaultStyle unselectable section-container__normal-section">
                    <span class="section-container__normal-section-action">
                        <img src="{{ asset('img/action/icon-3.png') }}" alt="Agregar" class="section-container__normal-section-action-icon">
                    </span>
                    <span class="section-container__normal-section-title">
                        <p>
                            {{ $currentAnswer->answer_text }}
                        </p>
                    </span>
                </a>
            @endforeach

            <a href="{{ route('answer.create', ['question' => $question->id]) }}" class="noDefaultStyle unselectable section-container__normal-section">
                <span class="section-container__normal-section-action bg--green">
                    <img src="{{ asset('img/action/icon-4.png') }}" alt="Agregar" class="section-container__normal-section-action-icon">
                </span>
                <span class="section-container__normal-section-title">
                    <p>
                        Nueva Respuesta
                    </p>
                </span>
            </a>
        </div>
    </section>

@endsection

@push('script')

@endpush