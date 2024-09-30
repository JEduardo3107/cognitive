@extends('layouts.app')

@section('pageTitle')
    Pregunta de {{ $area->area_name }}
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
            {{ $area->area_name }}
        </span>
        <form action="{{ route('questions.store', ['area' => $area->id]) }}" method="post" class="oneColumnFlexbox fullW">
            @csrf
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="question" :value="__('Pregunta')" />
                <x-text-input id="question" type="text" name="question" :value="old('question')" required autofocus />
                <x-input-error :messages="$errors->get('question')"/>
            </div>

            <div class="form-container__item form-container__item--btn oneColumnFlexbox">
                <x-primary-button class="section-container__basic-button-t3">
                    Crear pregunta
                </x-primary-button>
            </div>
        </form>
    </section>
@endsection

@push('script')
@endpush