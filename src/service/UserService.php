<?php

namespace App\Src\Service;

use App\Src\Entity\UserEntity;
use App\Src\Repository\UserRepository;

class UserService{

    private UserRepository $userRepository;

    private static ?UserService $instance = null;   
    public static function getInstance(): UserService {
        if (is_null(self::$instance)) 
        {
            self::$instance = new UserService();
        }
        return self::$instance;
    }


private function __construct()
{
    $this->userRepository = UserRepository::getInstance();
}

public function getUserByLoginPassword(string $login, string $password): ?UserEntity {
    return $this->userRepository->seConnecter($login, $password);
}

}