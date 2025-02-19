@extends('layouts.app')

@section('pageTitle')
    Pinceles mentales
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/containers.css') }}">
    @role('administrador')
        <link rel="stylesheet" href="{{ asset('css/mainDashboard.css') }}">
    @endrole

    @hasNotRole('administrador')
        <link rel="stylesheet" href="{{ asset('css/streakBanner.css') }}">
        <link rel="stylesheet" href="{{ asset('css/activities.css') }}">
    @endNotRole
@endpush

@section('content')
    {{-- Importar menu --}}
    <x-menu-component />

    @role('administrador')
        <section class="section-container">
            <span class="section-container__title-container">
                Diagnóstico (Test)
            </span>

            <div class="section-container__selection-container">
                <a href="{{ route('questions.index') }}" class="noDefaultStyle unselectable section-container__normal-section">
                    <span class="section-container__normal-section-action">
                        <img src="{{ asset('img/action/icon-1.png') }}" alt="Agregar" class="section-container__normal-section-action-icon">
                    </span>
                    <span class="section-container__normal-section-title">
                        <p>
                            Administrar preguntas
                        </p>
                    </span>
                </a>
        
                <a href="{{ route('view-question.index') }}" class="noDefaultStyle unselectable section-container__normal-section">
                    <span class="section-container__normal-section-action">
                        <img src="{{ asset('img/action/icon-2.png') }}" alt="Agregar" class="section-container__normal-section-action-icon">
                    </span>
                    <span class="section-container__normal-section-title">
                        Ver respuestas
                    </span>
                </a>
            </div>
        </section>
    @endrole

    {{--<section class="section-container">
        <span class="section-container__title-container">
            Usuarios
        </span>


    </section>--}}

    @hasNotRole('administrador')
        <section class="section-container">
            <span class="section-container__title-container">
                Actividades
            </span>

            <div class="streak-container">
                <div class="streak-container__icon-container">
                    <img src="{{ asset('img/icon/fire-type-streak-2.png') }}" alt="Icono de racha" class="streak-container__icon">
                </div>

                <div class="streak-container__details-container">
                    <div class="streak-container__details-title">
                        @if($streakCount >= $daysRequired)
                            Días ingresando: {{ $streakCount }}
                        @else
                            Días ingresando: ({{ $streakCount }} de {{ $daysRequired }})
                        @endif
                        
                    </div>

                    <div class="streak-container__details-content">
                        @if($streakCount >= $daysRequired)
                            <p>
                                <span>¡Felicidades!</span> Hoy completas las actividades semanales.
                            </p>
                        @else
                            <p>
                                <span>¡Sigue así!</span> Llevas {{ $streakCount }} {{ $streakCount === 1 ? 'día' : 'días' }} realizando actividades.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="activities-container unselectable">
                @foreach ($activities as $index => $currentActivity)
                    @php
                        $cardImage = $currentActivity['activity']->image_name;

                        if($cardImage && $cardImage != ""){
                            $cardImage = asset('img/games_icon/' . $cardImage . '.png');
                        } else {
                            $cardImage = asset('img/games_icon/1.png');
                        }
                    @endphp
                    @if ($currentActivity['is_completed'])
                        <div class="noDefaultStyle activity-container activity--finish">
                            <span class="activity-container__status"></span>
                            <div class="activity-container__content">
                                <div class="activity-container__description-container">
                                    <div class="activity-container__description-title">
                                        <p>
                                            {{ $currentActivity['activity']->name }}
                                        </p>
                                    </div>
                                    <div class="activity-container__description-area">
                                        <p>
                                            {{ $currentActivity['activity']->activityArea->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="activity-container__image-container" style="background: {{ $currentActivity['activity']->activityArea->color }};">
                                    <img src="{{ $cardImage }}" alt="Icono de actividad" class="activity-container__image">
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('game.index', ['sessionid' => $session_id, 'game' => $currentActivity['activity']->id]) }}" class="noDefaultStyle activity-container {{ ($currentActivity['is_completed']) ? 'activity--finish' : '' }}">
                            <span class="activity-container__status"></span>
                            <div class="activity-container__content">
                                <div class="activity-container__description-container">
                                    <div class="activity-container__description-title">
                                        <p>
                                            {{ $currentActivity['activity']->name }}
                                        </p>
                                    </div>
                                    <div class="activity-container__description-area">
                                        <p>
                                            {{ $currentActivity['activity']->activityArea->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="activity-container__image-container" style="background: {{ $currentActivity['activity']->activityArea->color }};">
                                    <img src="{{ $cardImage }}" alt="Icono de actividad" class="activity-container__image">
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
            

            {{--<div class="activities-container">
                @foreach ($activities as $index => $currentActivity)
                    <a href="{{ route('game.index', ['sessionid' => $session_id, 'game' => $currentActivity['activity']->id]) }}" class="noDefaultStyle activity-container {{ ($currentActivity['is_completed']) ? 'activity--finish' : '' }}">
                        <span class="activity-container__status">
                        </span>
                        <div class="activity-container__content">
                            <div class="activity-container__description-container">
                                <div class="activity-container__description-title">
                                    <p>
                                        {{ $currentActivity['activity']->name }}
                                    </p>
                                </div>
                                <div class="activity-container__description-area">
                                    <p>
                                        {{ $currentActivity['activity']->activityArea->name }}
                                    </p>
                                </div>
                            </div>
                            {{-- definir color --}
                            <div class="activity-container__image-container" style="background: {{ $currentActivity['activity']->activityArea->color }};">
                                @php
                                    $cardImage = $currentActivity['activity']->image_name;

                                    if($cardImage && $cardImage != ""){
                                        $cardImage = asset('img/games_icon/' . $cardImage . '.png');
                                    }else{
                                        $cardImage = asset('img/games_icon/1.png');
                                    }
                                @endphp
                                <img src="{{ $cardImage }}" alt="Icono de actividad" class="activity-container__image">
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>--}}
        </section>
    @endNotRole

@endsection

@push('script')

@endpush