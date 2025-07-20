<?php

namespace App\Src\Repository;

use App\Core\abstract\AbstractRepository;
use App\Src\Entity\UserEntity;

class UserRepository extends AbstractRepository
{

     
    private static ?UserRepository $instance = null;
    public static function getInstance(): UserRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new UserRepository();
        }
        return self::$instance;
    }

    private function __construct()
    {
        parent::__construct();
    }

    public function seConnecter(string $login, string $password): ?UserEntity

    {
        $query = "SELECT u.*, c.telephone FROM utilisateur u
          JOIN compte c ON u.id = c.client_id
          WHERE c.telephone = :login AND u.password = :password";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $array = $stmt->fetchAll(\PDO::FETCH_ASSOC);

       
        if (empty($array)) {
            return null;
        }
        $userdata = $array[0];
        
       
    
        $user = UserEntity::toObject($userdata);
        return $user ?: null;
    }

    

   
}