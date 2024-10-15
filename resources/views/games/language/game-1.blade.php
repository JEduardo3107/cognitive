@extends('layouts.game')

@section('pageTitle')
    {{ $game->name }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game1.css') }}">
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

    <form action="{{ route('gamestore.game1') }}" method="post" class="unselectable game-container">
        @csrf
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        Letras {{ $randomLevel->option1 }}-{{ $randomLevel->option2 }}
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
                        Selecciona <span>"{{ $randomLevel->option1 }}" </span>ó <span>"{{ $randomLevel->option2 }}"</span> según corresponda
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="game-container__lineal-cards-container">
                    @php
                        $select_count = 0;
                    @endphp
                    
                    @foreach ($randomLevel->options as $currentOption)
                        @php
                            $parts = explode('*', $currentOption->display_word);
                        @endphp
                    
                        <div class="game-container__lineal-card">
                            @if (count($parts) === 2)  {{-- Si hay dos partes --}}
                                <span class="game-container__lineal-card-normal-word">
                                    {{ $parts[0] }} {{-- Parte antes del * --}}
                                </span>
                                <span class="game-container__lineal-card-selection-box">
                                    <input type="hidden" value="{{ $currentOption->id }}" name="word_{{ $select_count  }}">

                                    <select class="noDefaultStyle game-container__lineal-card-selection-element" name="selection_{{ $select_count++  }}" required>
                                        <option value="" selected disabled>
                                            -
                                        </option>
                                        <option value="{{ $randomLevel->option1 }}">
                                            {{ $randomLevel->option1 }}
                                        </option>
                                        <option value="{{ $randomLevel->option2 }}">
                                            {{ $randomLevel->option2 }}
                                        </option>
                                    </select>
                                </span>
                                <span class="game-container__lineal-card-normal-word">
                                    {{ $parts[1] }} {{-- Parte después del * --}}
                                </span>
                            @else
                                {{-- Si no hay asterisco, mostrar la palabra completa --}}
                                <span class="game-container__lineal-card-normal-word">
                                    {{ $currentOption->display_word }}
                                </span>
                            @endif
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
    <script src="{{ asset('js/games/game1.js') }}">
    </script>
@endpush