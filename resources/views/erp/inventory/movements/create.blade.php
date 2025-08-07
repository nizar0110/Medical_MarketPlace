@extends('erp.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-plus-circle me-2"></i>
                        Nouveau Mouvement de Stock
                    </h2>
                    <p class="text-muted mb-0">Enregistrer un mouvement de stock</p>
                </div>
                <div>
                    <a href="{{ route('erp.inventory.movements.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Détails du Mouvement
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('erp.inventory.movements.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="product_id" class="form-label">Produit *</label>
                                <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                    <option value="">Sélectionner un produit</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="warehouse_id" class="form-label">Entrepôt *</label>
                                <select class="form-select @error('warehouse_id') is-invalid @enderror" id="warehouse_id" name="warehouse_id" required>
                                    <option value="">Sélectionner un entrepôt</option>
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                            {{ $warehouse->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('warehouse_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="movement_type" class="form-label">Type de Mouvement *</label>
                                <select class="form-select @error('movement_type') is-invalid @enderror" id="movement_type" name="movement_type" required>
                                    <option value="">Sélectionner le type</option>
                                    <option value="in" {{ old('movement_type') == 'in' ? 'selected' : '' }}>Entrée de stock</option>
                                    <option value="out" {{ old('movement_type') == 'out' ? 'selected' : '' }}>Sortie de stock</option>
                                    <option value="transfer" {{ old('movement_type') == 'transfer' ? 'selected' : '' }}>Transfert</option>
                                    <option value="adjustment" {{ old('movement_type') == 'adjustment' ? 'selected' : '' }}>Ajustement</option>
                                </select>
                                @error('movement_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Quantité *</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="unit_cost" class="form-label">Coût Unitaire</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('unit_cost') is-invalid @enderror" id="unit_cost" name="unit_cost" value="{{ old('unit_cost') }}" min="0" step="0.01">
                                    <span class="input-group-text">€</span>
                                </div>
                                @error('unit_cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="reference" class="form-label">Référence</label>
                                <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" name="reference" value="{{ old('reference') }}" placeholder="Ex: PO-2024-001">
                                @error('reference')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" placeholder="Informations supplémentaires...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('erp.inventory.movements.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Enregistrer le Mouvement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validation en temps réel
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const quantityInput = document.getElementById('quantity');
    const unitCostInput = document.getElementById('unit_cost');
    
    // Validation de la quantité
    quantityInput.addEventListener('input', function() {
        if (this.value < 1) {
            this.setCustomValidity('La quantité doit être supérieure à 0');
        } else {
            this.setCustomValidity('');
        }
    });
    
    // Validation du coût unitaire
    unitCostInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.setCustomValidity('Le coût unitaire ne peut pas être négatif');
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>
@endsection 