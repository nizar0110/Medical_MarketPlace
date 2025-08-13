@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-file-invoice me-2"></i>
                        Gestion des Devis
                    </h2>
                    <p class="text-muted mb-0">Liste des devis et propositions commerciales</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuoteModal">
                        <i class="fas fa-plus me-1"></i>
                        Nouveau Devis
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quotes List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Devis Disponibles
                    </h5>
                </div>
                <div class="card-body">
                    @if($quotes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Référence</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotes as $quote)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $quote->reference ?: 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $quote->customer_name ?: 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ \Carbon\Carbon::parse($quote->created_at)->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($quote->created_at)->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">{{ $quote->total_amount ?: '0.00' }} €</span>
                                        </td>
                                        <td>
                                            @if($quote->status === 'pending')
                                                <span class="badge bg-warning">En attente</span>
                                            @elseif($quote->status === 'accepted')
                                                <span class="badge bg-success">Accepté</span>
                                            @elseif($quote->status === 'rejected')
                                                <span class="badge bg-danger">Rejeté</span>
                                            @elseif($quote->status === 'expired')
                                                <span class="badge bg-secondary">Expiré</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $quote->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#quoteModal{{ $quote->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal pour les détails -->
                                    <div class="modal fade" id="quoteModal{{ $quote->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails du Devis</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Référence:</strong><br>
                                                            {{ $quote->reference ?: 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Date:</strong><br>
                                                            {{ \Carbon\Carbon::parse($quote->created_at)->format('d/m/Y H:i') }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Client:</strong><br>
                                                            {{ $quote->customer_name ?: 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Statut:</strong><br>
                                                            @if($quote->status === 'pending')
                                                                <span class="badge bg-warning">En attente</span>
                                                            @elseif($quote->status === 'accepted')
                                                                <span class="badge bg-success">Accepté</span>
                                                            @elseif($quote->status === 'rejected')
                                                                <span class="badge bg-danger">Rejeté</span>
                                                            @elseif($quote->status === 'expired')
                                                                <span class="badge bg-secondary">Expiré</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ $quote->status }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Montant Total:</strong><br>
                                                            <span class="h5 text-success">{{ $quote->total_amount ?: '0.00' }} €</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Validité:</strong><br>
                                                            {{ $quote->valid_until ? \Carbon\Carbon::parse($quote->valid_until)->format('d/m/Y') : 'Non définie' }}
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
                            {{ $quotes->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-invoice fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun devis configuré</h5>
                            <p class="text-muted">Commencez par créer votre premier devis.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuoteModal">
                                <i class="fas fa-plus me-1"></i>
                                Créer un Devis
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout Devis -->
<div class="modal fade" id="addQuoteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau Devis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reference" class="form-label">Référence</label>
                            <input type="text" class="form-control" id="reference" placeholder="Ex: DEV-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customer_id" class="form-label">Client *</label>
                            <select class="form-select" id="customer_id" required>
                                <option value="">Sélectionner un client...</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="valid_until" class="form-label">Validité jusqu'au</label>
                            <input type="date" class="form-control" id="valid_until">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" rows="3" placeholder="Notes sur le devis..."></textarea>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Articles du Devis</label>
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
                <button type="button" class="btn btn-primary">Créer le Devis</button>
            </div>
        </div>
    </div>
</div>
@endsection 