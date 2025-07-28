@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- En-tête avec recherche -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2 mb-0">Nos Produits</h1>
                <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="form-control me-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Filtres et tri -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <span class="text-muted">{{ $products->total() }} produits trouvés</span>
                </div>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>Trier par</option>
                        <option>Prix croissant</option>
                        <option>Prix décroissant</option>
                        <option>Nom A-Z</option>
                        <option>Nom Z-A</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille des produits -->
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm hover-shadow">
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
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">
                                    <i class="fas fa-eye me-1"></i>Voir
                                </a>
                                
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fas fa-cart-plus me-1"></i>Panier
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun produit trouvé</h4>
                    <p class="text-muted">Essayez de modifier vos critères de recherche</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Voir tous les produits</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Navigation des produits">
                    {{ $products->links() }}
                </nav>
            </div>
        </div>
    @endif
</div>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    transition: all 0.3s ease;
}

.card {
    transition: all 0.3s ease;
}
</style>
@endsection 