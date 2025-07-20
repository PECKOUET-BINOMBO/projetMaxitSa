<div class="p-8">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Toutes vos transactions</h2>
        
        <a href="/dashboardClient" class="text-maxitsa-orange hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour au tableau de bord
        </a>
    </div>
    <div class="flex items-center space-x-4">
                <!-- Filtres -->
                <form method="GET" action="/alltransactions" class="flex items-center space-x-4">
                    <!-- Filtre par type -->
                    <select name="type" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">Tous les types</option>
                        <option value="Depot" <?= isset($_GET['type']) && $_GET['type'] == 'Depot' ? 'selected' : '' ?>>Dépôt</option>
                        <option value="Retrait" <?= isset($_GET['type']) && $_GET['type'] == 'Retrait' ? 'selected' : '' ?>>Retrait</option>
                        <option value="Paiement" <?= isset($_GET['type']) && $_GET['type'] == 'Paiement' ? 'selected' : '' ?>>Paiement</option>
                    </select>
                    
                    <!-- Filtre par date -->
                    <input type="date" name="date" value="<?= $_GET['date'] ?? '' ?>" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                    
                    <!-- Bouton de recherche -->
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors text-sm">
                        <i class="fa-solid fa-filter mr-2"></i>
                        Filtrer
                    </button>
                    
                    <!-- Bouton de réinitialisation -->
                    <?php if (isset($_GET['type']) || isset($_GET['date'])): ?>
                        <a href="/alltransactions" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-sm">
                            Réinitialiser
                        </a>
                    <?php endif; ?>
                </form>
            </div>

    <?php if (!empty($transactions)): ?>
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="grid grid-cols-4 bg-gray-50 px-6 py-3 text-sm font-medium text-gray-500 uppercase tracking-wider">
                <div>Date</div>
                <div>Type</div>
                <div>Description</div>
                <div class="text-right">Montant</div>
            </div>
            
            <div class="divide-y divide-gray-100">
                <?php foreach ($transactions as $transaction): ?>
                    <div class="grid grid-cols-4 px-6 py-4 hover:bg-gray-50">
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
                                <div class="text-sm font-medium text-gray-900"><?= date('d/m/Y', strtotime($transaction['date'])) ?></div>
                                <div class="text-xs text-gray-500"><?= date('H:i', strtotime($transaction['date'])) ?></div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="px-2 py-1 text-xs font-medium rounded-full <?= $transaction['type'] == 'Depot' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= htmlspecialchars($transaction['type']) ?>
                            </span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <?= $transaction['type'] === 'Depot' ? 'Dépôt' : ($transaction['type'] === 'Retrait' ? 'Retrait' : 'Transfert') ?>
                        </div>
                        <div class="text-right">
                            <span class="font-medium <?= $transaction['type'] == 'Depot' ? 'text-green-600' : 'text-red-600' ?>">
                                <?= ($transaction['type'] == 'Depot' ? '+' : '-') . number_format($transaction['montant'], 0, '', ' ') ?> CFA
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl p-8 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Aucune transaction</h3>
            <p class="text-gray-500">Vous n'avez effectué aucune transaction pour le moment.</p>
        </div>
    <?php endif; ?>
</div>