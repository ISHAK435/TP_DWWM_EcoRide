<?php
$host = "127.0.0.1"; 
$user = "root"; 
$password = ""; 
$database = "ecoride"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 

    // Connexion à la base de données
    $conn = new mysqli("127.0.0.1", "root", "", "ecoride");
    
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $sql = "INSERT INTO utilisateur ( email, password) VALUES ( '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "connexion réussie !";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
           echo
"<script>alert('connexion réussie !');
document.location.href = 'index.html';
</script>";

}
?>

<?php

// Démarrer la session
session_start();

// Vérifier si l'utilisateur a cliqué sur "Déconnexion"
if (isset($_POST['logout'])) {
    // Détruire la session
    session_unset();
    session_destroy();
  $logout->close();

    // Rediriger vers la page de connexion 
    header("Location: login.html");
    exit();

}
?>

