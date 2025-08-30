@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="{{ $stats['icon'] }} me-2"></i>
                        {{ $stats['title'] }}
                    </h2>
                    <p class="text-muted mb-0">Tableau de bord ERP - {{ now()->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        Nouvelle Action
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        @foreach($stats['stats'] as $stat)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">{{ $stat['label'] }}</h6>
                            <h3 class="mb-0 text-{{ $stat['color'] }}">{{ $stat['value'] }}</h3>
                        </div>
                        <div class="bg-{{ $stat['color'] }} bg-opacity-10 p-3 rounded">
                            <i class="fas fa-chart-{{ $stat['color'] }} text-{{ $stat['color'] }} fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Actions Rapides
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(auth()->user()->role === 'warehouse_manager' || auth()->user()->role === 'admin')
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('erp.inventory.movements.create') }}" class="btn btn-outline-primary w-100 p-3">
                                <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                <br>
                                Nouveau Mouvement
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('erp.inventory.dashboard') }}" class="btn btn-outline-success w-100 p-3">
                                <i class="fas fa-warehouse fa-2x mb-2"></i>
                                <br>
                                Gestion Stocks
                            </a>
                        </div>
                        @endif



                        @if(auth()->user()->role === 'buyer' || auth()->user()->role === 'admin')
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-secondary w-100 p-3">
                                <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                                <br>
                                Nouvelle Commande
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-dark w-100 p-3">
                                <i class="fas fa-truck fa-2x mb-2"></i>
                                <br>
                                Gérer Fournisseurs
                            </a>
                        </div>
                        @endif

                        @if(auth()->user()->role === 'sales_manager' || auth()->user()->role === 'admin')
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-success w-100 p-3">
                                <i class="fas fa-file-invoice fa-2x mb-2"></i>
                                <br>
                                Nouveau Devis
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-primary w-100 p-3">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <br>
                                Gérer Clients
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>
                        Activité Récente
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Système ERP Initialisé</h6>
                                <p class="text-muted mb-0">Le système ERP a été configuré avec succès</p>
                                <small class="text-muted">{{ now()->subMinutes(5)->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Base de données créée</h6>
                                <p class="text-muted mb-0">Toutes les tables ERP ont été créées</p>
                                <small class="text-muted">{{ now()->subMinutes(10)->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Données initiales chargées</h6>
                                <p class="text-muted mb-0">Les données de base ont été importées</p>
                                <small class="text-muted">{{ now()->subMinutes(15)->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-bell me-2"></i>
                        Notifications
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Bienvenue dans l'ERP!</strong>
                        <br>
                        <small>Votre tableau de bord est maintenant opérationnel.</small>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Configuration requise</strong>
                        <br>
                        <small>Complétez la configuration de votre module.</small>
                    </div>
                    
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Système opérationnel</strong>
                        <br>
                        <small>Tous les modules sont prêts à l'emploi.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 0 0 2px #e9ecef;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #007bff;
}
</style>
@endsection 