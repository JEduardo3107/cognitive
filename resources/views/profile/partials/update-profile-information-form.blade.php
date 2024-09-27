<section class="section-paper">

    <div class="card-type-generic__title card-type-generic__title--first">
        <p>
            Editar perfil
        </p>
    </div>

    <div class="edit-profile__container">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="edit-profile__form">
            @csrf
            @method('patch')

            <div class="edit-profile__item">
                <x-input-label for="name" :value="__('Nombre de usuario')" />
                <x-text-input id="name" name="name" type="text" class="edit-profile__input" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="edit-profile__item">

                <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" name="email" type="email" class="edit-profile__input" :value="old('email', $user->email)" required autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="edit-profile__item">
                    <p>
                        Tu correo electrónico no ha sido verificado.
                    </p>

                    <button form="send-verification" class="noDefaultStyle buttonEditProfile--res cursorPointerEvent">
                        {{ __('Reenviar verificación') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="edit-profile__success">
                            Se reenvió el correo de verificación.
                        </p>
                    @endif
                </div>
            @endif
            </div>
            <div class="edit-profile__item">
                <x-primary-button class="buttonEditProfile--edit">{{ __('Guardar') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                <script>
                    let mensaje = '{{ session('mensaje') }}';
                    const config = {
                        iconClass: "notification-tab__icon--check",
                        title: "¡Correcto!",
                        body: "<p>Se realizarón los cambios</p>",
                        color: "#2C8A4B",
                        displayTime: 3000
                    };
                    
                    newToastMessage(config);
                </script>
                {{--<p class="edit-profile__success">
                    Se realizaròn los cambios
                </p>--}}
                @endif
            </div>
        </form>
    </div>
</section>