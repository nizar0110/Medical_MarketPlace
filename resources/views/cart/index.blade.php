<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Panier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Liste des produits -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Produits dans votre panier</h3>
                            
                            @forelse($cartItems ?? [] as $item)
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg mb-4">
                                    <!-- Image du produit -->
                                    <div class="flex-shrink-0">
                                        @if($item['product']->image)
                                            <img src="{{ asset('storage/' . $item['product']->image) }}" 
                                                 alt="{{ $item['product']->name }}" 
                                                 class="w-20 h-20 object-cover rounded">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-gray-500 text-sm">No img</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Informations du produit -->
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $item['product']->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $item['product']->category->name }}</p>
                                        <p class="text-sm text-gray-500">Prix unitaire: {{ number_format($item['product']->price, 2) }} DH</p>
                                    </div>

                                    <!-- Gestion de la quantité -->
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="flex items-center border border-gray-300 rounded-lg">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="px-3 py-2 text-gray-600 hover:text-gray-800" 
                                                    onclick="updateQuantity({{ $item['product']->id }}, -1)">
                                                -
                                            </button>
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                   min="1" max="{{ $item['product']->stock }}" 
                                                   class="w-16 text-center border-0 focus:ring-0" 
                                                   id="quantity-{{ $item['product']->id }}"
                                                   onchange="updateQuantity({{ $item['product']->id }}, 0, this.value)">
                                            <button type="button" class="px-3 py-2 text-gray-600 hover:text-gray-800" 
                                                    onclick="updateQuantity({{ $item['product']->id }}, 1)">
                                                +
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Prix total -->
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900">{{ number_format($item['subtotal'], 2) }} DH</p>
                                    </div>

                                    <!-- Bouton supprimer -->
                                    <div>
                                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" 
                                                    onclick="return confirm('Supprimer ce produit du panier ?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Votre panier est vide</h3>
                                    <p class="text-gray-500 mb-6">Découvrez nos produits et commencez vos achats</p>
                                    <a href="{{ route('products.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                                        Voir les produits
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Résumé de la commande -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Résumé de la commande</h3>
                            
                            @if(count($cartItems ?? []) > 0)
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Sous-total</span>
                                        <span class="font-medium">{{ number_format($total, 2) }} DH</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Livraison</span>
                                        <span class="font-medium">
                                            @if($total > 1000)
                                                <span class="text-green-600">Gratuite</span>
                                            @else
                                                99.99 DH
                                            @endif
                                        </span>
                                    </div>
                                    
                                    @if($total <= 100)
                                        <div class="text-sm text-green-600">
                                            Ajoutez {{ number_format(100 - $total, 2) }} € pour la livraison gratuite
                                        </div>
                                    @endif
                                    
                                    <div class="border-t pt-4">
                                        <div class="flex justify-between">
                                            <span class="text-lg font-semibold">Total</span>
                                            <span class="text-lg font-semibold text-blue-600">
                                                {{ number_format($total + ($total > 1000 ? 0 : 99.99), 2) }} DH
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                        Passer la commande
                                    </button>
                                    
                                    <div class="text-center">
                                        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                            Continuer mes achats
                                        </a>
                                    </div>
                                    
                                    <!-- Bouton vider le panier -->
                                    <div class="text-center pt-4 border-t">
                                        <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm" 
                                                    onclick="return confirm('Vider complètement le panier ?')">
                                                Vider le panier
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <p class="text-gray-500">Aucun produit dans le panier</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Codes promo -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Code promo</h3>
                            <div class="flex space-x-2">
                                <input type="text" placeholder="Entrez votre code" 
                                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                    Appliquer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(itemId, change, newValue = null) {
            const input = document.getElementById(`quantity-${itemId}`);
            let quantity = parseInt(input.value);
            
            if (newValue !== null) {
                quantity = parseInt(newValue);
            } else {
                quantity += change;
            }
            
            if (quantity < 1) quantity = 1;
            
            // Soumettre le formulaire
            const form = input.closest('form');
            input.value = quantity;
            form.submit();
        }
    </script>
</x-app-layout> 