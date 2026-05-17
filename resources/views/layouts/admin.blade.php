<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin - {{ config('app.name', 'Travel Review') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=montserrat:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body { font-family: montserrat, sans-serif; }
        </style>
        <style>
            .admin-toolbar .btn {
                min-width: 110px;
            }
            .table-actions {
                display: flex;
                flex-wrap: nowrap;
                gap: 0.35rem;
                justify-content: center;
            }
            .table-actions .btn {
                min-width: 80px;
                padding: 0.25rem 0.7rem;
                margin: 0;
            }
            .admin-table {
                min-width: 980px;
            }
            .admin-table th,
            .admin-table td {
                white-space: normal;
                text-align: center;
            }
        </style>
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="adminNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.locations.index') }}">Locations</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.comments.index') }}">Comments</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Back to site</a></li>
                    </ul>
                </div>
            </div>
        </nav>

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

                @yield('content')
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
        <script>
            document.querySelectorAll('form[data-auto-submit="true"]').forEach((form) => {
                form.querySelectorAll('select').forEach((field) => {
                    field.addEventListener('change', () => form.submit());
                });
            });
        </script>
    </body>
</html>
