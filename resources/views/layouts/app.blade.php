<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Travel Review') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=montserrat:400,600|pacifico:400&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body { font-family: montserrat, sans-serif; }
        </style>

    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-xl travel-navbar sticky-top">
            <div class="container travel-nav-shell">
                <a class="navbar-brand travel-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                    <img src="{{ asset('images/phenikaa-university.png') }}" alt="Phenikaa University" class="phenikaa-logo">
                    <span class="travel-brand-text">Travel Review</span>
                </a>

                <button class="navbar-toggler travel-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav travel-menu me-auto align-items-xl-center mt-1 mt-xl-0">
                        <li class="nav-item">
                            <a class="nav-link travel-link {{ request()->routeIs('locations.*') ? 'active' : '' }}" href="{{ route('locations.index') }}">Locations</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link travel-link {{ request()->routeIs('favorites.*') ? 'active' : '' }}" href="{{ route('favorites.index') }}">Favorites</a>
                            </li>
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link travel-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Admin</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-xl-auto align-items-xl-center gap-xl-2 travel-right-nav">
                        @guest
                            <li class="nav-item mt-2 mt-xl-0"><a class="btn btn-outline-secondary" href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="nav-item dropdown mt-2 mt-xl-0">
                                <a class="nav-link dropdown-toggle travel-user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end travel-dropdown shadow-sm border-0">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @isset($header)
            <header class="bg-white border-bottom">
                <div class="container py-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="py-4">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.querySelectorAll('form[data-auto-submit="true"]').forEach((form) => {
                form.querySelectorAll('select').forEach((field) => {
                    field.addEventListener('change', () => form.submit());
                });
            });
        </script>
    </body>
</html>
