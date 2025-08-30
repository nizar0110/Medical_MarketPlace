<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .logo-container {
                display: inline-block;
                padding: 12px;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-radius: 20px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .logo-container:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            }
            
            .logo-image {
                border-radius: 15px;
                transition: transform 0.3s ease;
            }
            
            .logo-container:hover .logo-image {
                transform: scale(1.05);
            }
            
            .text-primary {
                color: #0d6efd !important;
            }
            
            .fw-bold {
                font-weight: 700 !important;
            }
            
            .mt-n2 {
                margin-top: -0.5rem !important;
            }
            
            .form-container {
                margin-top: -1rem;
            }
        </style>
    </head>
    <body class="bg-light">
        <div class="min-vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <!-- Logo centré avec meilleur style -->
                        <div class="text-center mb-3">
                            <a href="/" class="text-decoration-none">
                                <div class="logo-container mb-2">
                                    <img src="{{ asset('logo.png') }}" alt="Logo Medical Marketplace" width="80" height="80" class="logo-image">
                                </div>
                                <h3 class="text-dark fw-bold mb-1">MEDICAL</h3>
                                <h5 class="text-primary fw-bold mb-0">MARKETPLACE</h5>
                            </a>
                        </div>
                        
                        <div class="form-container">
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
