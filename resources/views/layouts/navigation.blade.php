<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
    <div class="container-fluid px-4">
        <div class="row w-100 align-items-center flex-nowrap">
            <!-- Logo et nom du site -->
            <div class="col-auto d-flex align-items-center">
                <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center me-4">
                    <img src="{{ asset('logo.png') }}" alt="Logo" width="40" height="40" class="me-2">
                    <span class="fs-4 fw-semibold text-dark">Medical Marketplace</span>
                </a>
            </div>
            <!-- Barre de recherche -->
            <div class="col flex-grow-1">
                <form action="{{ route('products.index') }}" method="GET" class="d-none d-md-flex mx-4" style="min-width: 350px; max-width: 500px;">
                    <div class="input-group w-100">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un produit..." class="form-control" style="min-width: 0;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Actions à droite -->
            <div class="col-auto">
                <div class="d-flex align-items-center gap-2">
                    <ul class="navbar-nav flex-row align-items-center gap-2 mb-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <i class="fas fa-pills me-1"></i>Produits
                            </a>
                        </li>
                        @auth
                            @if(Auth::user()->role === 'client')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cart.index') }}">
                                        <i class="fas fa-shopping-cart me-1"></i>Panier
                                    </a>
                                </li>
                            @endif
                            <!-- Dashboard direct dans la navbar -->
                            <li class="nav-item">
                                @if(Auth::user()->role === 'admin')
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard Admin
                                    </a>
                                @elseif(Auth::user()->role === 'seller')
                                    <a class="nav-link" href="{{ route('seller.dashboard') }}">
                                        <i class="fas fa-store me-1"></i>Dashboard Vendeur
                                    </a>
                                @elseif(Auth::user()->role === 'client')
                                    <a class="nav-link" href="{{ route('client.dashboard') }}">
                                        <i class="fas fa-user-circle me-1"></i>Dashboard Client
                                    </a>
                                @endif
                            </li>
                            <!-- Sign Out direct dans la navbar -->
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link" style="padding: 0;">
                                        <i class="fas fa-sign-out-alt me-1"></i>Sign Out
                                    </button>
                                </form>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="document.getElementById('chatbot-toggle').click(); return false;">
                                <i class="fas fa-robot me-1"></i>Assistant
                            </a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary px-3 ms-2" href="{{ route('login') }}" style="border-radius: 20px;">
                                    <i class="fas fa-sign-in-alt me-1"></i>Connexion
                                </a>
                            </li>
                        @endguest
                    </ul>
                    @auth
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
                                    </a></li>
                                @elseif(Auth::user()->role === 'seller')
                                    <li><a class="dropdown-item" href="{{ route('seller.dashboard') }}">
                                        <i class="fas fa-store me-2"></i>Dashboard Vendeur
                                    </a></li>
                                @elseif(Auth::user()->role === 'client')
                                    <li><a class="dropdown-item" href="{{ route('client.dashboard') }}">
                                        <i class="fas fa-user-circle me-2"></i>Dashboard Client
                                    </a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
