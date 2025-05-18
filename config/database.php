<?php
// Obtention de l'URL de la base de données depuis la variable d'environnement
$dbUrl = getenv('http://127.0.0.1:444/phpmyadmin/index.php?route=/');
if ($dbUrl) {
    // Analyse de l'URL en composants
    $dbParts = parse_url($dbUrl);
    $host = $dbParts['host'];
    $username = $dbParts['user'];
    $password = $dbParts['pass'];
    $dbname = ltrim($dbParts['path'], '/');
    $port = isset($dbParts['port']) ? $dbParts['port'] : 3306;
} else {
    // Paramètres locaux pour le développement
    $host = '127.0.0.1';
    $dbname = 'ecoride';
    $username = 'root';
    $password = '';
    $port = '3306';
}
try {
    // Création de la connexion
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}