<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assistant Virtuel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- En-tête du chatbot -->
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Assistant Virtuel Medical Marketplace</h1>
                        <p class="text-gray-600">Posez-moi vos questions sur nos produits et services</p>
                    </div>

                    <!-- Zone de chat -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6" style="height: 400px; overflow-y: auto;" id="chatContainer">
                        <div class="space-y-4" id="chatMessages">
                            <!-- Message de bienvenue -->
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div class="bg-white rounded-lg p-3 shadow-sm max-w-xs lg:max-w-md">
                                    <p class="text-sm text-gray-800">Bonjour ! Je suis l'assistant virtuel de Medical Marketplace. Comment puis-je vous aider ?</p>
                                    <p class="text-xs text-gray-500 mt-1">Maintenant</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Suggestions rapides -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Questions rapides :</h3>
                        <div class="flex flex-wrap gap-2">
                            <button onclick="sendQuickMessage('bonjour')" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm px-3 py-2 rounded-full transition-colors">
                                Bonjour
                            </button>
                            <button onclick="sendQuickMessage('produits')" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm px-3 py-2 rounded-full transition-colors">
                                Produits
                            </button>
                            <button onclick="sendQuickMessage('livraison')" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm px-3 py-2 rounded-full transition-colors">
                                Livraison
                            </button>
                            <button onclick="sendQuickMessage('commande')" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm px-3 py-2 rounded-full transition-colors">
                                Commander
                            </button>
                            <button onclick="sendQuickMessage('contact')" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm px-3 py-2 rounded-full transition-colors">
                                Contact
                            </button>
                        </div>
                    </div>

                    <!-- Formulaire de saisie -->
                    <form id="chatForm" class="flex space-x-4">
                        @csrf
                        <input type="text" id="messageInput" name="message" 
                               placeholder="Tapez votre message..." 
                               class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            Envoyer
                        </button>
                    </form>

                    <!-- Informations utiles -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <h3 class="font-medium text-blue-900">Produits</h3>
                            </div>
                            <p class="text-sm text-blue-700">Découvrez notre large gamme de produits médicaux</p>
                        </div>
                        
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <h3 class="font-medium text-green-900">Livraison</h3>
                            </div>
                            <p class="text-sm text-green-700">Livraison gratuite dès 100€ d'achat</p>
                        </div>
                        
                        <div class="bg-purple-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <h3 class="font-medium text-purple-900">Support</h3>
                            </div>
                            <p class="text-sm text-purple-700">Assistance 24/7 par notre équipe</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        const chatMessages = document.getElementById('chatMessages');
        const chatContainer = document.getElementById('chatContainer');

        // Envoyer un message rapide
        function sendQuickMessage(message) {
            messageInput.value = message;
            sendMessage();
        }

        // Envoyer le message
        function sendMessage() {
            const message = messageInput.value.trim();
            if (!message) return;

            // Ajouter le message utilisateur
            addMessage(message, 'user');
            messageInput.value = '';

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
                addMessage(data.response, 'bot', data.timestamp);
            })
            .catch(error => {
                console.error('Erreur:', error);
                addMessage('Désolé, une erreur s\'est produite. Veuillez réessayer.', 'bot');
            });
        }

        // Ajouter un message à la conversation
        function addMessage(content, sender, timestamp = null) {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'flex items-start space-x-3';
            
            if (sender === 'user') {
                messageDiv.innerHTML = `
                    <div class="flex-1"></div>
                    <div class="bg-blue-600 text-white rounded-lg p-3 shadow-sm max-w-xs lg:max-w-md">
                        <p class="text-sm">${content}</p>
                        <p class="text-xs opacity-75 mt-1">${timestamp || 'Maintenant'}</p>
                    </div>
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm max-w-xs lg:max-w-md">
                        <div class="text-sm text-gray-800">${content}</div>
                        <p class="text-xs text-gray-500 mt-1">${timestamp || 'Maintenant'}</p>
                    </div>
                `;
            }
            
            chatMessages.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Gestion du formulaire
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });

        // Focus sur l'input au chargement
        messageInput.focus();
    </script>
</x-app-layout> 