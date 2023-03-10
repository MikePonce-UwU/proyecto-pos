<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=questrial" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div id="app" class="min-vh-100">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Route::has('home'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-item" wire:poll.500ms>
                                        {{ __('Current time: ' . now()) }}
                                    </div>
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
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @auth
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                    aria-labelledby="offcanvasExample">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                            {{ config('app.name', 'Laravel') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav flex-column">
                            @if (Route::has('categories.index') &&
                                    auth()->user()->can('category-index'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}"
                                        href="{{ route('categories.index') }}">{{ __('Categorías') }}</a>
                                </li>
                            @endif
                            @if (Route::has('products.index') &&
                                    auth()->user()->can('product-index'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}"
                                        href="{{ route('products.index') }}">{{ __('Productos') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Ventas') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                                    @if (Route::has('pos.index'))
                                        <a class="dropdown-item {{ request()->routeIs('pos.index') ? 'active' : '' }}"
                                            href="{{ route('pos.index') }}">{{ __('Punto de venta') }}</a>
                                    @endif
                                    @if (Route::has('orders.index'))
                                        <a class="dropdown-item {{ request()->routeIs('orders.index') ? 'active' : '' }}"
                                            href="{{ route('orders.index') }}">{{ __('Ventas') }}</a>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Usuarios y roles') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                                    @if (Route::has('roles.index') &&
                                            auth()->user()->can('role-index'))
                                        <a class="dropdown-item {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                            href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                                    @endif
                                    @if (Route::has('permissions.index') &&
                                            auth()->user()->can('permission-index'))
                                        <a class="dropdown-item {{ request()->routeIs('permissions.index') ? 'active' : '' }}"
                                            href="{{ route('permissions.index') }}">{{ __('Permisos') }}</a>
                                    @endif
                                    @if (Route::has('permission_assign.index') &&
                                            auth()->user()->can('role-index'))
                                        <a class="dropdown-item {{ request()->routeIs('permission_assign.index') ? 'active' : '' }}"
                                            href="{{ route('permission_assign.index') }}">{{ __('Asignar permisos') }}</a>
                                    @endif
                                    @if (Route::has('users.index') &&
                                            auth()->user()->can('user-index'))
                                        <a class="dropdown-item {{ request()->routeIs('users.index') ? 'active' : '' }}"
                                            href="{{ route('users.index') }}">{{ __('Usuarios') }}</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.js"></script>
    <script>
        function notify(msg, type = "info") {
            switch (type) {
                case 'success':
                    toastr.success(msg);
                    break;
                case 'info':
                    toastr.info(msg);
                    break;
                case 'warning':
                    toastr.warning(msg);
                    break;
                case 'danger':
                    toastr.error(msg);
                    break;
                default:
                    break;
            }
        }
        document.addEventListener('notify', function() {
            window.livewire.on('notify', msg => {
                notify(msg);
            });
        })
    </script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
