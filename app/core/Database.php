<?php

namespace App\Core;


use PDO;

class Database {

    private ?PDO $pdo = null;

    private static ?Database $database = null;

    private string $user;
    private string $password;
  
    private string $dsn;

    private function __construct()
    {
       
        $this->user = $_ENV['DB_USER'] ;
        $this->password = $_ENV['DB_PASS'] ;
        $this->dsn = $_ENV['DSN'] ;
    }

    public static function getInstance() {
        if(is_null(self::$database)) {
            self::$database = new Database();
        }

        return self::$database;
    }

    public function connection(){
       if(is_null($this->pdo)) {

          try {
              $this->pdo = new PDO($this->dsn, $this->user, $this->password);
              $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch (\PDOException $e) {
              throw new \RuntimeException('Database connection failed: ' . $e->getMessage());
          }

           
       }

       return $this->pdo;
   }
}