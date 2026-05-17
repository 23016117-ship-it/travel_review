<x-guest-layout>
    <p class="text-muted mb-4">This is a secure area of the application. Please confirm your password.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Confirm</button>
    </form>
</x-guest-layout>
