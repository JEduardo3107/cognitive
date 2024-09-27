<div class="menu unselectable">
    <span class="menu__logo-text">
        Test
    </span>
    
    <div class="menu__activador" id="menu__activador">
        <p>{{ Auth::user()->name }}</p>
        <span class="menu__activador--icono">
        </span>
        <div class="menu__items" id="menu__items">
            <a href="{{ route('home.index') }}" class="noDefaultStyle">
                <div class="menu__item">
                    <p>
                        Inicio
                    </p>
                </div>
            </a>
            <a href="{{ route('profile.edit') }}" class="noDefaultStyle">
                <div class="menu__item">
                    <p>
                        Perfil
                    </p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="menu__item">
                @csrf
                <input type="submit" value="Cerrar sesión" class="menu__item--btn">
            </form>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endpush

@push('script')
    <script src="{{ asset('js/menu.js') }}">
    </script>
@endpush