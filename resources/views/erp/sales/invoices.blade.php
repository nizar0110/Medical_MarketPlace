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
                        <i class="fas fa-receipt me-2"></i>
                        Gestion des Factures
                    </h2>
                    <p class="text-muted mb-0">Liste des factures et documents de vente</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInvoiceModal">
                        <i class="fas fa-plus me-1"></i>
                        Nouvelle Facture
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoices List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Factures Disponibles
                    </h5>
                </div>
                <div class="card-body">
                    @if($invoices->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $invoice->invoice_number ?: 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $invoice->customer_name ?: 'N/A' }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($invoice->created_at)->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">{{ $invoice->total_amount ?: '0.00' }} €</span>
                                        </td>
                                        <td>
                                            @if($invoice->status === 'draft')
                                                <span class="badge bg-secondary">Brouillon</span>
                                            @elseif($invoice->status === 'sent')
                                                <span class="badge bg-info">Envoyée</span>
                                            @elseif($invoice->status === 'paid')
                                                <span class="badge bg-success">Payée</span>
                                            @elseif($invoice->status === 'overdue')
                                                <span class="badge bg-danger">En retard</span>
                                            @elseif($invoice->status === 'cancelled')
                                                <span class="badge bg-warning">Annulée</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $invoice->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal{{ $invoice->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal pour les détails -->
                                    <div class="modal fade" id="invoiceModal{{ $invoice->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails de la Facture</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Numéro:</strong><br>
                                                            {{ $invoice->invoice_number ?: 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Date:</strong><br>
                                                            {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y H:i') }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Client:</strong><br>
                                                            {{ $invoice->customer_name ?: 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Statut:</strong><br>
                                                            @if($invoice->status === 'draft')
                                                                <span class="badge bg-secondary">Brouillon</span>
                                                            @elseif($invoice->status === 'sent')
                                                                <span class="badge bg-info">Envoyée</span>
                                                            @elseif($invoice->status === 'paid')
                                                                <span class="badge bg-success">Payée</span>
                                                            @elseif($invoice->status === 'overdue')
                                                                <span class="badge bg-danger">En retard</span>
                                                            @elseif($invoice->status === 'cancelled')
                                                                <span class="badge bg-warning">Annulée</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ $invoice->status }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Montant Total:</strong><br>
                                                            <span class="h5 text-success">{{ $invoice->total_amount ?: '0.00' }} €</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Échéance:</strong><br>
                                                            {{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') : 'Non définie' }}
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
                            {{ $invoices->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-receipt fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucune facture configurée</h5>
                            <p class="text-muted">Commencez par créer votre première facture.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInvoiceModal">
                                <i class="fas fa-plus me-1"></i>
                                Créer une Facture
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout Facture -->
<div class="modal fade" id="addInvoiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle Facture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('erp.sales.invoices.store') }}" id="invoiceForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="invoice_number" class="form-label">Numéro de Facture</label>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number" placeholder="Ex: FAC-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customer_id" class="form-label">Client *</label>
                            <select class="form-select" id="customer_id" name="customer_id" required>
                                <option value="">Sélectionner un client...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->contact_name }}
                                        @if($customer->company_name)
                                            - {{ $customer->company_name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">Date d'échéance</label>
                            <input type="date" class="form-control" id="due_date" name="due_date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Notes sur la facture..."></textarea>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Articles de la Facture</label>
                        <div class="border rounded p-3">
                            <div class="invoice-item row mb-2">
                                <div class="col-md-4">
                                    <select class="form-select" name="items[0][product_id]" required>
                                        <option value="">Sélectionner un produit...</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                {{ $product->name }} - {{ $product->price }} DH
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control quantity" name="items[0][quantity]" placeholder="Quantité" min="1" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control unit-price" name="items[0][unit_price]" placeholder="Prix unitaire" step="0.01" min="0" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control total-price" placeholder="Total" step="0.01" readonly>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-outline-danger btn-sm remove-item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="addItem">
                                <i class="fas fa-plus me-1"></i>
                                Ajouter un Article
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="invoiceForm" class="btn btn-primary">Créer la Facture</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemIndex = 1;

    // Ajouter un nouvel article
    document.getElementById('addItem').addEventListener('click', function() {
        const invoiceItems = document.querySelector('.border.rounded.p-3');
        const newItem = document.createElement('div');
        newItem.className = 'invoice-item row mb-2';
        newItem.innerHTML = `
            <div class="col-md-4">
                <select class="form-select" name="items[${itemIndex}][product_id]" required>
                    <option value="">Sélectionner un produit...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} - {{ $product->price }} DH
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control quantity" name="items[${itemIndex}][quantity]" placeholder="Quantité" min="1" required>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control unit-price" name="items[${itemIndex}][unit_price]" placeholder="Prix unitaire" step="0.01" min="0" required>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control total-price" placeholder="Total" step="0.01" readonly>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger btn-sm remove-item">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        
        // Insérer avant le bouton "Ajouter"
        invoiceItems.insertBefore(newItem, this);
        itemIndex++;
        
        // Ajouter les event listeners pour le nouvel article
        addItemEventListeners(newItem);
    });

    // Supprimer un article
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item') || e.target.closest('.remove-item')) {
            const item = e.target.closest('.invoice-item');
            if (document.querySelectorAll('.invoice-item').length > 1) {
                item.remove();
            }
        }
    });

    // Auto-remplir le prix unitaire quand un produit est sélectionné
    document.addEventListener('change', function(e) {
        if (e.target.tagName === 'SELECT' && e.target.name.includes('[product_id]')) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            
            if (price) {
                const row = e.target.closest('.invoice-item');
                const priceInput = row.querySelector('.unit-price');
                if (priceInput) {
                    priceInput.value = price;
                    calculateTotal(row);
                }
            }
        }
    });
    
    // Calculer le total pour une ligne
    function calculateTotal(row) {
        const quantityInput = row.querySelector('.quantity');
        const priceInput = row.querySelector('.unit-price');
        const totalInput = row.querySelector('.total-price');
        
        if (quantityInput && priceInput && totalInput) {
            const quantity = parseFloat(quantityInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;
            const total = quantity * price;
            totalInput.value = total.toFixed(2);
        }
    }
    
    // Calculer le total quand la quantité ou le prix change
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('quantity') || e.target.classList.contains('unit-price')) {
            const row = e.target.closest('.invoice-item');
            calculateTotal(row);
        }
    });

    // Ajouter les event listeners pour les articles existants
    function addItemEventListeners(item) {
        const quantityInput = item.querySelector('.quantity');
        const unitPriceInput = item.querySelector('.unit-price');
        
        if (quantityInput) {
            quantityInput.addEventListener('input', () => calculateTotal(item));
        }
        if (unitPriceInput) {
            unitPriceInput.addEventListener('input', () => calculateTotal(item));
        }
    }

    // Ajouter les event listeners pour les articles existants
    document.querySelectorAll('.invoice-item').forEach(addItemEventListeners);
});
</script>
@endsection 