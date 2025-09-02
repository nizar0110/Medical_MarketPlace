@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 fw-bold mb-2">Tableau de bord Administration</h1>
            <p class="text-muted">Gérez votre plateforme et suivez les performances</p>
        </div>
    </div>

    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Sélecteur de période et actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <label for="period-selector" class="form-label mb-0 fw-bold">Période :</label>
                            <select id="period-selector" class="form-select" style="width: auto;">
                    <option value="day">Aujourd'hui</option>
                    <option value="week">Cette semaine</option>
                    <option value="month" selected>Ce mois</option>
                    <option value="year">Cette année</option>
                </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button onclick="window.location.href='{{ route('admin.dashboard') }}'" class="btn btn-primary">
                                <i class="fas fa-sync-alt me-1"></i> Actualiser
                    </button>
                            <button onclick="exportData()" class="btn btn-success">
                                <i class="fas fa-download me-1"></i> Exporter
                    </button>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>

            <!-- Statistiques générales -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Utilisateurs</h6>
                            <h3 class="mb-0">{{ $usersCount ?? 0 }}</h3>
                            <small class="opacity-75">Total des utilisateurs</small>
                        </div>
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-white text-decoration-none small">
                            Voir les détails <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                            </div>
                        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Produits</h6>
                            <h3 class="mb-0">{{ $productsCount ?? 0 }}</h3>
                            <small class="opacity-75">Catalogue total</small>
                        </div>
                        <i class="fas fa-box fa-2x opacity-75"></i>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('products.index') }}" class="text-white text-decoration-none small">
                            Gérer les produits <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                            </div>
                        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Commandes</h6>
                            <h3 class="mb-0">{{ $ordersCount ?? 0 }}</h3>
                            <small class="opacity-75">Total des commandes</small>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x opacity-75"></i>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-white text-decoration-none small">
                            Voir les commandes <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                            </div>
                        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Revenus</h6>
                            <h3 class="mb-0">{{ number_format($revenue ?? 0, 2) }} DH</h3>
                            <small class="opacity-75">Chiffre d'affaires total</small>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-white text-decoration-none small">
                            Voir les détails <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-primary h-100">
                <div class="card-body text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-plus fa-2x text-primary"></i>
                    </div>
                    <h5 class="card-title">Ajouter un produit</h5>
                    <p class="card-text text-muted">Créer un nouveau produit</p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Ajouter
                    </a>
                                </div>
                                </div>
                            </div>

        <div class="col-md-4">
            <div class="card border-success h-100">
                <div class="card-body text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-box fa-2x text-success"></i>
                    </div>
                    <h5 class="card-title">Gérer les produits</h5>
                    <p class="card-text text-muted">Voir tous vos produits</p>
                    <a href="{{ route('products.index') }}" class="btn btn-success">
                        <i class="fas fa-list me-1"></i>Gérer
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-info h-100">
                <div class="card-body text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-chart-bar fa-2x text-info"></i>
                    </div>
                    <h5 class="card-title">Voir les statistiques</h5>
                    <p class="card-text text-muted">Analyser vos ventes</p>
                    <a href="#" class="btn btn-info">
                        <i class="fas fa-chart-bar me-1"></i>Statistiques
                    </a>
                </div>
                                </div>
                                </div>
                            </div>

    <div class="row g-4">
        <!-- Utilisateurs récents -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-users me-2 text-primary"></i>Utilisateurs récents
                    </h5>
                    <a href="#" class="btn btn-outline-primary btn-sm">Voir tout</a>
                </div>
                <div class="card-body">
                    @forelse($recentUsers ?? [] as $user)
                        <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <span class="text-primary fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
                                    <p class="text-muted mb-1 small">{{ $user->email }}</p>
                                    <small class="text-muted">Inscrit le {{ $user->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-{{ 
                                    $user->role === 'admin' ? 'danger' : 
                                    ($user->role === 'seller' ? 'primary' : 'success') 
                                }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                                
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Modifier</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>Voir</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Supprimer</a></li>
                                    </ul>
                                </div>
                                    </div>
                                </div>
                            @empty
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Aucun utilisateur</h6>
                            <p class="text-muted small">Commencez par créer un nouvel utilisateur.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Commandes récentes -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-shopping-cart me-2 text-warning"></i>Commandes récentes
                    </h5>
                    <a href="#" class="btn btn-outline-warning btn-sm">Voir tout</a>
                        </div>
                <div class="card-body">
                            @forelse($recentOrders ?? [] as $order)
                        <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                                    <div>
                                <h6 class="fw-bold mb-1">Commande #{{ $order->id }}</h6>
                                <p class="text-muted mb-1 small">{{ $order->user->name ?? 'Utilisateur supprimé' }}</p>
                                <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                                <p class="fw-bold text-primary mb-0">{{ number_format($order->total, 2) }} DH</p>
                                    </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-{{ 
                                    $order->status === 'pending' ? 'warning' : 
                                    ($order->status === 'processing' ? 'info' : 
                                    ($order->status === 'shipped' ? 'success' : 'secondary')) 
                                }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>Voir détails</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Modifier statut</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Supprimer</a></li>
                                    </ul>
                                </div>
                            </div>
                                </div>
                            @empty
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Aucune commande</h6>
                            <p class="text-muted small">Les commandes apparaîtront ici.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

    <!-- Statistiques du mois -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-chart-line me-2 text-info"></i>Statistiques du mois
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-info bg-opacity-10 rounded-lg">
                                <div class="h2 fw-bold text-info mb-2">{{ $monthlyOrders ?? 0 }}</div>
                                <div class="text-muted">Commandes ce mois</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-success bg-opacity-10 rounded-lg">
                                <div class="h2 fw-bold text-success mb-2">{{ number_format($monthlyRevenue ?? 0, 2) }} DH</div>
                                <div class="text-muted">Revenus ce mois</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-warning bg-opacity-10 rounded-lg">
                                <div class="h2 fw-bold text-warning mb-2">{{ $monthlyUsers ?? 0 }}</div>
                                <div class="text-muted">Nouveaux utilisateurs</div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function exportData() {
            // Implement export functionality
            alert('Fonctionnalité d\'export en cours de développement');
        }
    </script>

<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.border-bottom:last-child {
    border-bottom: none !important;
}

.dropdown-toggle::after {
    display: none;
}
</style>

@endsection