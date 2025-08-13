@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-truck me-2"></i>
                        Gestion des Fournisseurs
                    </h2>
                    <p class="text-muted mb-0">Liste des fournisseurs et partenaires</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                        <i class="fas fa-plus me-1"></i>
                        Nouveau Fournisseur
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Suppliers List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Fournisseurs Disponibles
                    </h5>
                </div>
                <div class="card-body">
                    @if($suppliers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Contact</th>
                                        <th>Ville</th>
                                        <th>Pays</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suppliers as $supplier)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $supplier->name }}</div>
                                            @if($supplier->company_name)
                                                <small class="text-muted">{{ $supplier->company_name }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($supplier->email)
                                                <div><i class="fas fa-envelope me-1"></i>{{ $supplier->email }}</div>
                                            @endif
                                            @if($supplier->phone)
                                                <div><i class="fas fa-phone me-1"></i>{{ $supplier->phone }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $supplier->city ?: '-' }}</td>
                                        <td>{{ $supplier->country ?: '-' }}</td>
                                        <td>
                                            @if($supplier->is_active)
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-secondary">Inactif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#supplierModal{{ $supplier->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal pour les détails -->
                                    <div class="modal fade" id="supplierModal{{ $supplier->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails du Fournisseur</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Nom:</strong><br>
                                                            {{ $supplier->name }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Société:</strong><br>
                                                            {{ $supplier->company_name ?: 'Non définie' }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Adresse:</strong><br>
                                                            {{ $supplier->address ?: 'Non définie' }}<br>
                                                            {{ $supplier->postal_code ?: '' }} {{ $supplier->city ?: '' }}<br>
                                                            {{ $supplier->state ?: '' }} {{ $supplier->country ?: '' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Contact:</strong><br>
                                                            @if($supplier->email)
                                                                <i class="fas fa-envelope me-1"></i>{{ $supplier->email }}<br>
                                                            @endif
                                                            @if($supplier->phone)
                                                                <i class="fas fa-phone me-1"></i>{{ $supplier->phone }}
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
                            {{ $suppliers->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-truck fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun fournisseur configuré</h5>
                            <p class="text-muted">Commencez par créer votre premier fournisseur.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                                <i class="fas fa-plus me-1"></i>
                                Créer un Fournisseur
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout Fournisseur -->
<div class="modal fade" id="addSupplierModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau Fournisseur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nom *</label>
                            <input type="text" class="form-control" id="name" placeholder="Nom du fournisseur" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Société</label>
                            <input type="text" class="form-control" id="company_name" placeholder="Nom de la société">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="email@exemple.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="+33 1 23 45 67 89">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse</label>
                        <textarea class="form-control" id="address" rows="2" placeholder="Adresse complète..."></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="postal_code" class="form-label">Code Postal</label>
                            <input type="text" class="form-control" id="postal_code" placeholder="75001">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="city" placeholder="Paris">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="country" class="form-label">Pays</label>
                            <input type="text" class="form-control" id="country" placeholder="France">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Créer le Fournisseur</button>
            </div>
        </div>
    </div>
</div>
@endsection 