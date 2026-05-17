<section>
    <header class="mb-3">
        <h2 class="h5 mb-1">Update Password</h2>
        <p class="text-muted mb-0">Ensure your account is using a long, random password.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @if ($errors->updatePassword->get('current_password'))
                <div class="text-danger small">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">New Password</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            @if ($errors->updatePassword->get('password'))
                <div class="text-danger small">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @if ($errors->updatePassword->get('password_confirmation'))
                <div class="text-danger small">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-primary" type="submit">Save</button>
            @if (session('status') === 'password-updated')
                <span class="text-muted small">Saved.</span>
            @endif
        </div>
    </form>
</section>
