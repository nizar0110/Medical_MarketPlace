@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Créer un nouveau produit
                    </h3>
                </div>
                <div class="card-body">
                    <form id="productForm" action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Nom du produit -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">
                                Nom du produit <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                placeholder="Ex: Masque chirurgical N95" 
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">
                                Description <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="4" 
                                placeholder="Décrivez votre produit en détail..." 
                                required
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Catégorie -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-bold">
                                Catégorie <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" 
                                name="category_id" 
                                required
                            >
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prix et Stock -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold">
                                    Prix (DH) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        class="form-control @error('price') is-invalid @enderror" 
                                        id="price" 
                                        name="price" 
                                        value="{{ old('price') }}" 
                                        placeholder="0.00" 
                                        required
                                    >
                                    <span class="input-group-text">DH</span>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-bold">
                                    Stock disponible <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    class="form-control @error('stock') is-invalid @enderror" 
                                    id="stock" 
                                    name="stock" 
                                    value="{{ old('stock', 0) }}" 
                                    placeholder="0" 
                                    min="0"
                                    required
                                >
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image du produit -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">
                                Image du produit <span class="text-danger">*</span>
                            </label>
                            <div class="mb-2">
                                <input 
                                    class="form-control @error('image') is-invalid @enderror" 
                                    type="file" 
                                    id="image" 
                                    name="image" 
                                    accept="image/*"
                                    required
                                >
                                <div class="form-text">Formats acceptés: JPEG, PNG, JPG, GIF, SVG (max 2MB)</div>
                            </div>
                            
                            <!-- Preview de l'image -->
                            <div id="imagePreview" class="d-none">
                                <img id="previewImg" src="" alt="Aperçu" class="img-thumbnail" style="max-height: 200px;">
                                <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeImagePreview()">
                                    <i class="fas fa-times"></i> Supprimer
                                </button>
                            </div>
                            
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-1"></i>Créer le produit
                            </button>
                            <a href="{{ route('seller.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Preview de l'image sélectionnée
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Vérifier la taille du fichier (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            alert('Le fichier est trop volumineux. Taille maximum: 2MB');
            this.value = '';
            return;
        }
        
        // Vérifier le type de fichier
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml'];
        if (!validTypes.includes(file.type)) {
            alert('Type de fichier non supporté. Utilisez JPEG, PNG, JPG, GIF ou SVG.');
            this.value = '';
            return;
        }
        
        // Afficher l'aperçu
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});

// Supprimer l'aperçu de l'image
function removeImagePreview() {
    document.getElementById('image').value = '';
    document.getElementById('imagePreview').classList.add('d-none');
    document.getElementById('previewImg').src = '';
}

// Gestion de la soumission du formulaire
document.getElementById('productForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    const submitBtn = document.getElementById('submitBtn');
    
    // Désactiver le bouton pendant la soumission
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Création en cours...';
    
    // Validation côté client
    if (!form.checkValidity()) {
        form.reportValidity();
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save me-1"></i>Créer le produit';
        return;
    }
    
    // Envoyer le formulaire
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Succès
            Swal.fire({
                icon: 'success',
                title: 'Succès!',
                text: 'Produit créé avec succès',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '{{ route("seller.dashboard") }}';
            });
        } else {
            // Erreur
            Swal.fire({
                icon: 'error',
                title: 'Erreur!',
                text: data.message || 'Une erreur est survenue',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        Swal.fire({
            icon: 'error',
            title: 'Erreur!',
            text: 'Une erreur est survenue lors de la création du produit',
            confirmButtonText: 'OK'
        });
    })
    .finally(() => {
        // Réactiver le bouton
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save me-1"></i>Créer le produit';
    });
});
</script>

<!-- SweetAlert2 pour les notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.form-check-input:checked + .form-check-label {
    border-color: #0d6efd !important;
    background-color: #f8f9ff !important;
}

.form-check-label {
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-check-label:hover {
    border-color: #0d6efd !important;
    background-color: #f8f9ff !important;
}
</style>
@endsection
