<x-guest-layout>
    <div class="page-container__form-container centerFlexbox">
        <div class="form-container__form oneColumnFlexbox">
            <div class="form-container__item oneColumnFlexbox">
                {{ __('Por favor, confirma tu contraseña antes de continuar') }}
            </div>
            <form method="POST" action="{{ route('password.confirm') }}" class="page-container__form-container">
                @csrf
                {{-- Password --}}
                <div>
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" />
                </div>
                <div class="form-container__item form-container__item--btn oneColumnFlexbox">
                    <x-primary-button class="section-container__basic-button-t3">
                        {{ __('Confirmar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>