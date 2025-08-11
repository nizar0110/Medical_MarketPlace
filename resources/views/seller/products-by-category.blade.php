<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes Produits
            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 align-middle">
                Catégorie: {{ $category->name }}
            </span>
        </h2>
    </x-slot>

    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Filtres catégories -->
            <x-dashboard.section title="Filtrer par catégorie">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">
                    @foreach(\App\Models\Category::all() as $cat)
                        <a href="{{ route('seller.products.by-category', $cat->id) }}"
                           class="inline-flex items-center justify-center px-3 py-2 rounded-md text-xs md:text-sm font-medium border transition-colors
                                  {{ $cat->id == $category->id ? 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                            <svg class="w-6 h-6 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h8M7 17h6" />
                            </svg>
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </x-dashboard.section>

            <!-- Grille produits -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($products as $product)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 flex flex-col">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-36 md:h-40 w-full object-cover">
                        @else
                            <div class="h-36 md:h-40 w-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 7l3 12h12l3-12M3 7l7.5 5L18 7" />
                                </svg>
                            </div>
                        @endif

                        <div class="p-3 md:p-4 flex flex-col gap-2 flex-1">
                            <h3 class="font-semibold text-gray-900 text-sm md:text-base leading-tight">{{ $product->name }}</h3>
                            <p class="text-xs md:text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>

                            <div class="mt-auto">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-blue-600 font-bold text-sm md:text-base">{{ number_format($product->price, 2) }} DH</span>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $product->stock > 0 ? 'En stock' : 'Rupture' }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-3 gap-2">
                                    <a href="{{ route('products.show', $product) }}" class="inline-flex items-center justify-center px-2.5 py-1.5 border border-blue-300 text-blue-700 rounded-md text-xs md:text-sm hover:bg-blue-50">
                                        Voir
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center justify-center px-2.5 py-1.5 border border-yellow-300 text-yellow-700 rounded-md text-xs md:text-sm hover:bg-yellow-50">
                                        Éditer
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full inline-flex items-center justify-center px-2.5 py-1.5 border border-red-300 text-red-700 rounded-md text-xs md:text-sm hover:bg-red-50" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-10 bg-white rounded-lg border border-dashed border-gray-300">
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m16 0H4" />
                            </svg>
                            <h4 class="text-gray-700 font-medium mb-1">Aucun produit dans cette catégorie</h4>
                            <p class="text-gray-500 text-sm mb-4">Commencez par ajouter un produit à cette catégorie</p>
                            <a href="{{ route('products.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md text-sm font-medium transition-colors">
                                Ajouter un produit
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Retour -->
            <div class="mt-4">
                <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>
</x-app-layout>