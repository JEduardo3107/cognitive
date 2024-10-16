@extends('layouts.game')

@section('pageTitle')
    {{ $game->name }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game3.css') }}">
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

    <form action="{{ route('gamestore.game3') }}" method="post" class="unselectable game-container">
        @csrf
        <input type="hidden" value="{{ json_encode($numbersDisplayed) }}" name="values">
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        {{ $sequence }} en {{ $sequence }}
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
                        Completa la secuencia de números.
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="game-container__sequence-container">
                    @php
                        $finderIndex = 0;
                    @endphp
                    @foreach($numbersDisplayed as $index => $currentNumber)
                        @if($currentNumber == "*")
                            @if($finderIndex == 0)
                                <input type="number" class="noDefaultStyle game-container__sequence-item-input" placeholder="?" id="first-element-to-find" name="user_sequence_{{ $finderIndex }}" required> 
                            @else
                                <input type="number" class="noDefaultStyle game-container__sequence-item-input" placeholder="?" name="user_sequence_{{ $finderIndex }}" required> 
                            @endif

                            <input type="hidden" value="{{ $sequenceToFind[$finderIndex] }}" name="required_sequence_{{ $finderIndex++ }}">
                        @else
                            <div class="game-container__sequence-item">
                                {{ $currentNumber }}
                            </div>
                        @endif
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
    <script src="{{ asset('js/games/game3.js') }}">
    </script>
@endpush