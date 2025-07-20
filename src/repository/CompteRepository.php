<?php

namespace App\src\repository;

use PDO;
use App\Entity\CompteEntity;
use App\Core\abstract\AbstractRepository;

class CompteRepository extends AbstractRepository {

    private static ?CompteRepository $instance = null;

    public static function getInstance(): CompteRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new CompteRepository();
        }
        return self::$instance;
    }

    private function __construct()
    {
        parent::__construct();
    }

    public function getSoldeByUserId(int $userId): ?float
    {
        //client_id = user_id et type = Principal
        $query = "SELECT solde FROM compte WHERE client_id = :userId AND type = 'Principal'";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? (float)$result['solde'] : null;
    }

    public function getCompteByUserId(int $userId): ?array
    {
        $query = "SELECT * FROM compte WHERE client_id = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }

        return null;
    }


    public function countComptesByUserId(int $userId): int
    {
        $query = "SELECT COUNT(*) as count FROM compte WHERE client_id = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (int)($result['count'] ?? 0);
    }

    public function telephoneExists(string $telephone): bool
    {
        $query = "SELECT COUNT(*) as count FROM compte WHERE telephone = :telephone";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (int)($result['count'] ?? 0) > 0;
    }

    public function addCompteSecondaire(int $userId, string $telephone, string $type, float $solde = 0.0): bool
    {
        $query = "INSERT INTO compte (client_id, solde, telephone, type) 
                VALUES (:userId, :solde, :telephone, :type)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->bindParam(':solde', $solde);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':type', $type);
        return $stmt->execute();
    }

    public function getAllComptesByUserId(int $userId): array
{
    $query = "SELECT * FROM compte WHERE client_id = :userId";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
}

public function updateAccountType(int $userId, int $accountId, string $newType): bool
{
    // Vérifier d'abord que le compte appartient à l'utilisateur
    $queryCheck = "SELECT id FROM compte WHERE id = :accountId AND client_id = :userId";
    $stmtCheck = $this->pdo->prepare($queryCheck);
    $stmtCheck->bindParam(':accountId', $accountId, \PDO::PARAM_INT);
    $stmtCheck->bindParam(':userId', $userId, \PDO::PARAM_INT);
    $stmtCheck->execute();
    
    if (!$stmtCheck->fetch()) {
        return false;
    }
    
    // D'abord, mettre tous les comptes de l'utilisateur en Secondaire
    $queryReset = "UPDATE compte SET type = 'Secondaire' WHERE client_id = :userId";
    $stmtReset = $this->pdo->prepare($queryReset);
    $stmtReset->bindParam(':userId', $userId, \PDO::PARAM_INT);
    $stmtReset->execute();

    // Ensuite, mettre le compte spécifié en Principal
    $queryUpdate = "UPDATE compte SET type = :newType WHERE id = :accountId AND client_id = :userId";
    $stmtUpdate = $this->pdo->prepare($queryUpdate);
    $stmtUpdate->bindParam(':newType', $newType);
    $stmtUpdate->bindParam(':accountId', $accountId, \PDO::PARAM_INT);
    $stmtUpdate->bindParam(':userId', $userId, \PDO::PARAM_INT);

    return $stmtUpdate->execute();
}

public function findBy(array $criteria): array
{
    $where = [];
    foreach ($criteria as $key => $value) {
        $where[] = "$key = :$key";
    }
    
    $query = "SELECT * FROM compte WHERE " . implode(' AND ', $where);
    $stmt = $this->pdo->prepare($query);
    $stmt->execute($criteria);
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function beginTransaction(): void
{
    $this->pdo->beginTransaction();
}

public function commitTransaction(): void
{
    $this->pdo->commit();
}

public function rollbackTransaction(): void
{
    $this->pdo->rollBack();
}

public function updateSolde(int $compteId, float $nouveauSolde): bool
{
    $query = "UPDATE compte SET solde = :solde WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':solde', $nouveauSolde);
    $stmt->bindParam(':id', $compteId, \PDO::PARAM_INT);
    return $stmt->execute();
}
    
}