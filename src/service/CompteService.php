<?php
namespace App\Src\Service;

use App\src\repository\CompteRepository;

class CompteService
{
    private CompteRepository $compteRepository;

    public function __construct()
    {
        $this->compteRepository = CompteRepository::getInstance();
    }

    public function getSoldeById(int $id): float
    {
        return $this->compteRepository->getSoldeByUserId($id);
    }

    public function getCompteByUserId(int $userId): ?array
    {
        return $this->compteRepository->getCompteByUserId($userId);
    }

    public function addCompteSecondaireForClient(int $userId, string $telephone, string $type)
    {
        return $this->compteRepository->addCompteSecondaire($userId, $telephone, $type);
    }

    // CompteService.php

public function canAddCompteSecondaire(int $userId, string $telephone): array
{
    // Vérifier si le numéro existe déjà
    if ($this->compteRepository->telephoneExists($telephone)) {
        return ['success' => false, 'message' => 'Ce numéro de téléphone est déjà associé à un compte'];
    }

    // Vérifier la limite de comptes (5 maximum)
    $count = $this->compteRepository->countComptesByUserId($userId);
    if ($count >= 5) {
        return ['success' => false, 'message' => 'Vous avez atteint la limite de 5 comptes'];
    }

    return ['success' => true];
}

public function addCompteSecondaire(int $userId, string $telephone, float $montantInitial = 0.0): array
{
    // Vérifications préalables
    $validation = $this->canAddCompteSecondaire($userId, $telephone);
    if (!$validation['success']) {
        return $validation;
    }

    try {
        // Démarrer une transaction
        $this->compteRepository->beginTransaction();

        // Si un montant est spécifié, déduire du compte principal
        if ($montantInitial > 0) {
            // 1. Trouver le compte principal
            $comptePrincipal = $this->compteRepository->findBy([
                'client_id' => $userId,
                'type' => 'Principal'
            ])[0] ?? null;

            if (!$comptePrincipal) {
                throw new \Exception('Compte principal non trouvé');
            }

            // 2. Vérifier le solde
            if ($comptePrincipal['solde'] < $montantInitial) {
                throw new \Exception('Solde insuffisant sur le compte principal');
            }

            // 3. Mettre à jour le solde du compte principal
            $this->compteRepository->updateSolde(
                $comptePrincipal['id'],
                $comptePrincipal['solde'] - $montantInitial
            );
        }

        // Créer le compte secondaire
        $success = $this->compteRepository->addCompteSecondaire(
            $userId, 
            $telephone, 
            'Secondaire',
            $montantInitial
        );

        if (!$success) {
            throw new \Exception('Erreur lors de la création du compte');
        }

        // Valider la transaction
        $this->compteRepository->commitTransaction();

        return ['success' => true, 'message' => 'Compte secondaire créé avec succès'];
        
    } catch (\Exception $e) {
        // Annuler en cas d'erreur
        $this->compteRepository->rollbackTransaction();
        return ['success' => false, 'message' => 'Erreur: ' . $e->getMessage()];
    }
}

public function getAllComptesByUserId(int $userId): array
{
    $comptes = $this->compteRepository->getAllComptesByUserId($userId);
    return $comptes ?: [];
}

public function setAccountAsPrimary(int $userId, int $accountId): array
{
    try {
        $success = $this->compteRepository->updateAccountType($userId, $accountId, 'Principal');
        
        if ($success) {
            return ['success' => true, 'message' => 'Compte principal mis à jour avec succès'];
        }
        
        return ['success' => false, 'message' => 'Erreur lors de la mise à jour du compte'];
    } catch (\Exception $e) {
        return ['success' => false, 'message' => 'Erreur technique: ' . $e->getMessage()];
    }
}

public function getComptePrincipalByUserId(int $userId): ?array
{
    return $this->compteRepository->findBy([
        'client_id' => $userId,
        'type' => 'Principal'
    ])[0] ?? null;
}


}