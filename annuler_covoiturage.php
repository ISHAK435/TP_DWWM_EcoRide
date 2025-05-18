<?php
// Connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecoride";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Fonction pour annuler un covoiturage
function annulerCovoiturage($id) {
    global $conn;
    
    // Préparer la requête SQL pour supprimer le covoiturage
    $sql = "DELETE FROM covoiturage WHERE id_covoiturage = ?";
    
    // Utiliser une requête préparée pour éviter les injections SQL
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Votre covoiturage est annulé avec succès.";
        } else {
            echo "Erreur lors de l'annulation du covoiturage: " . $stmt->error;
        }
        
        // Fermer la déclaration
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête: " . $conn->error;
    }
}

// d'utilisation de la fonction
$id_Covoiturage = 33; //  l'ID du covoiturage à annuler
annulerCovoiturage($id_Covoiturage);

// Fermer la connexion
$conn->close();
?>



<?php
// Connexion à la base de données
$host = '127.0.0.1'; 
$dbname = 'ecoride';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération de l'ID du covoiturage depuis le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_covoiturage'])) {
    $id_covoiturage = intval($_POST['id_covoiturage']);

    // Vérification si l'ID du covoiturage existe
    $query = $pdo->prepare("SELECT nb_place FROM covoiturage WHERE id_covoiturage = :id");
    $query->execute(['id' => $id_covoiturage]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Mise à jour du nombre de places disponibles
        $new_place = $result['nb_place'] + 1;
        $update = $pdo->prepare("UPDATE covoiturage SET nb_place = :place WHERE id = :id");
        $update->execute(['place' => $new_place, 'id' => $id_Covoiturage]);
        echo "La réservation a été annulée et le nombre de places mises à jour.";
    } else {
        echo "ID du covoiturage non trouvé.";
    }
}
?>