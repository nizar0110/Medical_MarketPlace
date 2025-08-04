<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserWithRoleController extends Controller
{
    /**
     * Display the registration view with role selection.
     */
    public function create(): View
    {
        return view('auth.register-with-role');
    }

    /**
     * Handle an incoming registration request with role.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'role' => ['required', 'string', 'in:client,seller'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            // Debug: Log the user creation
            \Log::info('User registered successfully', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'user_role' => $user->role
            ]);

            event(new Registered($user));

            Auth::login($user);

            // Rediriger selon le rôle
            if ($request->role === 'seller') {
                return redirect()->route('seller.dashboard');
            } else {
                return redirect()->route('client.dashboard');
            }
        } catch (\Exception $e) {
            \Log::error('Registration failed', [
                'email' => $request->email,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
} 