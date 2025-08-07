@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-exchange-alt me-2"></i>
                        Mouvements de Stock
                    </h2>
                    <p class="text-muted mb-0">Historique des mouvements de stock</p>
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

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label for="movement_type" class="form-label">Type de Mouvement</label>
                            <select class="form-select" id="movement_type" name="movement_type">
                                <option value="">Tous les types</option>
                                <option value="in" {{ request('movement_type') == 'in' ? 'selected' : '' }}>Entrée</option>
                                <option value="out" {{ request('movement_type') == 'out' ? 'selected' : '' }}>Sortie</option>
                                <option value="transfer" {{ request('movement_type') == 'transfer' ? 'selected' : '' }}>Transfert</option>
                                <option value="adjustment" {{ request('movement_type') == 'adjustment' ? 'selected' : '' }}>Ajustement</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="date_from" class="form-label">Date de début</label>
                            <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="date_to" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search me-1"></i>
                                Filtrer
                            </button>
                            <a href="{{ route('erp.inventory.movements.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>
                                Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Movements List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Liste des Mouvements
                    </h5>
                </div>
                <div class="card-body">
                    @if($movements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Produit</th>
                                        <th>Type</th>
                                        <th>Quantité</th>
                                        <th>Entrepôt</th>
                                        <th>Coût Unitaire</th>
                                        <th>Référence</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($movements as $movement)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ \Carbon\Carbon::parse($movement->created_at)->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($movement->created_at)->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $movement->product_name }}</div>
                                        </td>
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
                                        <td>
                                            <span class="fw-bold">{{ number_format($movement->quantity) }}</span>
                                        </td>
                                        <td>{{ $movement->warehouse_name }}</td>
                                        <td>
                                            @if($movement->unit_cost)
                                                {{ number_format($movement->unit_cost, 2) }} €
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($movement->reference)
                                                <span class="badge bg-light text-dark">{{ $movement->reference }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#movementModal{{ $movement->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal pour les détails -->
                                    <div class="modal fade" id="movementModal{{ $movement->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails du Mouvement</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <strong>Produit:</strong><br>
                                                            {{ $movement->product_name }}
                                                        </div>
                                                        <div class="col-6">
                                                            <strong>Type:</strong><br>
                                                            @switch($movement->movement_type)
                                                                @case('in') Entrée @break
                                                                @case('out') Sortie @break
                                                                @case('transfer') Transfert @break
                                                                @case('adjustment') Ajustement @break
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <strong>Quantité:</strong><br>
                                                            {{ number_format($movement->quantity) }}
                                                        </div>
                                                        <div class="col-6">
                                                            <strong>Entrepôt:</strong><br>
                                                            {{ $movement->warehouse_name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <strong>Coût Unitaire:</strong><br>
                                                            @if($movement->unit_cost)
                                                                {{ number_format($movement->unit_cost, 2) }} €
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                        <div class="col-6">
                                                            <strong>Référence:</strong><br>
                                                            {{ $movement->reference ?: '-' }}
                                                        </div>
                                                    </div>
                                                    @if($movement->notes)
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <strong>Notes:</strong><br>
                                                            {{ $movement->notes }}
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
                            {{ $movements->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun mouvement trouvé</h5>
                            <p class="text-muted">Commencez par créer votre premier mouvement de stock.</p>
                            <a href="{{ route('erp.inventory.movements.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>
                                Créer un Mouvement
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 