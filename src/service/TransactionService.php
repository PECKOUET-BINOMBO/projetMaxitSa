<?php

namespace App\Src\Service;

use App\Src\Repository\TransactionRepository;

class TransactionService
{
    private TransactionRepository $transactionRepository;

    public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
    }

    public function getLastTransactions(int $compteId, int $limit = 10): array
    {
        return $this->transactionRepository->getLastTransactionsByCompteId($compteId, $limit);
    }
    
    public function getAllTransactionsByCompteId(int $compteId): array
{
    return $this->transactionRepository->getAllTransactionsByCompteId($compteId);
}

public function getFilteredTransactions(int $compteId, ?string $type = null, ?string $date = null): array
{
    return $this->transactionRepository->getFilteredTransactionsByCompteId(
        $compteId,
        $type,
        $date
    );
}

public function getPaginatedTransactions(
    int $compteId, 
    ?string $type = null, 
    ?string $date = null,
    int $page = 1,
    int $perPage = 10
): array {
    // Calculer l'offset
    $offset = ($page - 1) * $perPage;

    // Récupérer les transactions pour la page actuelle
    $transactions = $this->transactionRepository->getPaginatedTransactionsByCompteId(
        $compteId,
        $type,
        $date,
        $offset,
        $perPage
    );

    // Récupérer le nombre total de transactions
    $totalTransactions = $this->transactionRepository->countTransactions(
        $compteId,
        $type,
        $date
    );

    // Calculer le nombre total de pages
    $totalPages = ceil($totalTransactions / $perPage);

    return [
        'transactions' => $transactions,
        'totalPages' => $totalPages
    ];
}
   
}