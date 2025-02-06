@extends('layouts.game')

@section('pageTitle')
    Resultados
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game4.css') }}">
@endpush

@section('content')
    <div class="unselectable game-container">
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        Porcentaje: {{ $response->percentage }}%
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
                <div class="column-container">
                    <div class="cube-container">
                        <div class="face-1">
                            <img src="{{ asset('img/game4/top/' . $response->number_top . '.jpg') }}" class="face-image">
                        </div>
                    </div>
                    <div class="cube-container">
                        <div class="face-1">
                            <img src="{{ asset('img/game4/center/' . $response->number_center . '.jpg') }}" class="face-image">
                        </div>
                    </div>
                    <div class="cube-container">
                        <div class="face-1">
                            <img src="{{ asset('img/game4/bottom/' . $response->number_bottom . '.jpg') }}" class="face-image">
                        </div>
                    </div>
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