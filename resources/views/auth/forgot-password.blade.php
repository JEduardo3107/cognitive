@extends('layouts.guest')

@section('pageTitle')
    Recuperar contraseña
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <div class="page-container__form-container centerFlexbox">
        <div class="form-container__form oneColumnFlexbox">

            <div class="form-container__item oneColumnFlexbox">
                ¿Contraseña olvidada? Ingrese el correo utilizado en su cuenta para continuar.
            </div>

            {{-- Session Status --}}
            <x-auth-session-status :status="session('status')" />
        
            <form method="POST" action="{{ route('password.email') }}" class="form-container__item--sub-form oneColumnFlexbox">
                @csrf
        
                {{-- Email Address --}}
                <div class="form-container__item oneColumnFlexbox">
                    <x-input-label for="email" :value="__('Correo electrónico')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" />
                </div>
        
                <div class="form-container__item oneColumnFlexbox">
                    <x-primary-button class="section-container__basic-button-t3">
                        Enviar correo
                    </x-primary-button>

                    <a class="form-container__password_r unselectable mt-1" href="{{ route('login') }}">
                        Ingresar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')

@endpush