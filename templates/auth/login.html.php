<div class="bg-white rounded-2xl mt-6 shadow-2xl overflow-hidden max-w-4xl mx-auto">
    <div class="md:flex">
        <div class="md:w-1/2 bg-gradient-to-br from-maxitsa-orange to-orange-600 p-12 text-white flex flex-col justify-center">
            <div class="text-center">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-white text-3xl font-bold">M</span>
                </div>
                <h1 class="text-4xl font-bold mb-4">MAXITSA</h1>
                <p class="text-xl opacity-90 mb-8">Système de Transfert et de Paiement</p>
                <div class="space-y-4 text-left">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Transferts rapides et sécurisés</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Paiements en ligne simplifiés</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Gestion multi-comptes</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="md:w-1/2 p-12">
            <div class="max-w-md mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Connexion</h2>
                <p class="text-gray-600 mb-8">Accédez à votre espace personnel</p>
                
                <div id="message" class="hidden mb-6 p-4 rounded-lg" data-alert>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span id="message-text"></span>
                    </div>
                </div>
                
                <form method="POST" action="/" class="space-y-6">
                    <input type="hidden" name="csrf_token" value="">
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Numéro de téléphone</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="login" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maxitsa-orange focus:border-transparent transition-colors"
                                placeholder="Entrez votre numéro de téléphone"
                            >
                        </div>
                        <p id="telephone-error" class="text-red-500 text-sm mt-1 hidden"></p>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maxitsa-orange focus:border-transparent transition-colors"
                                placeholder="Entrez votre mot de passe"
                            >
                        </div>
                        <p id="password-error" class="text-red-500 text-sm mt-1 hidden"></p>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-maxitsa-orange focus:ring-maxitsa-orange">
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                        <a href="#" class="text-sm text-maxitsa-orange hover:underline">Mot de passe oublié ?</a>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-maxitsa-orange text-white py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-colors transform hover:scale-105"
                    >
                        Se connecter
                    </button>
                    
                    <div class="text-center pt-4 border-t border-gray-200">
                        <span class="text-gray-600">Nouveau client ? </span>
                        <a href="/register" class="text-maxitsa-orange font-semibold hover:underline">Créer un compte</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

