<section>
    <header class="mb-3">
        <h2 class="h5 mb-1">Profile Information</h2>
        <p class="text-muted mb-0">Update your account profile information and email address.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small mb-1">Your email address is unverified.</p>
                    <button form="send-verification" class="btn btn-outline-secondary btn-sm" type="submit">
                        Re-send verification email
                    </button>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <div class="text-success small mt-2">A new verification link has been sent.</div>
                @endif
            @endif
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input id="avatar" name="avatar" type="file" class="form-control">
            @error('avatar')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            @if ($user->avatar)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded" style="max-height: 80px;">
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-primary" type="submit">Save</button>
            @if (session('status') === 'profile-updated')
                <span class="text-muted small">Saved.</span>
            @endif
        </div>
    </form>
</section>
