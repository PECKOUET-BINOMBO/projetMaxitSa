<?php
namespace App\Src\Controller;

use App\Core\Abstract\AbstractController;
use App\Src\Service\CompteService;
use App\Src\Service\TransactionService;
use App\src\repository\CompteRepository;

class UserController extends AbstractController
{
    private CompteService $compteservice;
    private TransactionService $transactionService;

    public function __construct()
    {
        parent::__construct(); 
        $this->compteservice = new CompteService();
        $this->transactionService = new TransactionService();
    }

   public function showDashboard()
{
    $user = $this->session->get('user');
    if (!$user) {
        header('Location: /');
        exit();
    }
    
    if (is_array($user)) {
        $user = \App\Src\Entity\UserEntity::toObject($user);
    }
    
    $solde = $this->compteservice->getSoldeById($user->getId());
    $allComptes = $this->compteservice->getAllComptesByUserId($user->getId());
    
    // Séparer les comptes principaux et secondaires
    $compte_principal = null;
    $comptes_secondaires = [];
    
    foreach ($allComptes as $compte) {
        if ($compte['type'] === 'Principal') {
            $compte_principal = $compte;
        } else {
            $comptes_secondaires[] = $compte;
        }
    }
    
    // Récupérer les transactions pour le compte principal
    $transactions = [];
    if ($compte_principal) {
        $transactions = $this->transactionService->getLastTransactions($compte_principal['id']);
    }

    $this->renderHTML('auth/dashboard', [
        'user' => $user,
        'solde' => $solde,
        'compte_principal' => $compte_principal,
        'comptes_secondaires' => $comptes_secondaires,
        'transactions' => $transactions
    ]);
}

public function showAllTransactions()
{
    $user = $this->session->get('user');
    if (!$user) {
        header('Location: /');
        exit();
    }
    
    if (is_array($user)) {
        $user = \App\Src\Entity\UserEntity::toObject($user);
    }
    
    // Récupérer le compte principal
    $comptePrincipal = $this->compteservice->getComptePrincipalByUserId($user->getId());
    
    if (!$comptePrincipal) {
        $this->renderHTML('auth/all_transactions', [
            'user' => $user,
            'transactions' => []
        ]);
        return;
    }

    // Récupérer les paramètres de filtrage
    $type = $_GET['type'] ?? null;
    $date = $_GET['date'] ?? null;

    // Récupérer les transactions filtrées
    $transactions = $this->transactionService->getFilteredTransactions(
        $comptePrincipal['id'],
        $type,
        $date
    );

    $this->renderHTML('auth/all_transactions', [
        'user' => $user,
        'transactions' => $transactions
    ]);
}
}