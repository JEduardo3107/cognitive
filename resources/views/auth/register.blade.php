@extends('layouts.guest')

@section('pageTitle')
    Registrarse
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <form method="POST" action="{{ route('register') }}" class="page-container__form-container centerFlexbox">
        <div class="form-container__form oneColumnFlexbox">
            @csrf

            <div class="form-container__form-title unselectable">
                Registrarse
            </div>

            {{-- Name --}}
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            {{-- Email Address --}}
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="email" :value="__('Correo electrónico')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            {{-- Password --}}
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="password" :value="__('Contraseña')" />

                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" />
            </div>

            {{-- Confirm Password --}}
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="password_confirmation" :value="__('Repetir contraseña')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')"/>
            </div>

            <div class="form-container__item form-container__item--btn oneColumnFlexbox">
                <x-primary-button class="section-container__basic-button-t3">
                    Registrarme
                </x-primary-button>
                <a class="form-container__password_r unselectable" href="{{ route('login') }}">
                    Ya tengo cuenta
                </a>
            </div>
        </div>
    </form>
@endsection

@push('script')

@endpush