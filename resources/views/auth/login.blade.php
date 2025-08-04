@extends('layouts.guest')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Sign In</h3>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>

            <!-- Submit -->
            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>

            <!-- Forgot Password -->
            <div class="text-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                @endif
            </div>

            <!-- Register -->
            <div class="text-center mt-3">
                <span>Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
