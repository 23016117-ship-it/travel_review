<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Travel Review') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=montserrat:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body { font-family: montserrat, sans-serif; }
        </style>
    </head>
    <body class="bg-light">
        <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
            <div class="card shadow-sm" style="max-width: 480px; width: 100%;">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}" class="text-decoration-none fw-semibold h4">Travel Review</a>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
