@extends('layouts.game')

@section('pageTitle')
    {{ $game->name }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game5.css') }}">
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

    <form action="{{ route('gamestore.game5', ['sessionToken' => $sessionToken, 'game_id' => $game->id]) }}" method="post" class="unselectable game-container" id="game-form">
        @csrf

        <input type="hidden" name="option_1" value="{{ $randomValues[0]->id }}">
        <input type="hidden" name="option_2" value="{{ $randomValues[1]->id }}">
        <input type="hidden" name="option_3" value="{{ $randomValues[2]->id }}">
        <input type="hidden" name="option_4" value="{{ $randomValues[3]->id }}">
        <input type="hidden" name="option_5" value="{{ $randomValues[4]->id }}">

        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        Nivel <span id="current-level">1</span> - 5
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
                        Toque el botón azul para ver la lista de opciones y seleccione la palabra que corresponda a la imagen, cuando se sienta seguro de su respuesta, presione el botón "Siguiente" para continuar.
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="game-dynamic-panel game-dynamic-panel--visible">
                    <div class="game-dynamic-panel__image-container">
                        <img src="{{ asset('img/game5/' . $randomValues[0]->image . '.jpg') }}" class="game-dynamic-panel__image">
                    </div>
                    <select name="user_selection_1" class="noDefaultStyle game-dynamic-panel__selector">
                        @foreach ($options[0] as $currentOption)
                            <option value="{{ $currentOption->id }}">{{ $currentOption->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="game-dynamic-panel">
                    <div class="game-dynamic-panel__image-container">
                        <img src="{{ asset('img/game5/' . $randomValues[1]->image . '.jpg') }}" class="game-dynamic-panel__image">
                    </div>
                    <select name="user_selection_2" class="noDefaultStyle game-dynamic-panel__selector">
                        @foreach ($options[1] as $currentOption)
                            <option value="{{ $currentOption->id }}">{{ $currentOption->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="game-dynamic-panel">
                    <div class="game-dynamic-panel__image-container">
                        <img src="{{ asset('img/game5/' . $randomValues[2]->image . '.jpg') }}" class="game-dynamic-panel__image">
                    </div>
                    <select name="user_selection_3" class="noDefaultStyle game-dynamic-panel__selector">
                        @foreach ($options[2] as $currentOption)
                            <option value="{{ $currentOption->id }}">{{ $currentOption->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="game-dynamic-panel">
                    <div class="game-dynamic-panel__image-container">
                        <img src="{{ asset('img/game5/' . $randomValues[3]->image . '.jpg') }}" class="game-dynamic-panel__image">
                    </div>
                    <select name="user_selection_4" class="noDefaultStyle game-dynamic-panel__selector">
                        @foreach ($options[3] as $currentOption)
                            <option value="{{ $currentOption->id }}">{{ $currentOption->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="game-dynamic-panel">
                    <div class="game-dynamic-panel__image-container">
                        <img src="{{ asset('img/game5/' . $randomValues[4]->image . '.jpg') }}" class="game-dynamic-panel__image">
                    </div>
                    <select name="user_selection_5" class="noDefaultStyle game-dynamic-panel__selector">
                        @foreach ($options[4] as $currentOption)
                            <option value="{{ $currentOption->id }}">{{ $currentOption->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="game-container__panel-actions">
            <button type="button" class="noDefaultStyle game-container__panel-action-next" id="finalize-button">
                Siguiente
            </button>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('js/game-tutorial.js') }}">
    </script>
    <script src="{{ asset('js/games/game5.js') }}">
    </script>
@endpush