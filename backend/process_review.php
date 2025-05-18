<?php

$host='127.0.0.1';
$db = 'ecoride';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    echo " Connection réussie!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$id_avis = 1;
$action= null;
if(isset($_POST['review_id']) && isset($_POST['action']) )

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review_id = $_POST['review_id'];
    $action = $_POST['action'];

    // Connexion à la base de données
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "ecoride";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Mise à jour de l'avis dans la base de données avec une requête préparée
    if ($action == "valider") {
        $statut = 'validé';
    } else {
        $statut = 'refusé';
    }

    $stmt = $conn->prepare("UPDATE avis SET statut=? WHERE id_avis=?");
    $stmt->bind_param("si", $statut, $id_avis);

    if ($stmt->execute()) {
        echo "L'avis a été mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'avis: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>