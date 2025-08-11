<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord Vendeur') }}
        </h2>
    </x-slot>

    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Statistiques -->
            <div class="dashboard-grid mb-4">
                <x-dashboard.stat-card title="Total Produits" :value="$productsCount ?? 0" icon-variant="icon-blue" icon-size="default">
                    <x-slot name="icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </x-slot>
                </x-dashboard.stat-card>

                <x-dashboard.stat-card title="Chiffre d'affaires" :value="number_format($revenue ?? 0, 2) . ' DH'" icon-variant="icon-green" icon-size="default">
                    <x-slot name="icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </x-slot>
                </x-dashboard.stat-card>

                <x-dashboard.stat-card title="Total Commandes" :value="$ordersCount ?? 0" icon-variant="icon-yellow" icon-size="default">
                    <x-slot name="icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </x-slot>
                </x-dashboard.stat-card>

                <x-dashboard.stat-card title="Revenus du mois" :value="number_format($monthlyRevenue ?? 0, 2) . ' DH'" icon-variant="icon-purple" icon-size="default">
                    <x-slot name="icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </x-slot>
                </x-dashboard.stat-card>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6 items-start">
                <!-- Produits récents -->
                <x-dashboard.section title="Produits récents" class="h-full">
                    <x-slot name="action">
                        <a href="{{ route('seller.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md text-xs md:text-sm font-medium transition-colors">
                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Ajouter un produit
                        </a>
                    </x-slot>
                    <div class="dashboard-list">
                            @forelse($recentProducts ?? [] as $product)
                            <div class="dashboard-list-item justify-between gap-3 md:gap-4">
                                    <div class="flex items-center gap-4">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 md:w-14 md:h-14 object-cover rounded-lg">
                                        @else
                                            <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-medium text-gray-900 text-sm md:text-base">{{ $product->name }}</h4>
                                            <p class="text-xs md:text-sm text-gray-500">{{ number_format($product->price, 2) }} DH</p>
                                            <p class="text-xs md:text-sm text-gray-500">
                                                Stock:
                                                <span class="font-medium {{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">{{ $product->stock }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1.5 md:gap-2">
                                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 p-1 rounded hover:bg-blue-50">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('products.show', $product) }}" class="text-green-600 hover:text-green-800 p-1 rounded hover:bg-green-50">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="dashboard-icon dashboard-icon-lg bg-gray-100 mx-auto mb-4">
                                        <svg class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun produit encore</h3>
                                    <p class="text-gray-500 mb-4">Commencez par ajouter votre premier produit</p>
                                    <a href="{{ route('products.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md text-sm font-medium transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Ajouter votre premier produit
                                    </a>
                                </div>
                            @endforelse
                    </div>
                </x-dashboard.section>

                <!-- Commandes récentes -->
                <x-dashboard.section title="Commandes récentes" class="h-full">
                    <x-slot name="action">
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Voir toutes</a>
                    </x-slot>
                    <div class="dashboard-list">
                            @forelse($recentOrders ?? [] as $order)
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div>
                                    <h4 class="font-medium text-gray-900 text-sm md:text-base">Commande #{{ $order->id }}</h4>
                                    <p class="text-xs md:text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-xs md:text-sm font-medium text-gray-900">{{ number_format($order->total, 2) }} DH</p>
                                    </div>
                                    <span class="dashboard-badge
                                        @if($order->status === 'pending') status-pending
                                        @elseif($order->status === 'processing') status-processing
                                        @elseif($order->status === 'shipped' || $order->status === 'delivered') status-completed
                                        @elseif($order->status === 'cancelled') status-cancelled
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="dashboard-icon dashboard-icon-lg bg-gray-100 mx-auto mb-4">
                                    <svg class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune commande encore</h3>
                                    <p class="text-gray-500">Les commandes apparaîtront ici une fois que vous aurez des ventes</p>
                                </div>
                            @endforelse
                    </div>
                </x-dashboard.section>
            </div>

            <!-- Actions rapides -->
            <x-dashboard.section title="Actions rapides">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                        <a href="{{ route('products.create') }}" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-all duration-200">
                            <div class="dashboard-icon dashboard-icon-sm bg-blue-100 group-hover:bg-blue-200 transition-colors">
                                <svg class="text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="ml-3 md:ml-4">
                                <h4 class="font-medium text-gray-900 group-hover:text-blue-900 text-sm md:text-base">Ajouter un produit</h4>
                                <p class="text-xs md:text-sm text-gray-500 group-hover:text-blue-700">Créer un nouveau produit</p>
                            </div>
                        </a>

                        <a href="{{ route('products.index') }}" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-all duration-200">
                            <div class="dashboard-icon dashboard-icon-sm bg-green-100 group-hover:bg-green-200 transition-colors">
                                <svg class="text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="ml-3 md:ml-4">
                                <h4 class="font-medium text-gray-900 group-hover:text-green-900 text-sm md:text-base">Gérer les produits</h4>
                                <p class="text-xs md:text-sm text-gray-500 group-hover:text-green-700">Voir tous vos produits</p>
                            </div>
                        </a>

                        <a href="#" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-300 transition-all duration-200">
                            <div class="dashboard-icon dashboard-icon-sm bg-purple-100 group-hover:bg-purple-200 transition-colors">
                                <svg class="text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="ml-3 md:ml-4">
                                <h4 class="font-medium text-gray-900 group-hover:text-purple-900 text-sm md:text-base">Voir les statistiques</h4>
                                <p class="text-xs md:text-sm text-gray-500 group-hover:text-purple-700">Analyser vos ventes</p>
                            </div>
                        </a>
                </div>
            </x-dashboard.section>
        </div>
    </div>
</x-app-layout> 