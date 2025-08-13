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
                        Commandes d'Achat
                    </h2>
                    <p class="text-muted mb-0">Gestion des commandes fournisseurs</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                        <i class="fas fa-plus me-1"></i>
                        Nouvelle Commande
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Purchase Orders List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Commandes Disponibles
                    </h5>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Référence</th>
                                        <th>Fournisseur</th>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $order->reference ?: 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $order->supplier_name ?: 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">{{ $order->total_amount ?: '0.00' }} €</span>
                                        </td>
                                        <td>
                                            @if($order->status === 'pending')
                                                <span class="badge bg-warning">En attente</span>
                                            @elseif($order->status === 'approved')
                                                <span class="badge bg-success">Approuvée</span>
                                            @elseif($order->status === 'received')
                                                <span class="badge bg-info">Réceptionnée</span>
                                            @elseif($order->status === 'cancelled')
                                                <span class="badge bg-danger">Annulée</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal pour les détails -->
                                    <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails de la Commande</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Référence:</strong><br>
                                                            {{ $order->reference ?: 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Date:</strong><br>
                                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Fournisseur:</strong><br>
                                                            {{ $order->supplier_name ?: 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Statut:</strong><br>
                                                            @if($order->status === 'pending')
                                                                <span class="badge bg-warning">En attente</span>
                                                            @elseif($order->status === 'approved')
                                                                <span class="badge bg-success">Approuvée</span>
                                                            @elseif($order->status === 'received')
                                                                <span class="badge bg-info">Réceptionnée</span>
                                                            @elseif($order->status === 'cancelled')
                                                                <span class="badge bg-danger">Annulée</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ $order->status }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Montant Total:</strong><br>
                                                            <span class="h5 text-success">{{ $order->total_amount ?: '0.00' }} €</span>
                                                        </div>
                                                    </div>
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
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucune commande d'achat</h5>
                            <p class="text-muted">Commencez par créer votre première commande.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                                <i class="fas fa-plus me-1"></i>
                                Créer une Commande
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout Commande -->
<div class="modal fade" id="addOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle Commande d'Achat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reference" class="form-label">Référence</label>
                            <input type="text" class="form-control" id="reference" placeholder="Ex: PO-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="supplier_id" class="form-label">Fournisseur *</label>
                            <select class="form-select" id="supplier_id" required>
                                <option value="">Sélectionner un fournisseur...</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" rows="3" placeholder="Notes sur la commande..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Articles de la Commande</label>
                        <div class="border rounded p-3">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Produit" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" placeholder="Quantité" min="1" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" placeholder="Prix unitaire" step="0.01" min="0">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" placeholder="Total" step="0.01" readonly>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>
                                Ajouter un Article
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Créer la Commande</button>
            </div>
        </div>
    </div>
</div>
@endsection 