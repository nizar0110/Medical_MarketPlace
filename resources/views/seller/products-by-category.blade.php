@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1">Mes Produits</h1>
                    <p class="text-muted mb-0">Catégorie: <span class="badge bg-primary">{{ $category->name }}</span></p>
                </div>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Ajouter un produit
                </a>
            </div>
        </div>
    </div>

    <!-- Category Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Filtrer par catégorie</h5>
                    <div class="row g-2">
                        @foreach(\App\Models\Category::all() as $cat)
                            <div class="col-md-3 col-sm-6">
                                <a href="{{ route('seller.products.by-category', $cat->id) }}" 
                                   class="btn btn-outline-{{ $cat->id == $category->id ? 'primary' : 'secondary' }} w-100">
                                    <i class="fas fa-tag me-1"></i>{{ $cat->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 text-primary mb-0">{{ number_format($product->price, 2) }} DH</span>
                                <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                    {{ $product->stock > 0 ? 'En stock' : 'Rupture' }}
                                </span>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i>Voir
                                </a>
                                
                                <div class="btn-group" role="group">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun produit dans cette catégorie</h4>
                    <p class="text-muted">Commencez par ajouter un produit à cette catégorie</p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Ajouter un produit
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Back to Dashboard -->
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('seller.dashboard') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour au tableau de bord
            </a>
        </div>
    </div>
</div>

<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endsection 