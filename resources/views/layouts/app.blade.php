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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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

        <!-- Widget Chatbot Flottant -->
        <div id="chatbot-widget" class="fixed bottom-4 right-4 z-50">
            <!-- Bouton du chatbot -->
            <button id="chatbot-toggle" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </button>

            <!-- Fenêtre du chatbot -->
            <div id="chatbot-window" class="hidden absolute bottom-16 right-0 w-80 bg-white rounded-lg shadow-xl border">
                <!-- En-tête -->
                <div class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium">Assistant Virtuel</h3>
                                <p class="text-sm opacity-90">En ligne</p>
                            </div>
                        </div>
                        <button id="chatbot-close" class="text-white hover:text-gray-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Messages -->
                <div id="chatbot-messages" class="h-64 overflow-y-auto p-4 space-y-3">
                    <div class="flex items-start space-x-2">
                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-2 max-w-xs">
                            <p class="text-sm text-gray-800">Bonjour ! Comment puis-je vous aider ?</p>
                        </div>
                    </div>
                </div>

                <!-- Suggestions rapides -->
                <div class="p-3 border-t bg-gray-50">
                    <div class="flex flex-wrap gap-1 mb-2">
                        <button onclick="sendQuickMessage('produits')" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs px-2 py-1 rounded-full">
                            Produits
                        </button>
                        <button onclick="sendQuickMessage('livraison')" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs px-2 py-1 rounded-full">
                            Livraison
                        </button>
                        <button onclick="sendQuickMessage('contact')" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs px-2 py-1 rounded-full">
                            Contact
                        </button>
                    </div>
                </div>

                <!-- Saisie -->
                <div class="p-3 border-t">
                    <form id="chatbot-form" class="flex space-x-2">
                        <input type="text" id="chatbot-input" placeholder="Tapez votre message..." 
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Gestion du widget chatbot
            const chatbotToggle = document.getElementById('chatbot-toggle');
            const chatbotWindow = document.getElementById('chatbot-window');
            const chatbotClose = document.getElementById('chatbot-close');
            const chatbotForm = document.getElementById('chatbot-form');
            const chatbotInput = document.getElementById('chatbot-input');
            const chatbotMessages = document.getElementById('chatbot-messages');

            // Ouvrir/fermer le chatbot
            chatbotToggle.addEventListener('click', () => {
                chatbotWindow.classList.toggle('hidden');
            });

            chatbotClose.addEventListener('click', () => {
                chatbotWindow.classList.add('hidden');
            });

            // Envoyer un message rapide
            function sendQuickMessage(message) {
                chatbotInput.value = message;
                sendChatbotMessage();
            }

            // Envoyer le message
            function sendChatbotMessage() {
                const message = chatbotInput.value.trim();
                if (!message) return;

                // Ajouter le message utilisateur
                addChatbotMessage(message, 'user');
                chatbotInput.value = '';

                // Envoyer au serveur
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
                    addChatbotMessage(data.response, 'bot');
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    addChatbotMessage('Désolé, une erreur s\'est produite.', 'bot');
                });
            }

            // Ajouter un message au chatbot
            function addChatbotMessage(content, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = 'flex items-start space-x-2';
                
                if (sender === 'user') {
                    messageDiv.innerHTML = `
                        <div class="flex-1"></div>
                        <div class="bg-blue-600 text-white rounded-lg p-2 max-w-xs">
                            <p class="text-sm">${content}</p>
                        </div>
                        <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    `;
                } else {
                    messageDiv.innerHTML = `
                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-2 max-w-xs">
                            <div class="text-sm text-gray-800">${content}</div>
                        </div>
                    `;
                }
                
                chatbotMessages.appendChild(messageDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }

            // Gestion du formulaire
            chatbotForm.addEventListener('submit', function(e) {
                e.preventDefault();
                sendChatbotMessage();
            });
        </script>
    </body>
</html>
