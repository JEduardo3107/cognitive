@extends('layouts.game')

@section('pageTitle')
    Resultados
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game1.css') }}">
@endpush

@section('content')
    <div class="unselectable game-container">
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        Aciertos {{ $aciertos }}-{{ $totalAcierto }}
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
                <div class="game-container__lineal-cards-container">
                    @foreach($responses as $currentResponse)
                        @php
                            $parts = explode('*', $currentResponse->word->display_word);
                        @endphp

                        <div class="game-container__lineal-card">
                            @if(count($parts) === 2)
                                <span class="game-container__lineal-card-normal-word">
                                    {{ $parts[0] }}
                                </span>
                                <span class="game-container__lineal-card-selection-box">
                                    <p class="{{ ($currentResponse->status) ? 'game-container__lineal-card-selection-true' : 'game-container__lineal-card-selection-false' }}">
                                        {{ $currentResponse->user_selection }}
                                    </p>
                                </span>
                                <span class="game-container__lineal-card-normal-word">
                                    {{ $parts[1] }}
                                </span>
                            @else
                                <span class="game-container__lineal-card-normal-word">
                                    {{ $currentResponse->word->display_word }}
                                </span>
                            @endif
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