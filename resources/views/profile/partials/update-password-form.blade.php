<section class="section-paper">
    <div class="card-type-generic__title card-type-generic__title--first">
        <p>
            Actualizar contraseña
        </p>
    </div>

    <div class="edit-profile__container">
        <form method="post" action="{{ route('password.update') }}" class="edit-profile__form">
            @csrf
            @method('put')

            <div class="edit-profile__item">
                <x-input-label for="update_password_current_password" :value="__('Contraseña actual')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="edit-profile__input" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" />
            </div>

            <div class="edit-profile__item">
                <x-input-label for="update_password_password" :value="__('Nueva contraseña')" />
                <x-text-input id="update_password_password" name="password" type="password" class="edit-profile__input" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" />
            </div>

            <div class="edit-profile__item">
                <x-input-label for="update_password_password_confirmation" :value="__('Confirmar contraseña')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="edit-profile__input" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>

            <div class="edit-profile__item">
                <x-primary-button class="buttonEditProfile--edit">{{ __('Actualizar') }}</x-primary-button>
                @if (session('status') === 'password-updated')
                    <script>
                        let mensaje = '{{ session('mensaje') }}';
                        const config = {
                            iconClass: "notification-tab__icon--check",
                            title: "¡Correcto!",
                            body: "<p>La contraseña se actualizó correctamente.</p>",
                            color: "#2C8A4B",
                            displayTime: 3000
                        };
                        
                        newToastMessage(config);
                    </script>
                @endif
            </div>

        </form>
    </div>
</section>