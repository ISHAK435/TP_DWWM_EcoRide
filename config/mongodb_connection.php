<?php
// Connexion au pilote PHP MongoDB
require_once __DIR__ . '/../vendor/autoload.php';

// Paramètres de connexion à MongoDB
$mongodb = null;

try {
    // Création d'une connexion à MongoDB
    $mongodb = new MongoDB\Client("mongodb://localhost:27017");
    
    // Vérification de la connexion par ping
    $mongodb->admin->command(['ping' => 1]);
    
    // S'il n'y a pas d'exception, la connexion est réussie
} catch (Exception $e) {
    // Journalisation de l'erreur dans un fichier pour ne pas l'afficher à l'utilisateur
    error_log("Erreur de connexion MongoDB: " . $e->getMessage(), 0);
}
?>
