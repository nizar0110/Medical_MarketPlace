<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Icons Demo') }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Introduction -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">🎨 Dashboard Icons Styling Demo</h1>
                <p class="text-gray-600 mb-4">
                    Cette page démontre tous les styles d'icônes améliorés pour le dashboard. 
                    Les icônes sont maintenant uniformes, responsives et avec un design moderne.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-check-circle mr-1"></i>Responsive
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>Bootstrap-like
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        <i class="fas fa-check-circle mr-1"></i>Modern Design
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-check-circle mr-1"></i>Hover Effects
                    </span>
                </div>
            </div>

            <!-- Icon Variants Demo -->
            <x-dashboard.icon-demo title="Variantes de Couleurs" :show-variants="true" :show-sizes="false" :show-animations="false" />

            <!-- Icon Sizes Demo -->
            <x-dashboard.icon-demo title="Tailles d'Icônes" :show-variants="false" :show-sizes="true" :show-animations="false" />

            <!-- Icon Animations Demo -->
            <x-dashboard.icon-demo title="Animations d'Icônes" :show-variants="false" :show-sizes="false" :show-animations="true" />

            <!-- Real Dashboard Examples -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Exemples du Dashboard Réel</h3>
                
                <!-- Stat Cards Example -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="dashboard-card border border-gray-200">
                        <div class="dashboard-card-content">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="dashboard-icon icon-blue">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="dashboard-label truncate">Total Produits</dt>
                                        <dd class="text-xl md:text-2xl font-bold text-gray-900">42</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-card border border-gray-200">
                        <div class="dashboard-card-content">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="dashboard-icon icon-green">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="dashboard-label truncate">Chiffre d'affaires</dt>
                                        <dd class="text-xl md:text-2xl font-bold text-gray-900">15,420 DH</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-card border border-gray-200">
                        <div class="dashboard-card-content">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="dashboard-icon icon-yellow">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="dashboard-label truncate">Total Commandes</dt>
                                        <dd class="text-xl md:text-2xl font-bold text-gray-900">28</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-card border border-gray-200">
                        <div class="dashboard-card-content">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="dashboard-icon icon-purple">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="dashboard-label truncate">Revenus du mois</dt>
                                        <dd class="text-xl md:text-2xl font-bold text-gray-900">8,750 DH</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Example -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                    <a href="#" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-all duration-200">
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

                    <a href="#" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-all duration-200">
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
            </div>

            <!-- Usage Instructions -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-900 mb-3">📚 Comment Utiliser</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-blue-800 mb-2">Classes CSS Principales</h4>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li><code class="bg-blue-100 px-1 rounded">.dashboard-icon</code> - Style de base</li>
                            <li><code class="bg-blue-100 px-1 rounded">.dashboard-icon-sm</code> - Petite taille (40px)</li>
                            <li><code class="bg-blue-100 px-1 rounded">.dashboard-icon-lg</code> - Grande taille (60px)</li>
                            <li><code class="bg-blue-100 px-1 rounded">.dashboard-icon-xl</code> - Très grande (80px)</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-medium text-blue-800 mb-2">Variantes de Couleurs</h4>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li><code class="bg-blue-100 px-1 rounded">.icon-blue</code> - Bleu</li>
                            <li><code class="bg-blue-100 px-1 rounded">.icon-green</code> - Vert</li>
                            <li><code class="bg-blue-100 px-1 rounded">.icon-yellow</code> - Jaune</li>
                            <li><code class="bg-blue-100 px-1 rounded">.icon-purple</code> - Violet</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Back to Dashboard -->
            <div class="text-center mt-8">
                <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour au Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
