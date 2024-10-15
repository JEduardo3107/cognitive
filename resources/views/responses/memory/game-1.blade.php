@extends('layouts.game')

@section('pageTitle')
    Resultados
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gameLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/games/game2.css') }}">
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
                <div class="game-container__responses-card-container">
                    @foreach($results as $currentResult)
                        <div class="game-container__responses-card-row">
                            @php
                                $splitNumber_original = str_split($currentResult['number']);
                                $splitNumber_user = str_split($currentResult['user_selection']);
                                $coincidencia = $currentResult['coincidencia'];
                            @endphp

                            <div class="game-container__responses-user-container">
                                <div class="game-container__responses-title">
                                    Original:
                                </div>
                                @foreach ($splitNumber_original as $currentOriginalSelection)
                                    <div class="game-container__responses-tag-original">
                                        {{ $currentOriginalSelection }}
                                    </div>
                                @endforeach
                            </div>

                            <div class="game-container__responses-original-container">
                                <div class="game-container__responses-title">
                                    Ingresó:
                                </div>
                                @foreach ($splitNumber_user as $index => $currentUserSelection)
                                    <div class="game-container__responses-tag {{ ($currentUserSelection == $splitNumber_original[$index]) ? 'game-container__responses-tag--true' : '' }}">
                                        {{ $currentUserSelection }}
                                    </div>
                                @endforeach
                            </div>

                            <div class="game-container__responses-original-container">
                                <div class="game-container__responses-title">
                                    Coincidencia:
                                </div>
                                <div class="game-container__responses-percentage">
                                    {{ $coincidencia }}%
                                </div>
                            </div>
                            
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