<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du produit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-6" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600">
                                    Produits
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-gray-500 md:ml-2">{{ $product->name }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Image du produit -->
                        <div>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-96 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                                    <span class="text-gray-500 text-lg">Aucune image disponible</span>
                                </div>
                            @endif
                        </div>

                        <!-- Informations du produit -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                            
                            <!-- Prix -->
                            <div class="mb-6">
                                <span class="text-4xl font-bold text-green-600">{{ number_format($product->price, 2) }} DH</span>
                                @if($product->price > 1000)
                                    <span class="ml-2 text-sm text-gray-500">Livraison gratuite</span>
                                @endif
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                            </div>

                            <!-- Catégorie -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Catégorie</h3>
                                <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            <!-- Stock -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Disponibilité</h3>
                                @if($product->stock > 0)
                                    <span class="text-green-600 font-medium">En stock ({{ $product->stock }} disponibles)</span>
                                @else
                                    <span class="text-red-600 font-medium">Rupture de stock</span>
                                @endif
                            </div>

                            <!-- Vendeur -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Vendeur</h3>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span class="text-gray-600 font-semibold">{{ substr($product->seller->name, 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900">{{ $product->seller->name }}</p>
                                        <p class="text-sm text-gray-500">Vendeur vérifié</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="space-y-4">
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex space-x-4">
                                        @csrf
                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                            <button type="button" class="px-3 py-2 text-gray-600 hover:text-gray-800" onclick="decreaseQuantity()">-</button>
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                                   class="w-16 text-center border-0 focus:ring-0" id="quantity">
                                            <button type="button" class="px-3 py-2 text-gray-600 hover:text-gray-800" onclick="increaseQuantity()">+</button>
                                        </div>
                                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                            </svg>
                                            Ajouter au panier
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-400 text-white font-bold py-3 px-6 rounded-lg cursor-not-allowed">
                                        Produit indisponible
                                    </button>
                                @endif

                                <div class="flex space-x-4">
                                    <button class="flex-1 border border-gray-300 text-gray-700 font-bold py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors">
                                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        Favoris
                                    </button>
                                    <button class="flex-1 border border-gray-300 text-gray-700 font-bold py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors">
                                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                        </svg>
                                        Partager
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.getAttribute('max'));
            const current = parseInt(input.value);
            if (current < max) {
                input.value = current + 1;
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            if (current > 1) {
                input.value = current - 1;
            }
        }
    </script>
</x-app-layout> 