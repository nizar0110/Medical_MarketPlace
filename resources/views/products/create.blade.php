@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Ajouter un produit
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nom du produit</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Masque chirurgical N95" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Décrivez votre produit en détail..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Catégorie</label>
                            <div class="row g-3">
                                @foreach($categories as $category)
                                    <div class="col-md-6">
                                        <div class="form-check h-100">
                                            <input class="form-check-input" type="radio" name="category_id" value="{{ $category->id }}" id="category-{{ $category->id }}" {{ old('category_id') == $category->id ? 'checked' : '' }} required>
                                            <label class="form-check-label h-100 d-flex flex-column justify-content-center p-3 border rounded" for="category-{{ $category->id }}">
                                                <div class="text-center">
                                                    <i class="fas fa-tag fa-2x text-primary mb-2"></i>
                                                    <div class="fw-bold">{{ $category->name }}</div>
                                                    <small class="text-muted">{{ $category->description ?? 'Produits de cette catégorie' }}</small>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('category_id')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price and Stock -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold">Prix (DH)</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="0.00" required>
                                    <span class="input-group-text">DH</span>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-bold">Stock disponible</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 0) }}" placeholder="0" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Image du produit</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*">
                            <div class="form-text">Formats acceptés: JPEG, PNG, JPG, GIF, SVG (max 2MB)</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Créer le produit
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-check-input:checked + .form-check-label {
    border-color: #0d6efd !important;
    background-color: #f8f9ff !important;
}

.form-check-label {
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-check-label:hover {
    border-color: #0d6efd !important;
    background-color: #f8f9ff !important;
}
</style>
@endsection 