<?php
$servername = "127.0.0.1";
$username = "root"; 
$password = "";
$dbname = "ecoride";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash du mot de passe

    $sql = "INSERT INTO employe (nom, email, password) VALUES ('$nom', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Compte employé créé avec succès !";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

$conn->close();
?>