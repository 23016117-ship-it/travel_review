<section>
    <header class="mb-3">
        <h2 class="h5 text-danger mb-1">Delete Account</h2>
        <p class="text-muted mb-0">
            Once your account is deleted, all data will be permanently removed. Please enter your password to confirm.
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Delete your account permanently?')">
        @csrf
        @method('delete')

        <div class="mb-3">
            <label for="delete_password" class="form-label">Password</label>
            <input id="delete_password" name="password" type="password" class="form-control" placeholder="Password">
            @if ($errors->userDeletion->get('password'))
                <div class="text-danger small">{{ $errors->userDeletion->first('password') }}</div>
            @endif
        </div>

        <button class="btn btn-danger" type="submit">Delete Account</button>
    </form>
</section>
