<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    $dsn = "mysql:host=localhost;port=3306;dbname=maxitsa";
    $pdo = new PDO($dsn, 'phpadmin', 'phpadmin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données\n";
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}

try {
    $pdo->beginTransaction();

    // 1. Clients
    $clients = [
        ['Jean', 'Dupont', 'Dakar Plateau', '771234567'],
        ['Marie', 'Martin', 'Guédiawaye', '772345678'],
        ['Paul', 'Durand', 'Pikine', '773456789'],
        ['Sophie', 'Lambert', 'Rufisque', '774567890'],
        ['Lucie', 'Petit', 'Mermoz', '775678901']
    ];
    $stmtClient = $pdo->prepare("INSERT INTO client (nom, prenom, adresse, telephone) VALUES (?, ?, ?, ?)");
    foreach ($clients as $client) {
        $stmtClient->execute($client);
    }
    echo "Clients insérés\n";

    // 2. Comptes (adapté à votre structure de table)
    $comptes = [
        ['771234567', '1E1001', 100000.00, 'Principal', 1],
        ['772345678', '1E1002', 75000.50, 'Principal', 2],
        ['773456789', '1E1003', 250000.75, 'Principal', 3],
        ['771234568', '1E1004', 50000.00, 'Secondaire', 1],
        ['772345679', '1E1005', 30000.25, 'Secondaire', 2]
    ];
    $stmtCompte = $pdo->prepare("INSERT INTO compte (telephone, numero_cni, solde, type, client_id) VALUES (?, ?, ?, ?, ?)");
    foreach ($comptes as $compte) {
        $stmtCompte->execute($compte);
    }
    echo "Comptes insérés\n";

    // 3. Transactions (adapté à votre structure)
    $transactions = [
        ['2025-07-01 10:30:00', 'Depot', 50000.00, 1],
        ['2025-07-02 14:45:00', 'Retrait', 20000.00, 1],
        ['2025-07-03 09:15:00', 'Paiement', 15000.50, 2],
        ['2025-07-04 16:30:00', 'Depot', 100000.00, 3],
        ['2025-07-05 11:20:00', 'Retrait', 50000.00, 3]
    ];
    $stmtTrx = $pdo->prepare("INSERT INTO transaction (date, type, montant, compte_id) VALUES (?, ?, ?, ?)");
    foreach ($transactions as $trx) {
        $stmtTrx->execute($trx);
    }
    echo "Transactions insérées\n";

    // 4. Profils/Utilisateurs (si nécessaire)
    $users = [
        ['admin@maxitsa.sn', password_hash('passer123', PASSWORD_BCRYPT), 'Admin', 'Admin']
    ];
    $stmtUser = $pdo->prepare("INSERT INTO user (email, password, nom, prenom) VALUES (?, ?, ?, ?)");
    foreach ($users as $user) {
        $stmtUser->execute($user);
    }
    echo "Utilisateurs insérés\n";

    $pdo->commit();
    echo "Toutes les données ont été insérées avec succès!\n";

} catch (PDOException $e) {
    $pdo->rollBack();
    die("Erreur lors de l'insertion des données : " . $e->getMessage());
}