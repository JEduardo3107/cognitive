@extends('layouts.guest')

@section('pageTitle')
    Ingresar
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    {{-- Session Status --}}
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="page-container__form-container">
        
        <div class="form-container__form oneColumnFlexbox">
            @csrf

            <div class="form-container__form-title unselectable">
                Ingresar
            </div>
            {{--<img src="{{ asset('img/icon/logo-laravel.png') }}" class="form-container__icon-img-logo">--}}

            {{-- Email Address --}}
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="email" :value="__('Correo electrónico')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')"/>
            </div>

            {{-- Password --}}
            <div class="form-container__item oneColumnFlexbox">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')"/>
            </div>

            <div class="form-container__item form-container__item--btn oneColumnFlexbox">
                <x-primary-button class="section-container__basic-button-t3">
                    Iniciar sesión
                </x-primary-button>
                <a href="{{ route('register') }}" class="section-container__basic-button-t4">
                    Crear cuenta
                </a>
                    
                {{--@if(Route::has('password.request'))
                    <a class="form-container__password_r unselectable" href="{{ route('password.request') }}">
                        Olvidé mi contraseña
                    </a>
                @endif--}}
            </div>
        </div>
    </form>
@endsection

@push('script')

@endpush