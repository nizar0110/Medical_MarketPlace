<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Sélecteur de période -->
            <div class="mb-4 flex justify-between items-center bg-white p-4 rounded-lg shadow-sm">
                <select id="period-selector" class="dashboard-action-button border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
                    <option value="day">Aujourd'hui</option>
                    <option value="week">Cette semaine</option>
                    <option value="month" selected>Ce mois</option>
                    <option value="year">Cette année</option>
                </select>

                <div class="flex space-x-2">
                    <button onclick="window.location.href='{{ route('admin.dashboard') }}'" class="dashboard-action-button bg-blue-500 hover:bg-blue-600 text-white">
                        <i class="fas fa-sync-alt mr-1"></i> Actualiser
                    </button>
                    <button onclick="exportData()" class="dashboard-action-button bg-green-500 hover:bg-green-600 text-white">
                        <i class="fas fa-download mr-1"></i> Exporter
                    </button>
                </div>
            </div>

            <!-- Statistiques générales -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 dashboard-grid">
                <!-- Card Utilisateurs -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg transition-transform duration-500 hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-blue-100 bg-opacity-75">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Utilisateurs</dt>
                                    <dd id="stats-users" class="text-lg font-bold text-gray-900">{{ $usersCount ?? 0 }}</dd>
                                    <dd class="text-sm text-gray-600">Total des utilisateurs</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                Voir les détails
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Produits -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg transition-transform duration-500 hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-green-100 bg-opacity-75">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Produits</dt>
                                    <dd id="stats-products" class="text-lg font-bold text-gray-900">{{ $productsCount ?? 0 }}</dd>
                                    <dd class="text-sm text-gray-600">Catalogue total</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('products.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                                Gérer les produits
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Commandes -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg transition-transform duration-500 hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-yellow-100 bg-opacity-75">
                                <svg class="h-5 w-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Commandes</dt>
                                    <dd id="stats-orders" class="text-lg font-bold text-gray-900">{{ $ordersCount ?? 0 }}</dd>
                                    <dd class="text-sm text-gray-600">Total des commandes</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium flex items-center">
                                Voir les commandes
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Revenus -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg transition-transform duration-500 hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-purple-100 bg-opacity-75">
                                <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Revenus</dt>
                                    <dd id="stats-revenue" class="text-lg font-bold text-gray-900">{{ number_format($revenue ?? 0, 2) }} €</dd>
                                    <dd class="text-sm text-gray-600">Chiffre d'affaires total</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center">
                                Voir les détails
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white overflow-hidden shadow-xl rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Actions rapides
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="#" class="transform transition-all duration-300 hover:scale-105">
                            <div class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                                <div class="p-2 rounded-full bg-blue-100">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Gérer les utilisateurs</h4>
                                    <p class="text-sm text-gray-500">Voir tous les utilisateurs</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="{{ route('products.index') }}" class="transform transition-all duration-300 hover:scale-105">
                            <div class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100">
                                <div class="p-3 rounded-full bg-green-100">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Gérer les produits</h4>
                                    <p class="text-sm text-gray-500">Voir tous les produits</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#" class="transform transition-all duration-300 hover:scale-105">
                            <div class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100">
                                <div class="p-3 rounded-full bg-yellow-100">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Gérer les commandes</h4>
                                    <p class="text-sm text-gray-500">Voir toutes les commandes</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#" class="transform transition-all duration-300 hover:scale-105">
                            <div class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100">
                                <div class="p-3 rounded-full bg-purple-100">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Statistiques</h4>
                                    <p class="text-sm text-gray-500">Voir les analyses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Utilisateurs récents -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Utilisateurs récents
                            </h3>
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Voir tout</a>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($recentUsers ?? [] as $user)
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $user->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-400">Inscrit le {{ $user->created_at->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($user->role === 'admin') bg-red-100 text-red-800
                                            @elseif($user->role === 'seller') bg-blue-100 text-blue-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun utilisateur</h3>
                                    <p class="mt-1 text-sm text-gray-500">Commencez par créer un nouvel utilisateur.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Commandes récentes -->
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Commandes récentes
                            </h3>
                            <a href="#" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">Voir tout</a>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($recentOrders ?? [] as $order)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div>
                                        <h4 class="font-medium text-gray-900">Commande #{{ $order->id }}</h4>
                                        <p class="text-sm text-gray-500">{{ $order->user->name ?? 'Utilisateur supprimé' }}</p>
                                        <p class="text-xs text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                        <p class="text-sm font-medium text-gray-900">{{ number_format($order->total, 2) }} €</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'shipped') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune commande</h3>
                                    <p class="mt-1 text-sm text-gray-500">Les commandes apparaîtront ici.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques et statistiques -->
            <div class="mt-8 bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Statistiques du mois
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center p-6 bg-indigo-50 rounded-lg">
                            <div class="text-3xl font-bold text-indigo-600">{{ $monthlyOrders ?? 0 }}</div>
                            <div class="text-sm text-gray-500">Commandes ce mois</div>
                        </div>
                        <div class="text-center p-6 bg-green-50 rounded-lg">
                            <div class="text-3xl font-bold text-green-600">{{ number_format($monthlyRevenue ?? 0, 2) }} €</div>
                            <div class="text-sm text-gray-500">Revenus ce mois</div>
                        </div>
                        <div class="text-center p-6 bg-purple-50 rounded-lg">
                            <div class="text-3xl font-bold text-purple-600">{{ $monthlyUsers ?? 0 }}</div>
                            <div class="text-sm text-gray-500">Nouveaux utilisateurs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
    <script>
        function exportData() {
            // Implement export functionality
            alert('Fonctionnalité d\'export en cours de développement');
        }
    </script>
    @endpush
</x-app-layout>