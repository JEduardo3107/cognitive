@extends('layouts.game')

@section('pageTitle')
    Resultados
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game5.css') }}">
@endpush

@section('content')
    <div class="unselectable game-container">
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        Aciertos {{ $response->percentage }}-5
                    </span>
                    <div class="game-container__panel-timer-counter-container">
                        <img src="{{ asset('img/icon/hourglass.png') }}" alt="Icono de reloj" class="game-container__panel-timer-icon">
                        <span class="game-container__panel-timer-counter">
                            {{ $formattedTime }}
                        </span>
                    </div>
                </div>
                <div class="game-container__panel-title-container">
                    <p>
                        {{ $message }}
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="game-response-column">
                    @foreach ($options as $index => $currentOption)
                        @php
                            $isCorrect = $currentOption->id == $selections[$index]->id;
                        @endphp
                        
                        <div class="game-response-row {{ $isCorrect ? '' : 'game-response-row--error' }}">
                            <div class="game-response__image-container">
                                <img src="{{ asset('img/game5/'. $currentOption->image .'.jpg') }}" alt="Imagen 1" class="game-response__image">
                            </div>
                            <div class="game-response__resume">
                                <span class="flag">
                                    {{ $isCorrect ? 'Correcto' : 'Incorrecto' }}
                                </span>
                                <p>
                                    {{ $selections[$index]->name }}
                                </p>
                                @if(!$isCorrect)
                                    <span class="correctName">
                                        Nombre correcto: <p>{{ $currentOption->name }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="game-container__panel-actions">
            <a href="{{ route('home.index') }}" class="noDefaultStyle game-container__panel-action-finish">
                Finalizar
            </a>
        </div>
    </div>
@endsection

@push('script')

@endpush