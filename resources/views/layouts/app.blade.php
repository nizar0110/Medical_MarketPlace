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
