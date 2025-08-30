@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-shopping-cart me-2"></i>
                        Achats
                    </h2>
                    <p class="text-muted mb-0">Tableau de bord achats - {{ now()->format('d/m/Y H:i') }}</p>
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
                            <h6 class="text-muted mb-1">Fournisseurs</h6>
                            <h3 class="mb-0 text-primary">{{ $stats['suppliers_count'] }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-truck text-primary fa-2x"></i>
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
                            <h6 class="text-muted mb-1">Commandes en Cours</h6>
                            <h3 class="mb-0 text-warning">{{ $stats['pending_orders'] }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="fas fa-clock text-warning fa-2x"></i>
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
                            <h6 class="text-muted mb-1">Commandes du Mois</h6>
                            <h3 class="mb-0 text-success">{{ $stats['monthly_orders'] }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-calendar-check text-success fa-2x"></i>
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
                            <h6 class="text-muted mb-1">Montant Total</h6>
                            <h3 class="mb-0 text-info">{{ $stats['total_amount'] }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-money-bill text-info fa-2x"></i>
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
                        <i class="fas fa-shopping-cart me-2"></i>
                        Commandes Récentes
                    </h5>
                </div>
                <div class="card-body">
                    @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Référence</th>
                                        <th>Fournisseur</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                        <td>{{ $order->reference ?: '-' }}</td>
                                        <td>{{ $order->supplier_name ?: 'N/A' }}</td>
                                        <td>{{ $order->total_amount ?: '0.00' }} DH</td>
                                        <td>
                                            @if($order->status === 'pending')
                                                <span class="badge bg-warning">En cours</span>
                                            @elseif($order->status === 'completed')
                                                <span class="badge bg-success">Terminée</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucune commande récente</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-truck me-2"></i>
                        Fournisseurs Récents
                    </h5>
                </div>
                <div class="card-body">
                    @if($recentSuppliers->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentSuppliers as $supplier)
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $supplier->company_name }}</h6>
                                        <small class="text-muted">{{ $supplier->city ?: '' }}</small>
                                    </div>
                                    <span class="badge bg-success">Actif</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-truck fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucun fournisseur configuré</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 