@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-book me-2"></i>
                        Plan Comptable
                    </h2>
                    <p class="text-muted mb-0">Gestion des comptes comptables</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        <i class="fas fa-plus me-1"></i>
                        Nouveau Compte
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart of Accounts -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Comptes Comptables
                    </h5>
                </div>
                <div class="card-body">
                    @if($accounts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Nom du Compte</th>
                                        <th>Type</th>
                                        <th>Catégorie</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $account)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $account->account_code }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $account->account_name }}</div>
                                            @if($account->description)
                                                <small class="text-muted">{{ $account->description }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($account->account_type === 'asset')
                                                <span class="badge bg-success">Actif</span>
                                            @elseif($account->account_type === 'liability')
                                                <span class="badge bg-danger">Passif</span>
                                            @elseif($account->account_type === 'equity')
                                                <span class="badge bg-info">Capitaux</span>
                                            @elseif($account->account_type === 'revenue')
                                                <span class="badge bg-warning">Produits</span>
                                            @elseif($account->account_type === 'expense')
                                                <span class="badge bg-secondary">Charges</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $account->account_type }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $account->account_category ?: '-' }}</td>
                                        <td>
                                            @if($account->is_active)
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-secondary">Inactif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#accountModal{{ $account->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal pour les détails -->
                                    <div class="modal fade" id="accountModal{{ $account->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails du Compte</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Code:</strong><br>
                                                            {{ $account->account_code }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Nom:</strong><br>
                                                            {{ $account->account_name }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Type:</strong><br>
                                                            @if($account->account_type === 'asset')
                                                                Actif
                                                            @elseif($account->account_type === 'liability')
                                                                Passif
                                                            @elseif($account->account_type === 'equity')
                                                                Capitaux
                                                            @elseif($account->account_type === 'revenue')
                                                                Produits
                                                            @elseif($account->account_type === 'expense')
                                                                Charges
                                                            @else
                                                                {{ $account->account_type }}
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Catégorie:</strong><br>
                                                            {{ $account->account_category ?: 'Non définie' }}
                                                        </div>
                                                    </div>
                                                    @if($account->description)
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <strong>Description:</strong><br>
                                                            {{ $account->description }}
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
                            {{ $accounts->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-book fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun compte configuré</h5>
                            <p class="text-muted">Commencez par créer votre premier compte comptable.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                                <i class="fas fa-plus me-1"></i>
                                Créer un Compte
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout Compte -->
<div class="modal fade" id="addAccountModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau Compte Comptable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="account_code" class="form-label">Code du Compte *</label>
                            <input type="text" class="form-control" id="account_code" placeholder="Ex: 512000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="account_name" class="form-label">Nom du Compte *</label>
                            <input type="text" class="form-control" id="account_name" placeholder="Ex: Banque" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="account_type" class="form-label">Type de Compte *</label>
                            <select class="form-select" id="account_type" required>
                                <option value="">Sélectionner...</option>
                                <option value="asset">Actif</option>
                                <option value="liability">Passif</option>
                                <option value="equity">Capitaux</option>
                                <option value="revenue">Produits</option>
                                <option value="expense">Charges</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Catégorie</label>
                            <input type="text" class="form-control" id="category" placeholder="Ex: Trésorerie">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Description du compte..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Créer le Compte</button>
            </div>
        </div>
    </div>
</div>
@endsection 