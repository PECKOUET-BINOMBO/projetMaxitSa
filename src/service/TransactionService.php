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
   
}