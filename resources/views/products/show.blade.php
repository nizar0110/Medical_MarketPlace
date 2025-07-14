@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-5">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/400x300?text=Produit" class="img-fluid rounded-start" alt="{{ $product->name }}">
                @endif
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h2 class="card-title">{{ $product->name }}</h2>
                    <p class="card-text">{{ $product->description }}</p>
                    <span class="badge bg-success mb-2">{{ number_format($product->price, 2) }} €</span>
                    <div class="mt-3">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 