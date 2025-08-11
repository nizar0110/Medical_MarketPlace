<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard-icons.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    <div class="bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </main>
    </div>

    <!-- Footer Professionnel -->
    <footer class="bg-dark text-white">
        <!-- Section principale du footer -->
        <div class="container py-5">
            <div class="row">
                <!-- À propos de Medical Market -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-heartbeat me-2 text-primary"></i>
                        Medical Market
                    </h5>
                    <p class="text-white mb-3">
                        Votre plateforme de confiance pour tous vos besoins médicaux. 
                        Nous proposons une large gamme de produits médicaux de qualité 
                        auprès de fournisseurs certifiés et agréés par le ministère de la santé.
                    </p>
                    <div class="mb-3">
                        <span class="badge bg-success me-2">
                            <i class="fas fa-certificate me-1"></i>Certifié ISO 13485
                        </span>
                        <span class="badge bg-info me-2">
                            <i class="fas fa-shield-alt me-1"></i>Agréé Ministère Santé
                        </span>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="https://facebook.com/medicalmarket" target="_blank" class="text-white text-decoration-none" title="Suivez-nous sur Facebook">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="https://twitter.com/medicalmarket" target="_blank" class="text-white text-decoration-none" title="Suivez-nous sur Twitter">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="https://linkedin.com/company/medicalmarket" target="_blank" class="text-white text-decoration-none" title="Suivez-nous sur LinkedIn">
                            <i class="fab fa-linkedin-in fa-lg"></i>
                        </a>
                        <a href="https://instagram.com/medicalmarket" target="_blank" class="text-white text-decoration-none" title="Suivez-nous sur Instagram">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="https://youtube.com/medicalmarket" target="_blank" class="text-white text-decoration-none" title="Regardez nos vidéos">
                            <i class="fab fa-youtube fa-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Liens rapides -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Liens Rapides</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/" class="text-white text-decoration-none">
                                <i class="fas fa-home me-2"></i>Accueil
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/produits" class="text-white text-decoration-none">
                                <i class="fas fa-pills me-2"></i>Catalogue Produits
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/assistant" class="text-white text-decoration-none">
                                <i class="fas fa-robot me-2"></i>Assistant IA
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/categories" class="text-white text-decoration-none">
                                <i class="fas fa-th-large me-2"></i>Catégories
                            </a>
                        </li>
                       
                      
                    </ul>
                </div>

                <!-- Services -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Services</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/livraison" class="text-white text-decoration-none">
                                <i class="fas fa-shipping-fast me-2"></i>Livraison Express
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/garantie" class="text-white text-decoration-none">
                                <i class="fas fa-shield-alt me-2"></i>Garantie 2 Ans
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/retours" class="text-white text-decoration-none">
                                <i class="fas fa-undo me-2"></i>Retours 30 Jours
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/support" class="text-white text-decoration-none">
                                <i class="fas fa-headset me-2"></i>Support 24/7
                            </a>
                        </li>
                     
                       
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Contact & Informations</h6>
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <span class="text-white">123 Rue de la Santé, Quartier Maarif, Casablanca 20000, Maroc</span>
                    </div>
                   
                    <div class="mb-3">
                        <i class="fas fa-mobile-alt me-2 text-primary"></i>
                        <span class="text-white">+212 6 12 345 678</span>
                    </div>
                   
                    <div class="mb-3">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <span class="text-white">support@medicalmarket.ma</span>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        <span class="text-white">Lun-Ven: 8h-18h, Sam: 9h-16h, Dim: Fermé</span>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-globe me-2 text-primary"></i>
                        <span class="text-white">www.medicalmarket.ma</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section inférieure du footer -->
        <div class="border-top border-secondary">
            <div class="container py-3">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 text-white">
                            © 2025 Medical Market SARL. Tous droits réservés. | RC: 123456 | ICE: 123456789 | CNSS: 123456789
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="d-flex justify-content-center justify-content-md-end gap-3">
                            <a href="/politique-confidentialite" class="text-white text-decoration-none small">
                                Politique de confidentialité
                            </a>
                            <a href="/conditions-utilisation" class="text-white text-decoration-none small">
                                Conditions d'utilisation
                            </a>
                            <a href="/mentions-legales" class="text-white text-decoration-none small">
                                Mentions légales
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Widget Chatbot Flottant -->
    <div id="chatbot-widget" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <button id="chatbot-toggle" class="btn btn-primary rounded-circle p-3 shadow">
            <i class="fas fa-comments fa-lg"></i>
        </button>
        
        <div id="chatbot-window" class="card shadow-lg" style="width: 350px; display: none; position: absolute; bottom: 70px; right: 0;">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-robot me-2"></i>Assistant Médical</h6>
                <button id="chatbot-close" class="btn-close btn-close-white"></button>
            </div>
            <div class="card-body" style="height: 300px; overflow-y: auto;">
                <div id="chatbot-messages">
                    <div class="d-flex mb-2">
                        <div class="bg-light rounded p-2">
                            <small class="text-muted">Bonjour ! Je suis votre assistant médical. Comment puis-je vous aider ?</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <input type="text" id="chatbot-input" class="form-control" placeholder="Tapez votre message...">
                    <button id="chatbot-send" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Chatbot functionality
        document.addEventListener('DOMContentLoaded', function() {
            const chatbotToggle = document.getElementById('chatbot-toggle');
            const chatbotWindow = document.getElementById('chatbot-window');
            const chatbotClose = document.getElementById('chatbot-close');
            const chatbotInput = document.getElementById('chatbot-input');
            const chatbotSend = document.getElementById('chatbot-send');
            const chatbotMessages = document.getElementById('chatbot-messages');

            chatbotToggle.addEventListener('click', function() {
                chatbotWindow.style.display = chatbotWindow.style.display === 'none' ? 'block' : 'none';
            });

            chatbotClose.addEventListener('click', function() {
                chatbotWindow.style.display = 'none';
            });

            function addMessage(message, isUser = false) {
                const messageDiv = document.createElement('div');
                messageDiv.className = 'd-flex mb-2 ' + (isUser ? 'justify-content-end' : '');
                
                const messageContent = document.createElement('div');
                messageContent.className = isUser ? 'bg-primary text-white rounded p-2' : 'bg-light rounded p-2';
                messageContent.innerHTML = '<small>' + message + '</small>';
                
                messageDiv.appendChild(messageContent);
                chatbotMessages.appendChild(messageDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }

            function sendMessage() {
                const message = chatbotInput.value.trim();
                if (message) {
                    addMessage(message, true);
                    chatbotInput.value = '';

                    // Send to backend
                    fetch('/chatbot/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ message: message })
                    })
                    .then(response => response.json())
                    .then(data => {
                        addMessage(data.response);
                    })
                    .catch(error => {
                        addMessage('Désolé, une erreur est survenue.');
                    });
                }
            }

            chatbotSend.addEventListener('click', sendMessage);
            chatbotInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });
    </script>
</body>
</html>
