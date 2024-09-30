@extends('layouts.app')

@section('pageTitle')
    {{ $answer->answer_text }}
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
            Detalles
        </span>
        <form action="{{ route('answer.update', ['answer' => $answer->id]) }}" method="post" class="oneColumnFlexbox fullW">
            @method('PUT')
            @csrf
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="answer" :value="__('Nuevo valor')" />
                <x-text-input id="answer" type="text" name="answer" :value="old('answer', $answer->answer_text)" required autofocus />
                <x-input-error :messages="$errors->get('answer')"/>
            </div>

            <div class="form-container__item form-container__item--btn oneColumnFlexbox">
                <x-primary-button class="section-container__basic-button-t3">
                    Actualizar pregunta
                </x-primary-button>
            </div>
        </form>
    </section>

    <section class="section-container">
        {{-- Titulo de la secciòn --}}
        <span class="section-container__title-container">
            Eliminar
        </span>

        @php
            $dangerKey = generateRandomId(5);
        @endphp

        <form class="danger-zone-container" method="post" action="{{ route('answer.destroy', ['answer' => $answer->id]) }}">
            @method('delete')
            @csrf
            <span>
                Una vez que eliminas, no es posible volver atrás. Por favor, confirme esta acción.
            </span>
            <p>Para confirmar, escriba <span>"{{ $dangerKey }}"</span> a continuación</p>
            <input type="text" autocomplete="off" id="input_confirm" data-dangervalue="{{ $dangerKey }}" class="danger-zone-container__confirm-input">
            <button type="submit" class="button-6" id="button_confirm" disabled>
                Eliminar
            </button>
        </form>
    </section>
@endsection

@push('script')
    <script src="{{ asset('js/danger_zone.js') }}">
    </script>
@endpush