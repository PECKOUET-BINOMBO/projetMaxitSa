<?php
require __DIR__ . "./../vendor/autoload.php";
use Dotenv\Dotenv;
use App\Core\Router;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require __DIR__ . '/../routes/route.web.php';

Router::resolve($routes);

