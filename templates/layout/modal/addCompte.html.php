<div id="add-account-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Ajouter un compte secondaire</h3>
            <button onclick="closeAddAccountModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <form id="add-account-form" method="POST" action="add-secondary-account">
            <div class="mb-4">
                <label for="numero-telephone" class="block text-sm font-medium text-gray-700 mb-2">
                    Numéro de téléphone <span class="text-red-500">*</span>
                </label>
                <input type="tel"
                    id="telephone"
                    name="telephone"
                    placeholder="Ex: 77 123 45 67"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>

            <div class="mb-6">
                <label for="montant-initial" class="block text-sm font-medium text-gray-700 mb-2">
                    Montant initial (optionnel)
                </label>
                <div class="relative">
                    <input type="number"
                        id="montant-initial"
                        name="montant_initial"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <span class="absolute right-3 top-2 text-gray-500">CFA</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Laissez vide pour créer un compte avec un solde de 0 CFA</p>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <button type="button"
                    onclick="closeAddAccountModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 rounded-lg transition-colors">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Créer le compte
                </button>
            </div>
        </form>
    </div>
</div>