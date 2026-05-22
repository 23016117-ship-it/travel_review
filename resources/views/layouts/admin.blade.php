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
        <div class="admin-shell">
            <aside class="admin-sidebar">
                <a class="admin-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                <nav class="admin-nav">
                    <a class="admin-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a class="admin-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}" href="{{ route('admin.locations.index') }}">Locations</a>
                    <a class="admin-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}">Reviews</a>
                    <a class="admin-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}" href="{{ route('admin.comments.index') }}">Comments</a>
                    <a class="admin-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
                </nav>
                <div class="admin-sidebar-footer">
                    <a class="admin-link" href="{{ route('home') }}">Back to site</a>
                </div>
            </aside>

            <div class="admin-content">
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
            </div>
        </div>

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
