<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->string('role')->toString();

        $users = User::query()
            ->when($role !== '', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'role'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in(['admin', 'user'])],
            'password' => ['required', 'confirmed', Password::defaults()],
            'is_active' => ['nullable', 'boolean'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => $data['password'],
            'is_active' => (bool) ($data['is_active'] ?? true),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin', 'user'])],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($user->id === auth()->id() && ! ($data['is_active'] ?? false)) {
            return back()->withErrors(['status' => 'You cannot deactivate your own account.'])->withInput();
        }

        if ($user->id === auth()->id() && ($data['role'] ?? 'user') !== 'admin') {
            return back()->withErrors(['status' => 'You cannot remove your own admin role.'])->withInput();
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function updatePassword(Request $request, User $user)
    {
        $data = $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('success', 'Password updated.');
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['status' => 'You cannot lock your own account.']);
        }

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'User status updated.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['status' => 'You cannot delete your own account.']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
