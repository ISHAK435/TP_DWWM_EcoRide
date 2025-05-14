<?php


$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecoride";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Fonction pour supprimer utilisateur
function supprimerutilisateur($id) {
    global $conn;
    
    // Préparer la requête SQL pour supprimer l'utilisateur
    $sql = "DELETE FROM utilisateur WHERE id_utilisateur = ?";
    
    // Utiliser une requête préparée pour éviter les injections SQL
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Le compte de l'utilisateur a étè supprimé avec sucées! .";
        } else {
            echo "Erreur lors de la suppression du compte utilisateur: " . $stmt->error;
        }
        
        // Fermer la déclaration
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête: " . $conn->error;
    }
}

// Exemple d'utilisation de la fonction
$id_utilisateur= 9 ; // Remplacez par l'ID du l'utilisateur à supprimer
supprimerutilisateur($id_utilisateur);

// Fermer la connexion
$conn->close();
?>