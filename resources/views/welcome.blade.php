@extends('layouts.app')

@section('pageTitle')
    Cognitive
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/containers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainDashboard.css') }}">
@endpush

@push('headerScript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    

    {{--<section class="section-container">
        <span class="section-container__title-container">
            Actividades
        </span>


    </section>--}}


@endsection

@push('script')

@endpush