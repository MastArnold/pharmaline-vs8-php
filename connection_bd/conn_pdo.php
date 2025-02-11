<?php
    // Informations de connexion
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pharma8";

    try {
        // Connexion à la base de données avec PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        
        // Configuration des options PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message et arrêter l'exécution
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
?>
