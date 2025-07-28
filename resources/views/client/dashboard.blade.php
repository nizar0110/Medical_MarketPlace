@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Bienvenue -->
    <div class="card bg-primary text-white mb-4 shadow">
        <div class="card-body d-flex align-items-center">
            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center me-4" style="width: 56px; height: 56px;">
                <span class="fs-3 fw-bold text-primary">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div>
                <h2 class="h4 mb-1">Bonjour, {{ Auth::user()->name }} !</h2>
                <p class="mb-0">Bienvenue sur votre tableau de bord personnel</p>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-shopping-bag fa-2x text-primary mb-2"></i>
                    <h6 class="text-muted">Commandes</h6>
                    <div class="h4 mb-0">{{ $ordersCount ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-truck fa-2x text-success mb-2"></i>
                    <h6 class="text-muted">Livrées</h6>
                    <div class="h4 mb-0">{{ $deliveredCount ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-heart fa-2x text-warning mb-2"></i>
                    <h6 class="text-muted">Favoris</h6>
                    <div class="h4 mb-0">{{ $favoritesCount ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-wallet fa-2x text-purple mb-2"></i>
                    <h6 class="text-muted">Total dépensé</h6>
                    <div class="h4 mb-0">{{ number_format($totalSpent ?? 0, 2) }} DH</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Commandes récentes -->
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0">Mes commandes récentes</h5>
                    <a href="#" class="text-primary small">Voir tout</a>
                </div>
                <div class="card-body">
                    @forelse($recentOrders ?? [] as $order)
                        <div class="d-flex justify-content-between align-items-center border rounded p-3 mb-3">
                            <div>
                                <div class="fw-semibold">Commande #{{ $order->id }}</div>
                                <div class="text-muted small">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                                <div class="text-muted small">{{ number_format($order->total, 2) }} DH</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'processing' ? 'primary' : ($order->status === 'shipped' ? 'success' : 'secondary')) }} text-uppercase">{{ ucfirst($order->status) }}</span>
                                <a href="#" class="text-primary"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-bag fa-2x text-muted mb-2"></i>
                            <p class="text-muted">Aucune commande encore</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Découvrir nos produits</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Produits favoris -->
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0">Mes favoris</h5>
                    <a href="#" class="text-primary small">Voir tout</a>
                </div>
                <div class="card-body">
                    @forelse($favorites ?? [] as $product)
                        <div class="d-flex align-items-center border rounded p-3 mb-3">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                <div class="rounded bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <span class="text-muted small">No img</span>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <div class="text-muted small">{{ number_format($product->price, 2) }} DH</div>
                            </div>
                            <div class="d-flex align-items-center gap-2 ms-2">
                                <a href="{{ route('products.show', $product) }}" class="text-primary"><i class="fas fa-eye"></i></a>
                                <button class="btn btn-link text-danger p-0"><i class="fas fa-heart"></i></button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-heart fa-2x text-muted mb-2"></i>
                            <p class="text-muted">Aucun favori encore</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Découvrir des produits</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">Actions rapides</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('products.index') }}" class="d-flex align-items-center border rounded p-3 h-100 text-decoration-none text-dark hover-shadow">
                        <i class="fas fa-search fa-lg text-primary me-3"></i>
                        <div>
                            <div class="fw-semibold">Rechercher des produits</div>
                            <div class="text-muted small">Trouver ce dont vous avez besoin</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="d-flex align-items-center border rounded p-3 h-100 text-decoration-none text-dark hover-shadow">
                        <i class="fas fa-shopping-bag fa-lg text-success me-3"></i>
                        <div>
                            <div class="fw-semibold">Voir mes commandes</div>
                            <div class="text-muted small">Suivre vos achats</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('profile.edit') }}" class="d-flex align-items-center border rounded p-3 h-100 text-decoration-none text-dark hover-shadow">
                        <i class="fas fa-user fa-lg text-purple me-3"></i>
                        <div>
                            <div class="fw-semibold">Mon profil</div>
                            <div class="text-muted small">Gérer vos informations</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 10px 25px rgba(0,0,0,0.10) !important;
    transition: all 0.3s ease;
}
.text-purple { color: #6f42c1; }
</style>
@endsection 