@extends('layouts.game')

@section('pageTitle')
    Resultados
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game6.css') }}">
@endpush

@section('content')
    <div class="unselectable game-container">
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        ¡Genial!
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
                        Lograste completar el juego en un tiempo de {{ $formattedTime }}.
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="banner-message">
                    <p>
                        Felicidades, has completado el juego de memoria. ¡Sigue así!
                    </p>
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