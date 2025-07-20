<?php

namespace App\Src\Controller;

use App\Core\Abstract\AbstractController;
use App\Src\Service\CompteService;
use App\Core\Session;


class CompteController extends AbstractController
{


    protected CompteService $compteService;

    public function __construct()
    {

        parent::__construct();
        $this->layout = 'auth.layout.php';
        $this->compteService = new CompteService();

    }


    public function index()
    {

        return $this->renderHtml('auth/dashboard.php');
    }


    // CompteController.php

   public function ajoutCompteSecondaire()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = $this->session->get('user');
        $userId = $user->getId();
        $telephone = $_POST['telephone'] ?? '';
        $montantInitial = (float)($_POST['montant_initial'] ?? 0);

        // Nettoyer le numéro de téléphone
        $telephone = preg_replace('/\D/', '', $telephone);

        // Vérifier si un montant a été saisi
        if ($montantInitial > 0) {
            // Vérifier si le compte principal a suffisamment de solde
            $soldePrincipal = $this->compteService->getSoldeById($userId);
            
            if ($soldePrincipal < $montantInitial) {
                $this->session->set('error_message', 'Solde insuffisant sur le compte principal.');
                header('Location: /dashboardClient');
                exit();
            }
        }

        $result = $this->compteService->addCompteSecondaire($userId, $telephone, $montantInitial);

        if ($result['success']) {
            $this->session->set('success_message', 'Compte secondaire ajouté avec succès.');
        } else {
            $this->session->set('error_message', $result['message']);
        }
        
        header('Location: /dashboardClient');
        exit();
    }
}

  public function setPrimaryAccount()
{
    extract($_POST, EXTR_SKIP); // EXTR_SKIP pour éviter l'écrasement de variables existantes
    
    // Validation de l'input
    if (!isset($account_id) || empty($account_id)) {
        $this->session->set('error_message', 'Identifiant de compte manquant.');
        header('Location: /dashboardClient');
        exit();
    }

    // Vérification de la session utilisateur
    $user = $this->session->get('user');
    if (!$user) {
        header('Location: /');
        exit();
    }

    // Conversion si l'utilisateur est sous forme de tableau
    if (is_array($user)) {
        $user = \App\Src\Entity\UserEntity::toObject($user);
    }

    // Nettoyage et validation de l'ID du compte
    $accountId = filter_var($account_id, FILTER_VALIDATE_INT);
    if ($accountId === false) {
        $this->session->set('error_message', 'Identifiant de compte invalide.');
        header('Location: /dashboardClient');
        exit();
    }

    // Appel du service
    $result = $this->compteService->setAccountAsPrimary($user->getId(), $accountId);

    // Gestion du retour
    if ($result['success']) {
        $this->session->set('success_message', $result['message']);
    } else {
        $this->session->set('error_message', $result['message']);
    }

    header('Location: /dashboardClient');
    exit();
}
}
