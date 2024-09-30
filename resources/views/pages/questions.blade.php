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

    @foreach($areas as $currentArea)
        <section class="section-container">
            <span class="section-container__title-container">
                {{ $currentArea->area_name }}
            </span>

            <div class="section-container__selection-container">
                @foreach($currentArea->questions as $currentQuestion)
                    <a href="{{ route('questions.show', ['question' => $currentQuestion->id]) }}" class="noDefaultStyle unselectable section-container__normal-section">
                        <span class="section-container__normal-section-action">
                            {{ $currentQuestion->answers->count() }} 
                        </span>
                        <span class="section-container__normal-section-title">
                            <p>
                                {{ $currentQuestion->question_title }}
                            </p>
                        </span>
                    </a>
                @endforeach

                <a href="{{ route('questions.create', ['area' => $currentArea->id]) }}" class="noDefaultStyle unselectable section-container__normal-section">
                    <span class="section-container__normal-section-action bg--green">
                        <img src="{{ asset('img/action/icon-4.png') }}" alt="Agregar" class="section-container__normal-section-action-icon">
                    </span>
                    <span class="section-container__normal-section-title">
                        <p>
                            Nueva pregunta
                        </p>
                    </span>
                </a>
            </div>
        </section>
    @endforeach

@endsection

@push('script')

@endpush