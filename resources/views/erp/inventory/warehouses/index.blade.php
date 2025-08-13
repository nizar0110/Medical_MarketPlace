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
                        Gestion des Entrepôts
                    </h2>
                    <p class="text-muted mb-0">Liste des entrepôts et emplacements</p>
                </div>
                <div>
                    <a href="{{ route('erp.inventory.warehouses.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        Nouvel Entrepôt
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Warehouses List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Entrepôts Disponibles
                    </h5>
                </div>
                <div class="card-body">
                    @if($warehouses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Nom</th>
                                        <th>Ville</th>
                                        <th>Pays</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($warehouses as $warehouse)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $warehouse->code }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $warehouse->name }}</div>
                                            @if($warehouse->description)
                                                <small class="text-muted">{{ $warehouse->description }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $warehouse->city }}</td>
                                        <td>{{ $warehouse->country }}</td>
                                        <td>
                                            @if($warehouse->is_active)
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-secondary">Inactif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#warehouseModal{{ $warehouse->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal pour les détails -->
                                    <div class="modal fade" id="warehouseModal{{ $warehouse->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails de l'Entrepôt</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Code:</strong><br>
                                                            {{ $warehouse->code }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Nom:</strong><br>
                                                            {{ $warehouse->name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Adresse:</strong><br>
                                                            {{ $warehouse->address }}<br>
                                                            {{ $warehouse->postal_code }} {{ $warehouse->city }}<br>
                                                            {{ $warehouse->state }} {{ $warehouse->country }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Contact:</strong><br>
                                                            @if($warehouse->phone)
                                                                <i class="fas fa-phone me-1"></i>{{ $warehouse->phone }}<br>
                                                            @endif
                                                            @if($warehouse->email)
                                                                <i class="fas fa-envelope me-1"></i>{{ $warehouse->email }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if($warehouse->description)
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <strong>Description:</strong><br>
                                                            {{ $warehouse->description }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $warehouses->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-warehouse fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun entrepôt configuré</h5>
                            <p class="text-muted">Commencez par créer votre premier entrepôt.</p>
                            <a href="{{ route('erp.inventory.warehouses.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>
                                Créer un Entrepôt
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 