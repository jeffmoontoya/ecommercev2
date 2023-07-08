<nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background: #FFF159">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <!-- Elementos de navegación adicionales -->
            <ul class="navbar-nav">

            </ul>

            <!-- Elementos del lado derecho de la barra de navegación -->
            <ul class="navbar-nav">

                <!-- Botón "Categorías" -->
                {{-- <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorías
                    </a> --}}
                {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categoriesNav as $category)
                            <a class="dropdown-item" href="{{ url('/category/' . $category->id) }}">
                                {{ $category->name }}
                            </a>
                        @endforeach --}}
                </li>

                <!-- Elemento del carrito de compras -->
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('cart.show') }}">
                        <img src="{{ asset('icons/shopping.png') }}" alt="Carrito">
                        <p class="d-inline">Carrito</p>
                    </a>

                </li>
                <!-- Elementos de inicio de sesión y autenticación -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- BOTON ADMINISTRAR --}}
                            @role('admin')
                                <a class="dropdown-item" href="{{ route('admin.users') }}">
                                    {{ __('Administrar') }}
                                @endrole

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </div>
                    </li>
                @endguest

                <!-- Elemento de registro -->
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('registro') }}">{{ __('Registro') }}</a>
                </li>
            </ul>
        </div>
    </div>

</nav>
