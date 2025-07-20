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
            'transactions' => [],
            'currentPage' => 1,
            'totalPages' => 1
        ]);
        return;
    }

    // Récupérer les paramètres
    $type = $_GET['type'] ?? null;
    $date = $_GET['date'] ?? null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 10; // Nombre de transactions par page

    // Récupérer les transactions filtrées avec pagination
    $result = $this->transactionService->getPaginatedTransactions(
        $comptePrincipal['id'],
        $type,
        $date,
        $page,
        $perPage
    );

    $this->renderHTML('auth/all_transactions', [
        'user' => $user,
        'transactions' => $result['transactions'],
        'currentPage' => $page,
        'totalPages' => $result['totalPages'],
        'type' => $type,
        'date' => $date
    ]);
}
}