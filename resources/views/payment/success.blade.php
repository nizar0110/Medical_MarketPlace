@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-success">
                <div class="card-header bg-success text-white text-center">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h3 class="mb-0">Paiement réussi !</h3>
                    <p class="mb-0">Votre commande a été confirmée</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Informations de commande</h5>
                            <p><strong>Numéro de commande:</strong> {{ $order->order_number }}</p>
                            <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Statut:</strong> 
                                <span class="badge bg-{{ $order->status === 'paid' ? 'success' : 'warning' }}">
                                    {{ $order->status === 'paid' ? 'Payé' : 'En attente de paiement' }}
                                </span>
                            </p>
                            <p><strong>Méthode de paiement:</strong> 
                                {{ $order->payment_method === 'card' ? 'Carte bancaire' : 'Paiement à la livraison' }}
                            </p>
                        </div>
                        
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Adresse de livraison</h5>
                            <p><strong>Adresse:</strong><br>{{ $order->shipping_address }}</p>
                            <p><strong>Téléphone:</strong> {{ $order->shipping_phone }}</p>
                        </div>
                    </div>

                    <hr>

                    <h5 class="border-bottom pb-2">Détails de la commande</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-end">Prix unitaire</th>
                                    <th class="text-end">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="me-3" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light me-3 d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">{{ Str::limit($item->product->description, 50) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">{{ number_format($item->price, 2) }} DH</td>
                                        <td class="text-end fw-bold">{{ number_format($item->subtotal, 2) }} DH</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td class="text-end"><strong class="fs-5 text-primary">{{ number_format($order->total, 2) }} DH</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Important:</strong> Vous recevrez un email de confirmation avec les détails de votre commande. 
                        Notre équipe vous contactera bientôt pour confirmer la livraison.
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Continuer les achats
                        </a>
                        <a href="{{ route('client.dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-user me-2"></i>Mon tableau de bord
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 