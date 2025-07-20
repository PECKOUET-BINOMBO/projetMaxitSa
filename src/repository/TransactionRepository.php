<?php

namespace App\Src\Repository;

use App\Core\abstract\AbstractRepository;

class TransactionRepository extends AbstractRepository
{
    public function getLastTransactionsByCompteId(int $compteId, int $limit = 10): array
    {
        $query = "SELECT id, date, type, montant, compte_id 
                  FROM transaction 
                  WHERE compte_id = :compteId 
                  ORDER BY date DESC 
                  LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':compteId', $compteId, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllTransactionsByCompteId(int $compteId): array
{
    $query = "SELECT id, date, type, montant, compte_id 
              FROM transaction 
              WHERE compte_id = :compteId 
              ORDER BY date DESC";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':compteId', $compteId, \PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function getFilteredTransactionsByCompteId(int $compteId, ?string $type = null, ?string $date = null): array
{
    $query = "SELECT id, date, type, montant, compte_id 
              FROM transaction 
              WHERE compte_id = :compteId";
    
    $params = [':compteId' => $compteId];
    
    // Ajouter les conditions de filtrage
    if ($type) {
        $query .= " AND type = :type";
        $params[':type'] = $type;
    }
    
    if ($date) {
        $query .= " AND DATE(date) = :date";
        $params[':date'] = $date;
    }
    
    $query .= " ORDER BY date DESC";
    
    $stmt = $this->pdo->prepare($query);
    $stmt->execute($params); 
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
}

