@extends('layouts.app')

@section('content')
    <!-- Navbar incluse dans layouts.app -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-3">
            <a class="navbar-brand fw-bold fs-3" href="#">Medical Marketplace</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                <input class="form-control me-2" type="search" name="q" placeholder="Rechercher un produit..." aria-label="Search">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </form>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Inscription</a>
        </div>
    </div>

    <h2 class="mb-4">Produits en promotion</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Produit" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <span class="badge bg-success">{{ number_format($product->price, 2) }} €</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer')
    <footer class="bg-light text-center py-3 mt-5">
        <div class="container">
            <span class="text-muted">&copy; {{ date('Y') }} Medical Marketplace. Tous droits réservés.</span>
        </div>
    </footer>
@endsection 