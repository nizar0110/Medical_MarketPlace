@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-warehouse me-2"></i>
                        Gestion des Stocks
                    </h2>
                    <p class="text-muted mb-0">Tableau de bord inventaire - {{ now()->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <a href="{{ route('erp.inventory.movements.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        Nouveau Mouvement
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Entrepôts</h6>
                            <h3 class="mb-0 text-primary">{{ $stats['warehouses_count'] }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-warehouse text-primary fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Emplacements</h6>
                            <h3 class="mb-0 text-success">{{ $stats['locations_count'] }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-map-marker-alt text-success fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Mouvements Aujourd'hui</h6>
                            <h3 class="mb-0 text-info">{{ $stats['stock_movements_today'] }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-exchange-alt text-info fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Alertes Stock</h6>
                            <h3 class="mb-0 text-warning">{{ $stats['low_stock_items'] }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="fas fa-exclamation-triangle text-warning fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('erp.inventory.movements.create') }}" class="btn btn-outline-primary w-100 p-3">
                                <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                <br>
                                Nouveau Mouvement
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('erp.inventory.warehouses.create') }}" class="btn btn-outline-success w-100 p-3">
                                <i class="fas fa-warehouse fa-2x mb-2"></i>
                                <br>
                                Nouvel Entrepôt
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('erp.inventory.warehouses.index') }}" class="btn btn-outline-info w-100 p-3">
                                <i class="fas fa-list fa-2x mb-2"></i>
                                <br>
                                Gérer Entrepôts
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('erp.inventory.movements.index') }}" class="btn btn-outline-secondary w-100 p-3">
                                <i class="fas fa-history fa-2x mb-2"></i>
                                <br>
                                Historique
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>
                        Mouvements Récents
                    </h5>
                </div>
                <div class="card-body">
                    @if($recentMovements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Type</th>
                                        <th>Quantité</th>
                                        <th>Entrepôt</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentMovements as $movement)
                                    <tr>
                                        <td>{{ $movement->product_name }}</td>
                                        <td>
                                            @switch($movement->movement_type)
                                                @case('in')
                                                    <span class="badge bg-success">Entrée</span>
                                                    @break
                                                @case('out')
                                                    <span class="badge bg-danger">Sortie</span>
                                                    @break
                                                @case('transfer')
                                                    <span class="badge bg-info">Transfert</span>
                                                    @break
                                                @case('adjustment')
                                                    <span class="badge bg-warning">Ajustement</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ $movement->quantity }}</td>
                                        <td>{{ $movement->warehouse_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($movement->created_at)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucun mouvement récent</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-warehouse me-2"></i>
                        Entrepôts
                    </h5>
                </div>
                <div class="card-body">
                    @if($warehouses->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($warehouses as $warehouse)
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $warehouse->name }}</h6>
                                        <small class="text-muted">{{ $warehouse->city }}, {{ $warehouse->country }}</small>
                                    </div>
                                    <span class="badge bg-success">Actif</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-warehouse fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucun entrepôt configuré</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 