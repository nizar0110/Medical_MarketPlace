<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Produits') }}
            </h2>
            <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Ajouter un produit
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">Aucune image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                            {{ number_format($product->price, 2) }} DH
                                        </span>
                                        <span class="text-sm text-gray-500">Stock: {{ $product->stock }}</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('products.show', $product) }}" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Voir
                                        </a>
                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-sm font-bold py-2 px-4 rounded">
                                                    Panier
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Modifier
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce produit ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded" type="submit">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($products->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500">Aucun produit trouvé.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 