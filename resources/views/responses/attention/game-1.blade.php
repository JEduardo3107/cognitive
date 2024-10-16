@extends('layouts.game')

@section('pageTitle')
    Resultados
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game3.css') }}">
@endpush

@section('content')
    <div class="unselectable game-container">
        <div class="game-container__panel-container">
            <div class="game-container__panel-title">
                <div class="game-container__panel-timer">
                    <span class="game-container__panel-level">
                        @php
                            $sequenceErrors = 0;
                        @endphp
                        @foreach($responses as $currentResponse)
                            @if(!$currentResponse->is_valid)
                                @php
                                    $sequenceErrors++;
                                @endphp
                            @endif
                        @endforeach

                        Errores: {{ $sequenceErrors }}
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
                        El orden de la secuencia ingresada es el siguiente:
                    </p>
                </div>
            </div>
            <div class="game-container__panel">
                <div class="game-container__lineal-cards-container">
                    <div class="game-container__sequence-container">
                        @php
                            $sequenceIndex = 0;
                        @endphp
                        @foreach($originalSequence as $currentSequence)
                            @if($currentSequence == "*")
                                @if($responses[$sequenceIndex]->is_valid)
                                    <div class="game-container__sequence-card--true">
                                        {{ $responses[$sequenceIndex++]->user_input }}
                                    </div>
                                @else
                                    <div class="game-container__sequence-card--false">
                                        {{ $responses[$sequenceIndex++]->user_input }}
                                    </div>
                                @endif
                            @else
                                <div class="game-container__sequence-card">
                                    {{ $currentSequence }}
                                </div>
                            @endif                     
                        @endforeach
                    </div>

                    @if($sequenceErrors > 0)
                        <div class="game-container__sequence-responses-container">
                            @foreach($responses as $currentResponse)
                                @if(!$currentResponse->is_valid)
                                    <div class="game-container__sequence-responses-row">
                                        <div class="game-container__sequence-card--false">
                                            {{ $currentResponse->user_input }}
                                        </div>

                                        <div class="game-container__sequence-card--arrow">
                                            >
                                        </div>

                                        <div class="game-container__sequence-card--original">
                                            {{ $currentResponse->number_required }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
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