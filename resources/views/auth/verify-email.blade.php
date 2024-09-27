<x-guest-layout>
    <div class="page-container__form-container centerFlexbox">
        <div class="form-container__form oneColumnFlexbox">

            <div class="form-container__item">
                {{ __('Hemos enviado un correo para verificar tu cuenta. Por favor, revisa tu bandeja de entrada.') }}
            </div>
        
            @if (session('status') == 'verification-link-sent')
                <div class="form-container__item form-container__status">
                    {{ __('¡Correcto! Revisa tu bandeja de entrada') }}
                </div>
            @endif
            
            <div class="form-container__item form-container__item--btn">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="section-container__basic-button-t3">
                        {{ __('Reenviar correo') }}
                    </x-primary-button>
                </form>
        
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
        
                    <button type="submit" class="form-container__input-btn form-container__input-btn--logout cursorPointerEvent unselectable noDefaultStyle">
                        {{ __('Salir') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>