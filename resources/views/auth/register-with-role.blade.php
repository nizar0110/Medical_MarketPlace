<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">
            {{ __('Inscription') }}
        </h2>
        <p class="text-sm text-gray-600">
            {{ __('Choisissez votre type de compte') }}
        </p>
    </div>

    <form method="POST" action="{{ route('register.with.role') }}">
        @csrf

        <!-- Role Selection -->
        <div class="mb-6">
            <x-input-label for="role" :value="__('Type de compte')" />
            <div class="mt-3 grid grid-cols-1 gap-3">
                <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 shadow-sm focus:outline-none hover:border-indigo-500">
                    <input type="radio" name="role" value="client" class="sr-only" {{ old('role') == 'client' ? 'checked' : '' }} required>
                    <span class="flex flex-1">
                        <span class="flex flex-col">
                            <span class="block text-sm font-medium text-gray-900">Client</span>
                            <span class="mt-1 flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Achetez des produits médicaux
                            </span>
                        </span>
                    </span>
                    <svg class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </label>
                
                <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 shadow-sm focus:outline-none hover:border-indigo-500">
                    <input type="radio" name="role" value="seller" class="sr-only" {{ old('role') == 'seller' ? 'checked' : '' }} required>
                    <span class="flex flex-1">
                        <span class="flex flex-col">
                            <span class="block text-sm font-medium text-gray-900">Vendeur</span>
                            <span class="mt-1 flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Vendez vos produits médicaux
                            </span>
                        </span>
                    </span>
                    <svg class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Adresse email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Numéro de téléphone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Adresse')" />
            <textarea id="address" name="address" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('address') }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà inscrit?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Amélioration de l'interaction avec les boutons radio
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[name="role"]');
            const labels = document.querySelectorAll('label[class*="cursor-pointer"]');
            
            radioButtons.forEach((radio, index) => {
                radio.addEventListener('change', function() {
                    // Retirer la sélection de tous les labels
                    labels.forEach(label => {
                        label.classList.remove('border-indigo-500', 'bg-indigo-50');
                        label.classList.add('border-gray-300', 'bg-white');
                    });
                    
                    // Ajouter la sélection au label sélectionné
                    if (this.checked) {
                        labels[index].classList.remove('border-gray-300', 'bg-white');
                        labels[index].classList.add('border-indigo-500', 'bg-indigo-50');
                    }
                });
            });
            
            // Initialiser l'état si une valeur est déjà sélectionnée
            const checkedRadio = document.querySelector('input[name="role"]:checked');
            if (checkedRadio) {
                const index = Array.from(radioButtons).indexOf(checkedRadio);
                labels[index].classList.remove('border-gray-300', 'bg-white');
                labels[index].classList.add('border-indigo-500', 'bg-indigo-50');
            }
        });
    </script>
</x-guest-layout> 