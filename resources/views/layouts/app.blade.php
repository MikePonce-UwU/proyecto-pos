<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="description" content="App facturacion hecha para tiendas pequeñas y medianas.">
    <meta name="keywords" content="sistema de facturacion, facturacion, billing system, products, management">
    <meta name="author" content="Mike Ponce" />
    <meta name="copyright" content="Mike Ponce" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=questrial" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
        <div class="container-fluid bg-primary fixed-bottom">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-2 my-2 border-top px-4">
                <div class="col-md-4 d-flex align-items-center">
                    <span>&copy;MikePonce {{ now()->year }} Todos los derechos reservados.</span>
                </div>
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3">
                        <a href="https://www.facebook.com/cool.nicaraguan/" class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                        </a>
                    </li>
                    <li class="ms-3">
                        <a href="https://wa.me/50586759514" class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
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
