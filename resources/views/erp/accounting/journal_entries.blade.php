@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-journal-whills me-2"></i>
                        Journal des Écritures
                    </h2>
                    <p class="text-muted mb-0">Gestion des écritures comptables</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEntryModal">
                        <i class="fas fa-plus me-1"></i>
                        Nouvelle Écriture
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Journal Entries -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Écritures Comptables
                    </h5>
                </div>
                <div class="card-body">
                    @if($entries->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Référence</th>
                                        <th>Description</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($entries as $entry)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ \Carbon\Carbon::parse($entry->created_at)->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($entry->created_at)->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $entry->reference ?: 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $entry->description ?: 'Aucune description' }}</div>
                                            @if($entry->notes)
                                                <small class="text-muted">{{ $entry->notes }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">{{ $entry->total_amount ?: '0.00' }} €</span>
                                        </td>
                                        <td>
                                            @if($entry->status === 'posted')
                                                <span class="badge bg-success">Comptabilisée</span>
                                            @elseif($entry->status === 'draft')
                                                <span class="badge bg-warning">Brouillon</span>
                                            @elseif($entry->status === 'pending')
                                                <span class="badge bg-info">En attente</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $entry->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#entryModal{{ $entry->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal pour les détails -->
                                    <div class="modal fade" id="entryModal{{ $entry->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails de l'Écriture</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Référence:</strong><br>
                                                            {{ $entry->reference ?: 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Date:</strong><br>
                                                            {{ \Carbon\Carbon::parse($entry->created_at)->format('d/m/Y H:i') }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <strong>Description:</strong><br>
                                                            {{ $entry->description ?: 'Aucune description' }}
                                                        </div>
                                                    </div>
                                                    @if($entry->notes)
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <strong>Notes:</strong><br>
                                                            {{ $entry->notes }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Montant Total:</strong><br>
                                                            <span class="h5 text-success">{{ $entry->total_amount ?: '0.00' }} €</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Statut:</strong><br>
                                                            @if($entry->status === 'posted')
                                                                <span class="badge bg-success">Comptabilisée</span>
                                                            @elseif($entry->status === 'draft')
                                                                <span class="badge bg-warning">Brouillon</span>
                                                            @elseif($entry->status === 'pending')
                                                                <span class="badge bg-info">En attente</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ $entry->status }}</span>
                                                            @endif
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
                            {{ $entries->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-journal-whills fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucune écriture comptable</h5>
                            <p class="text-muted">Commencez par créer votre première écriture.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEntryModal">
                                <i class="fas fa-plus me-1"></i>
                                Créer une Écriture
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout Écriture -->
<div class="modal fade" id="addEntryModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle Écriture Comptable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reference" class="form-label">Référence</label>
                            <input type="text" class="form-control" id="reference" placeholder="Ex: EC-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entry_date" class="form-label">Date d'Écriture *</label>
                            <input type="date" class="form-control" id="entry_date" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <input type="text" class="form-control" id="description" placeholder="Description de l'écriture..." required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" rows="3" placeholder="Notes additionnelles..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Lignes d'Écriture</label>
                        <div class="border rounded p-3">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Compte" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" placeholder="Débit" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" placeholder="Crédit" step="0.01">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>
                                Ajouter une Ligne
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Créer l'Écriture</button>
            </div>
        </div>
    </div>
</div>
@endsection 