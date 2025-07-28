<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow p-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-cover rounded mb-2">
                    @endif
                    <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-600">{{ number_format($product->price, 2) }} DH</p>
                    <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:underline text-sm">Voir</a>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">Aucun produit dans cette catégorie.</p>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout> 