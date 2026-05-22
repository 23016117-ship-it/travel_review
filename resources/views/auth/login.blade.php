<x-guest-layout>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                <button class="btn btn-outline-secondary" type="button" data-password-toggle="password" aria-pressed="false" aria-label="Toggle password visibility">
                    <span class="password-icon-show" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8s-3 5.5-8 5.5S0 8 0 8s3-5.5 8-5.5S16 8 16 8zm-8 4a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                            <path d="M8 5.5A2.5 2.5 0 1 1 5.5 8 2.5 2.5 0 0 1 8 5.5z" />
                        </svg>
                    </span>
                    <span class="password-icon-hide d-none" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M13.359 11.238C14.246 10.408 14.971 9.42 15.5 8c-.001 0-3-5.5-7.5-5.5-1.205 0-2.318.238-3.322.645l1.043 1.043A4 4 0 0 1 8 4a4 4 0 0 1 4 4c0 .708-.184 1.37-.507 1.945l1.866 1.866z" />
                            <path d="M10.477 12.478A4 4 0 0 1 8 12a4 4 0 0 1-4-4c0-.81.24-1.563.652-2.193L2.354 3.51C1.41 4.48.688 5.67.5 8c.001 0 3 5.5 7.5 5.5 1.248 0 2.405-.21 3.427-.58l-.95-.942z" />
                            <path d="M1.5 1.5 14.5 14.5" stroke="currentColor" stroke-width="1.2" />
                        </svg>
                    </span>
                </button>
            </div>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>

        <div class="d-flex flex-wrap justify-content-end align-items-center gap-2">
            <div class="d-flex align-items-center gap-2">
                @if (Route::has('register'))
                    <a class="btn btn-outline-secondary" href="{{ route('register') }}">Register</a>
                @endif
                <button class="btn btn-primary" type="submit">Log in</button>
            </div>
        </div>
    </form>
</x-guest-layout>
