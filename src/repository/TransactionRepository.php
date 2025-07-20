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

public function getPaginatedTransactionsByCompteId(
    int $compteId, 
    ?string $type = null, 
    ?string $date = null,
    int $offset = 0,
    int $limit = 10
): array {
    $query = "SELECT id, date, type, montant, compte_id 
              FROM transaction 
              WHERE compte_id = :compteId";
    
    $params = [':compteId' => $compteId];
    
    if ($type) {
        $query .= " AND type = :type";
        $params[':type'] = $type;
    }
    
    if ($date) {
        $query .= " AND DATE(date) = :date";
        $params[':date'] = $date;
    }
    
    $query .= " ORDER BY date DESC LIMIT :limit OFFSET :offset";
    
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':compteId', $compteId, \PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
    
    if ($type) {
        $stmt->bindParam(':type', $type);
    }
    
    if ($date) {
        $stmt->bindParam(':date', $date);
    }
    
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function countTransactions(
    int $compteId, 
    ?string $type = null, 
    ?string $date = null
): int {
    $query = "SELECT COUNT(*) as total FROM transaction WHERE compte_id = :compteId";
    
    $params = [':compteId' => $compteId];
    
    if ($type) {
        $query .= " AND type = :type";
        $params[':type'] = $type;
    }
    
    if ($date) {
        $query .= " AND DATE(date) = :date";
        $params[':date'] = $date;
    }
    
    $stmt = $this->pdo->prepare($query);
    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
    return (int)($result['total'] ?? 0);
}
}

