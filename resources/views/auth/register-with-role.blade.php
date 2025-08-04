@extends('layouts.guest')

@section('content')
<div class="card shadow p-4">
    <h3 class="text-center mb-4">Inscription</h3>
    <p class="text-center text-muted mb-4">Choisissez votre type de compte</p>

    <form method="POST" action="{{ route('register.with.role') }}">
        @csrf

        <!-- Role Selection -->
        <div class="mb-4">
            <label class="form-label">Type de compte</label>
            <div class="row g-3">
                <div class="col-6">
                    <div class="form-check h-100">
                        <input class="form-check-input" type="radio" name="role" value="client" id="role-client" {{ old('role') == 'client' ? 'checked' : '' }} required>
                        <label class="form-check-label h-100 d-flex flex-column justify-content-center" for="role-client">
                            <div class="text-center">
                                <i class="fas fa-user fa-2x text-primary mb-2"></i>
                                <div class="fw-bold">Client</div>
                                <small class="text-muted">Achetez des produits médicaux</small>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check h-100">
                        <input class="form-check-input" type="radio" name="role" value="seller" id="role-seller" {{ old('role') == 'seller' ? 'checked' : '' }} required>
                        <label class="form-check-label h-100 d-flex flex-column justify-content-center" for="role-seller">
                            <div class="text-center">
                                <i class="fas fa-store fa-2x text-success mb-2"></i>
                                <div class="fw-bold">Vendeur</div>
                                <small class="text-muted">Vendez vos produits médicaux</small>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            @error('role')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Name -->
        <div class="mb-3">
            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Nom complet"
                value="{{ old('name') }}"
                required
                autofocus
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Adresse email"
                value="{{ old('email') }}"
                required
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <input
                type="tel"
                name="phone"
                class="form-control @error('phone') is-invalid @enderror"
                placeholder="Numéro de téléphone"
                value="{{ old('phone') }}"
                required
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
            <textarea
                name="address"
                class="form-control @error('address') is-invalid @enderror"
                placeholder="Adresse"
                rows="3"
                required
            >{{ old('address') }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <input
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Mot de passe"
                required
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <input
                type="password"
                name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="Confirmer le mot de passe"
                required
            >
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <span>Déjà inscrit?</span>
            <a href="{{ route('login') }}" class="text-decoration-none">Se connecter</a>
        </div>
    </form>
</div>
@endsection 