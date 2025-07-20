<?php

use App\Src\Controller\UserController;
use App\Src\Controller\CompteController;
use App\Src\Controller\SecurityController;

$routes = [
    '/' => [
        'controller' => SecurityController::class,
        'action' => 'login'
    ],
    
    '/dashboardClient' => [
        'controller' => UserController::class,
        'action' => 'showDashboard'
    ],
    '/ajout-compte-secondaire' => [
        'controller' => CompteController::class,
        'action' => 'ajoutCompteSecondaire'
    ],
    '/logout' => [
        'controller' => SecurityController::class,
        'action' => 'logout'
    ],
    '/compteprincipal' => [
        'controller' => CompteController::class,
        'action' => 'setPrimaryAccount'
    ],
    '/alltransactions' => [
        'controller' => UserController::class,
        'action' => 'showAllTransactions'
    ],
];


