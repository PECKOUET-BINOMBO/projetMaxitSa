<?php

namespace App\Core\Abstract;

use App\Core\Session;

abstract class AbstractController {

    protected $layout = 'base.layout.php';
    protected Session $session;
    public function __construct() {
        $this->session = Session::getInstance();
    }

    protected function renderHTML(string $view, array $data = []): void {
        
        extract($data);
        ob_start();
        require_once  __DIR__ . "/../../../templates/" . $view . ".php";
        $content = ob_get_clean();
        require_once   __DIR__ . "/../../../templates/layout/" . $this->layout;

}

}