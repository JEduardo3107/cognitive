@extends('layouts.app')

@section('pageTitle')
    Pregunta de {{ $question->question_title }}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/containers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainDashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    {{-- Importar menu --}}
    <x-menu-component />

    <section class="section-container">
        <span class="section-container__title-container">
            Nueva respuesta
        </span>
        <form action="{{ route('answer.store', ['question' => $question->id]) }}" method="post" class="oneColumnFlexbox fullW">
            @csrf
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="answer" :value="__('Respuesta')" />
                <x-text-input id="answer" type="text" name="answer" :value="old('answer')" required autofocus />
                <x-input-error :messages="$errors->get('answer')"/>
            </div>

            <div class="form-container__item form-container__item--btn oneColumnFlexbox">
                <x-primary-button class="section-container__basic-button-t3">
                    Crear respuesta
                </x-primary-button>
            </div>
        </form>
    </section>
@endsection

@push('script')
@endpush