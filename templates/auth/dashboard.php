<?php

if (isset($success_message)) {
    echo "<script>alert('" . htmlspecialchars($success_message) . "');</script>";
}

?>
<!-- Welcome Section -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">
        <?= isset($user) ? htmlspecialchars($user->getNom()) : '' ?>
    </h2>
    <p class="text-gray-600">Bienvenue sur votre espace MAXITSA</p>
</div>

<!-- Account Card -->
<div class="bg-maxitsa-orange rounded-xl p-6 text-white mb-8">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                <span class="text-sm opacity-90">Compte Principal</span>
            </div>
            <p class="text-xs opacity-75 mb-1">MAXITSA-567890</p>
            <h3 class="text-3xl font-bold">
                <?= isset($solde) ? number_format($solde, 0, '', ' ') . ' CFA' : '0 CFA' ?>
            </h3>
        </div>
        <button class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-colors">
            Recharger
        </button>
    </div>
</div>

<!-- Action Buttons -->
<div class="grid grid-cols-3 gap-4 mb-8">
    <!-- <div onclick="openAddAccountModal()" class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow cursor-pointer">
        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <svg fill="none" height="24" stroke-width="1.5" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.2426 5.24268H19.2426M22.2426 5.24268H19.2426M19.2426 5.24268V2.24268M19.2426 5.24268V8.24268" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M18.1182 14.702L14 15.5C11.2183 14.1038 9.5 12.5 8.5 10L9.26995 5.8699L7.81452 2L4.0636 2C2.93605 2 2.04814 2.93178 2.21654 4.04668C2.63695 6.83 3.87653 11.8765 7.5 15.5C11.3052 19.3052 16.7857 20.9564 19.802 21.6127C20.9668 21.8662 22 20.9575 22 19.7655L22 16.1812L18.1182 14.702Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <h4 class="font-semibold text-gray-800 mb-1">compte secondaire</h4>
        <p class="text-sm text-gray-600">Ajouter un compte</p>
    </div> -->
    <div class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow cursor-pointer">
        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
        <h4 class="font-semibold text-gray-800 mb-1">Dépôt</h4>
        <p class="text-sm text-gray-600">Alimenter le compte</p>
    </div>

    <div class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow cursor-pointer">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
        </div>
        <h4 class="font-semibold text-gray-800 mb-1">Transfert</h4>
        <p class="text-sm text-gray-600">Envoyer de l'argent</p>
    </div>

    <div class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow cursor-pointer">
        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <h4 class="font-semibold text-gray-800 mb-1">Paiement</h4>
        <p class="text-sm text-gray-600">Payer une facture</p>
    </div>
</div>

<!-- Liste des comptes -->
<div class="bg-white rounded-xl p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Mes comptes</h3>
        <button onclick="openAddAccountModal()" class="text-maxitsa-orange hover:underline text-sm flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Ajouter un compte
        </button>
    </div>

    <div class="space-y-4">
        <!-- Compte Principal -->
        <?php if ($compte_principal): ?>
            <div class="flex items-center justify-between py-4 px-4 bg-gray-50 rounded-lg border-l-4 border-maxitsa-orange">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-maxitsa-orange rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Compte Principal</p>
                        <p class="text-sm text-gray-600"><?= htmlspecialchars($compte_principal['telephone']) ?></p>
                        <span class="inline-block bg-maxitsa-orange text-white text-xs px-2 py-1 rounded-full mt-1">Principal</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-lg text-gray-800">
                        <?= number_format($compte_principal['solde'], 0, '', ' ') ?> CFA
                    </p>
                    <p class="text-sm text-gray-500">Solde disponible</p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Comptes Secondaires -->
        <?php if (!empty($comptes_secondaires)): ?>
            <?php foreach ($comptes_secondaires as $compte): ?>
                <div class="flex items-center justify-between py-4 px-4 bg-gray-50 rounded-lg border-l-4 border-blue-400">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Compte Secondaire</p>
                            <p class="text-sm text-gray-600"><?= htmlspecialchars($compte['telephone']) ?></p>
                            <span class="inline-block bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full mt-1">Secondaire</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-lg text-gray-800">
                            <?= number_format($compte['solde'], 0, '', ' ') ?> CFA
                        </p>
                        <p class="text-sm text-gray-500">Solde disponible</p>
                        <div class="flex space-x-2 mt-1">
                            <form method="POST" action="/compteprincipal">
                                <input type="hidden" name="account_id" value="<?= $compte['id'] ?>">
    <button type="submit" class="text-xs text-gray-600 hover:text-maxitsa-orange">
        Définir comme principal
    </button>
</form>
                            <button class="text-xs text-gray-400 hover:text-red-500">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-8 text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <p class="text-lg mb-2">Aucun compte secondaire</p>
                <p class="text-sm">Ajoutez un compte secondaire pour gérer plusieurs numéros</p>
            </div>
        <?php endif; ?>
    </div>
</div>


<!-- Modal pour ajouter un compte secondaire -->
<div id="add-account-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Ajouter un compte secondaire</h3>
            <button onclick="closeAddAccountModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <form id="add-account-form" method="POST" action="/ajout-compte-secondaire">
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
    max="<?= isset($solde) ? $solde : 0 ?>"
    step="0.01"
    placeholder="0.00"
    class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
    oninput="checkSolde(this)">
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

<!-- Recent Transactions -->
<div class="bg-white rounded-xl p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Dernières transactions</h3>
        <a href="/alltransactions" class="text-maxitsa-orange hover:underline text-sm">Voir toutes les transactions ></a>
    </div>

    <div class="space-y-4">
        <?php if (!empty($transactions)): ?>
            <?php foreach ($transactions as $transaction): ?>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <div class="flex items-center">
                        <div class="w-10 h-10 <?= $transaction['type'] == 'Depot' ? 'bg-green-100' : 'bg-red-100' ?> rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 <?= $transaction['type'] == 'Depot' ? 'text-green-600' : 'text-red-600' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <?php if ($transaction['type'] === 'Depot'): ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                <?php else: ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                <?php endif; ?>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800"><?= htmlspecialchars($transaction['type']) ?></p>
                            <p class="text-sm text-gray-600">
                                <?= date('d/m/Y', strtotime($transaction['date'])) ?>   
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold <?= $transaction['type'] == 'Depot' ? 'text-green-600' : 'text-red-600' ?>">
                            <?= ($transaction['type'] == 'Depot' ? '+' : '-') . number_format($transaction['montant'], 0, '', ' ') ?> CFA
                        </p>
                        <p class="text-xs text-gray-500"><?= date('H:i', strtotime($transaction['date'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-gray-500 text-center py-4">Aucune transaction récente.</div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Gestion du modal d'ajout de compte
    function openAddAccountModal() {
        const modal = document.getElementById('add-account-modal');

        // Ouvrir le modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Focus sur le premier champ
        document.getElementById('telephone').focus();
    }

    function closeAddAccountModal() {
        const modal = document.getElementById('add-account-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Réinitialiser le formulaire
        document.getElementById('add-account-form').reset();
    }

    // Fermer le modal avec la touche Échap
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAddAccountModal();
        }
    });

    // Fermer le modal en cliquant sur l'arrière-plan
    document.getElementById('add-account-modal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeAddAccountModal();
        }
    });

    function checkSolde(input) {
    const soldePrincipal = <?= isset($solde) ? $solde : 0 ?>;
    const montant = parseFloat(input.value) || 0;
    
    if (montant > soldePrincipal) {
        alert('Le montant ne peut pas dépasser votre solde principal de ' + soldePrincipal + ' CFA');
        input.value = soldePrincipal;
    }
}

</script>