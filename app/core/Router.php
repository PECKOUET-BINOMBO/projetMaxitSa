<?php

namespace App\Core;


class Router {
    public static function resolve(array $routes){
        // var_dump($_SERVER['REQUEST_URI']); die;
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (array_key_exists($uri, $routes)) {
            $route = $routes[$uri];

            if (!empty($route['middlewares'])) {

                self::runMiddlewares($route['middlewares']);
            }

            $controllerName = $route['controller'];
            $actionName = $route['action'];

            if (class_exists($controllerName) && method_exists($controllerName, $actionName)) {
                $controller = new $controllerName();
                return $controller->$actionName();
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    public static function runMiddlewares(array $middlewares): void {
        $arrayMiddleware = require_once __DIR__ . '/../config/middlewares.php';

        foreach ($middlewares as $middleware) {
            if (isset($arrayMiddleware[$middleware])) {
                $middlewareClass = $arrayMiddleware[$middleware];
                $instance = new $middlewareClass();
                
               
                if (is_callable($instance)) {
                    $instance();
                }
                
            }
        }
        
    }
}