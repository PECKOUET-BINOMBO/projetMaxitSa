<?php

require_once __DIR__ . '/../vendor/autoload.php';

function createDatabase(PDO $pdo, string $dbName): void {
    try {
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `$dbName`");
        echo "Base de données `$dbName` créée avec succès.\n";
    } catch (PDOException $e) {
        die("Erreur création base: " . $e->getMessage());
    }
}

function createTables(PDO $pdo): void {
    $tables = [
        "CREATE TABLE IF NOT EXISTS client (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100) NOT NULL,
            adresse VARCHAR(255),
            telephone VARCHAR(20)
        ) ENGINE=InnoDB;",
        
        "CREATE TABLE IF NOT EXISTS compte (
            id INT AUTO_INCREMENT PRIMARY KEY,
            telephone VARCHAR(20) NOT NULL,
            numero_cni VARCHAR(20),
            solde DECIMAL(12,2) DEFAULT 0,
            type VARCHAR(20) NOT NULL,
            client_id INT NOT NULL,
            FOREIGN KEY (client_id) REFERENCES client(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;",
        
        "CREATE TABLE IF NOT EXISTS transaction (
            id INT AUTO_INCREMENT PRIMARY KEY,
            date DATETIME DEFAULT CURRENT_TIMESTAMP,
            type VARCHAR(20) NOT NULL,
            montant DECIMAL(12,2) NOT NULL,
            compte_id INT NOT NULL,
            FOREIGN KEY (compte_id) REFERENCES compte(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;",
        
        "CREATE TABLE IF NOT EXISTS user (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100) NOT NULL
        ) ENGINE=InnoDB;"
    ];

    foreach ($tables as $sql) {
        try {
            $pdo->exec($sql);
        } catch (PDOException $e) {
            die("Erreur création table: " . $e->getMessage());
        }
    }
    echo "Tables créées avec succès.\n";
}

try {
    // Connexion au serveur MySQL
    $pdo = new PDO('mysql:host=localhost;port=3306', 'phpadmin', 'phpadmin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la base
    createDatabase($pdo, 'maxitsa');

    // Création des tables
    createTables($pdo);

    // Création du fichier .env si inexistant
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        $envContent = <<<ENV
APP_URL=http://localhost:8000
DB_HOST=localhost
DB_NAME=maxitsa
DB_USER=phpadmin
DB_PASS=phpadmin
DB_PORT=3306
DB_DRIVER=mysql
ENV;
        file_put_contents($envPath, $envContent);
        echo "Fichier .env créé avec succès.\n";
    }

} catch (PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
    
}