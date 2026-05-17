<x-guest-layout>
    <p class="text-muted mb-4">
        Forgot your password? Enter your email and we will send you a reset link.
    </p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Email Password Reset Link</button>
    </form>
</x-guest-layout>
