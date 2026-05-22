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
            .auth-bg {
                background: url('{{ asset('images/wallpaper.jpg') }}') center/cover no-repeat fixed;
            }
            .auth-card {
                background-color: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(2px);
            }
        </style>
    </head>
    <body>
        <div class="auth-bg min-vh-100 d-flex align-items-center justify-content-center py-5">
            <div class="card shadow-sm auth-card" style="max-width: 480px; width: 100%;">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}" class="text-decoration-none fw-semibold h4 auth-brand">Travel Review</a>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.querySelectorAll('[data-password-toggle]').forEach((button) => {
                const targetId = button.getAttribute('data-password-toggle');
                const input = document.getElementById(targetId);

                if (!input) {
                    return;
                }

                button.addEventListener('click', () => {
                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    button.setAttribute('aria-pressed', isPassword ? 'true' : 'false');

                    const showIcon = button.querySelector('.password-icon-show');
                    const hideIcon = button.querySelector('.password-icon-hide');

                    if (showIcon && hideIcon) {
                        showIcon.classList.toggle('d-none', isPassword);
                        hideIcon.classList.toggle('d-none', !isPassword);
                    }
                });
            });
        </script>
    </body>
</html>
