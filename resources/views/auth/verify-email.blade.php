<x-guest-layout>
    <p class="text-muted mb-4">
        Thanks for signing up! Please verify your email address by clicking the link we emailed you.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn btn-primary" type="submit">Resend Verification Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-secondary" type="submit">Log Out</button>
        </form>
    </div>
</x-guest-layout>
