@extends('layouts.game')

@section('pageTitle')
    {{ $game->name }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game6.css') }}">
@endpush

@section('content')
    <div class="game-tutorial-container" id="tutorial-card">
        <div class="game-tutorial-container__tutorial-container">
            <div class="game-tutorial-container__tutorial-title">
                {{ $game->name }}
            </div>
            <div class="game-tutorial-container__tutorial-video-container">
                <img src="{{ asset('img/banner/Banner.jpeg') }}" alt="Ilustración de perfil" class="game-tutorial-container__tutorial-video">
            </div>
            <div class="game-tutorial-container__tutorial-instructions-container">
                <div class="game-tutorial-container__tutorial-instructions-title">
                    {{ $game->instructions }}
                </div>
            </div>
        </div>
        <div class="game-tutorial-container__actions-container">
            <button class="noDefaultStyle game-tutorial-container__action" id="tutorial-card__button">
                Comenzar
            </button>
        </div>
    </div>

    <form action="{{ route('gamestore.game6', ['sessionToken' => $sessionToken, 'game_id' => $game->id]) }}" method="post" class="unselectable game-container" id="game-form">
        @csrf
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        8 Pares
                    </span>
                    <div class="game-container__panel-timer-counter-container">
                        <img src="{{ asset('img/icon/hourglass.png') }}" alt="Icono de reloj" class="game-container__panel-timer-icon">
                        <span class="game-container__panel-timer-counter" id="game-timer">
                            00:00
                        </span>
                        <input type="hidden" value="" name="time" id="time">
                    </div>
                </div>
                <div class="game-container__panel-title-container">
                    <p>
                        Selecciona las cartas que contienen el mismo patron
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="memory-board">
                    @foreach ($randomNumbers as $currentNumber)
                        <div class="memory-card" data-card-id="{{ $currentNumber }}">
                            <div class="card-inner">
                                <div class="card-front">
                                    ?
                                </div>
                                <div class="card-back">
                                    <img src="{{ asset('img/game6/'. $currentNumber .'.jpg') }}" class="card-image">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($randomNumbers as $currentNumber)
                        <div class="memory-card" data-card-id="{{ $currentNumber }}">
                            <div class="card-inner">
                                <div class="card-front">
                                    ?
                                </div>
                                <div class="card-back">
                                    <img src="{{ asset('img/game6/'. $currentNumber .'.jpg') }}" class="card-image">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="game-container__panel-actions">
            <button type="submit" class="noDefaultStyle game-container__panel-action-next" id="finalize-button" disabled>
                Finalizar
            </button>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('js/game-tutorial.js') }}">
    </script>
    <script src="{{ asset('js/games/game6.js') }}">
    </script>
@endpush