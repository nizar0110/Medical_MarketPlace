@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Messages de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                                            <div class="fw-bold">{{ $supplier->company_name }}</div>
                                            @if($supplier->contact_name)
                                                <small class="text-muted">{{ $supplier->contact_name }}</small>
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
                                            @if($supplier->status === 'active')
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
                                                            <strong>Société:</strong><br>
                                                            {{ $supplier->company_name }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Contact:</strong><br>
                                                            {{ $supplier->contact_name ?: 'Non défini' }}
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
                <form method="POST" action="{{ route('erp.purchases.suppliers.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Nom de la société *</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Nom de la société" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contact_name" class="form-label">Nom du contact</label>
                            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Nom du contact">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@exemple.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="+212 5 22 34 56 78">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse</label>
                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="Adresse complète..."></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="postal_code" class="form-label">Code Postal</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="20000">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="city" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Casablanca">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="state" class="form-label">Région</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Casablanca-Settat">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="country" class="form-label">Pays</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Maroc" value="Maroc">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer le Fournisseur</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 