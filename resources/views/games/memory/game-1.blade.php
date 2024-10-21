@extends('layouts.game')

@section('pageTitle')
    {{ $game->name }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game2.css') }}">
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

    <form action="{{ route('gamestore.game2', ['sessionToken' => $sessionToken, 'game_id' => $game->id]) }}" method="post" class="unselectable game-container" id="game-form">
        @csrf
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        Nivel <span id="current-level">1</span> - 4
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
                        Marca el numero correctamente
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="game-container__panel-cards-container">
                    @foreach($phoneNumbers as $index => $currentNumber)
                        <div class="game-container__panel-card-container">
                            <input type="hidden" value="{{ $currentNumber }}" class="game-container__panel-card-input-required" name="number_value_required_{{ $index }}">
                            <div class="game-container__panel-card-preview-container">
                                <div class="game-container__panel-card-preview-title">
                                    Memoriza el número
                                </div>
                            </div>
                            <div class="game-container__panel-card">
                                <img src="{{ asset('img/icon/account.png') }}" class="game-container__panel-card-image">
                                <div class="game-container__panel-card-info">
                                    <div class="game-container__panel-card-name">
                                        {{ $names[$index] }}
                                    </div>
                                    <div class="game-container__panel-card-numbers-container">
                                        @php
                                            $splitNumber = str_split($currentNumber);
                                            $numberLength = count($splitNumber);
                                        @endphp
                                        @foreach($splitNumber as $number)
                                            <div class="game-container__panel-card-number-container">
                                                <p class="game-container__panel-card-number-show">
                                                    {{ $number }}
                                                </p>
                                                <p class="game-container__panel-card-number-hidden">
                                                    *
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="game-container__panel-card-input-container">
                                <input type="hidden" value="" name="number_value_selected_{{ $index }}" class="game-container__panel-card-input-control">
                                @for($i = 0; $i < $numberLength; $i++)
                                    <div class="game-container__panel-card-input">
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="game-container__panel-actions">
            <div class="game-container__panel-action-pad-grid">
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-1">
                    1
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-2">
                    2
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-3">
                    3
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-4">
                    4
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-5">
                    5
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-6">
                    6
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-7">
                    7
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-8">
                    8
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-9">
                    9
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-10">
                    0
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-11 game-container__panel-action-pad-grid-back">
                    <img src="{{ asset('img/icon/backspace-arrow.png') }}" class="game-container__panel-action-pad-grid-icon">
                </button>
                <button type="button" class="noDefaultStyle game-container__panel-action-pad-grid-number game-container__panel-action-pad-grid-12 game-container__panel-action-pad-grid-call">
                    <img src="{{ asset('img/icon/phone-call.png') }}" class="game-container__panel-action-pad-grid-icon">
                </button>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/game-tutorial.js') }}">
    </script>
    <script src="{{ asset('js/games/game2.js') }}">
    </script>
@endpush