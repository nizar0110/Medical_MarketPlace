<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo et nom du site -->
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" width="40" height="40" class="me-2">
            <span class="fs-4 fw-semibold text-dark">Medical Marketplace</span>
        </a>

        <!-- Barre de recherche -->
        <form action="{{ route('products.index') }}" method="GET" class="d-none d-md-flex mx-auto" style="max-width: 400px;">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un produit..." class="form-control">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <!-- Bouton toggle pour mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
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
            </ul>

            <!-- Menu utilisateur (toujours présent mais réduit) -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
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
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Sign In
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
