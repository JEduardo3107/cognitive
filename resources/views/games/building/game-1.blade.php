@extends('layouts.game')

@section('pageTitle')
    {{ $game->name }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game4.css') }}">
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

    <form action="{{ route('gamestore.game4', ['sessionToken' => $sessionToken, 'game_id' => $game->id]) }}" method="post" class="unselectable game-container">
        @csrf

        <input type="hidden" name="winner" id="winner" value="{{ $winner }}">
        <input type="hidden" name="cube_top" id="cube_top" value="{{ $cube_top[0] }}">
        <input type="hidden" name="cube_center" id="cube_center" value="{{ $cube_center[0] }}">
        <input type="hidden" name="cube_bottom" id="cube_bottom" value="{{ $cube_bottom[0] }}">

        <input type="hidden" id="options_cube_top" data-values='@json($cube_top)'>
        <input type="hidden" id="options_cube_center" data-values='@json($cube_center)'>
        <input type="hidden" id="options_cube_bottom" data-values='@json($cube_bottom)'>

        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        Fácil
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
                        Toca la imagen para moverla y completar al personaje <span>"{{ $character }}"</span> correctamente.
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="column-container">
                    <div class="cube-container">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="face-{{ $i }}">
                                <img src="{{ asset('img/game4/top/' . $cube_top[$i - 1] . '.jpg') }}" class="face-image">
                            </div>
                        @endfor
                    </div>
                    <div class="cube-container">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="face-{{ $i }}">
                                <img src="{{ asset('img/game4/center/' . $cube_center[$i - 1] . '.jpg') }}" class="face-image">
                            </div>
                        @endfor
                    </div>
                    <div class="cube-container">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="face-{{ $i }}">
                                <img src="{{ asset('img/game4/bottom/' . $cube_bottom[$i - 1] . '.jpg') }}" class="face-image">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <div class="game-container__panel-actions">
            <button type="submit" class="noDefaultStyle game-container__panel-action-next" id="finalize-button">
                Finalizar
            </button>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('js/game-tutorial.js') }}">
    </script>
    <script src="{{ asset('js/games/game4.js') }}">
    </script>
@endpush