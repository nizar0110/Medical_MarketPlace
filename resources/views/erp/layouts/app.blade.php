<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - ERP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin: 0.25rem 0;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .top-navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .stats-card {
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white mb-0">
                            <i class="fas fa-cogs me-2"></i>
                            ERP
                        </h4>
                        <small class="text-white-50">Medical Marketplace</small>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link {{ request()->routeIs('erp.dashboard') ? 'active' : '' }}" href="{{ route('erp.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            Tableau de Bord
                        </a>
                        
                        @if(auth()->user()->role === 'warehouse_manager' || auth()->user()->role === 'admin')
                        <div class="mt-3">
                            <small class="text-white-50 text-uppercase">Inventaire</small>
                            <a class="nav-link" href="{{ route('erp.inventory.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Tableau de Bord
                            </a>
                            <a class="nav-link" href="{{ route('erp.inventory.warehouses.index') }}">
                                <i class="fas fa-warehouse"></i>
                                Entrepôts
                            </a>
                            <a class="nav-link" href="{{ route('erp.inventory.movements.index') }}">
                                <i class="fas fa-exchange-alt"></i>
                                Mouvements
                            </a>
                        </div>
                        @endif
                        
                        @if(auth()->user()->role === 'accountant' || auth()->user()->role === 'admin')
                        <div class="mt-3">
                            <small class="text-white-50 text-uppercase">Comptabilité</small>
                            <a class="nav-link" href="#">
                                <i class="fas fa-book"></i>
                                Plan Comptable
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fas fa-journal-whills"></i>
                                Écritures
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fas fa-credit-card"></i>
                                Paiements
                            </a>
                        </div>
                        @endif
                        
                        @if(auth()->user()->role === 'buyer' || auth()->user()->role === 'admin')
                        <div class="mt-3">
                            <small class="text-white-50 text-uppercase">Achats</small>
                            <a class="nav-link" href="#">
                                <i class="fas fa-truck"></i>
                                Fournisseurs
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fas fa-shopping-cart"></i>
                                Commandes
                            </a>
                        </div>
                        @endif
                        
                        @if(auth()->user()->role === 'sales_manager' || auth()->user()->role === 'admin')
                        <div class="mt-3">
                            <small class="text-white-50 text-uppercase">Ventes</small>
                            <a class="nav-link" href="#">
                                <i class="fas fa-users"></i>
                                Clients
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fas fa-file-invoice"></i>
                                Devis
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fas fa-receipt"></i>
                                Factures
                            </a>
                        </div>
                        @endif
                        
                        <div class="mt-4 pt-3 border-top border-white-25">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-arrow-left"></i>
                                Retour Marketplace
                            </a>
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-cog"></i>
                                Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0">
                <div class="main-content">
                    <!-- Top Navbar -->
                    <nav class="top-navbar p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">{{ $stats['title'] ?? 'ERP Dashboard' }}</h5>
                                <small class="text-muted">Bienvenue, {{ auth()->user()->name }}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success me-2">
                                    <i class="fas fa-circle me-1"></i>
                                    En ligne
                                </span>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user me-1"></i>
                                        {{ auth()->user()->name }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Marketplace</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Déconnexion</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Page Content -->
                    <div class="p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Erreur de validation:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 