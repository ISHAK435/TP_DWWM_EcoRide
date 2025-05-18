<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 

    // Connexion à la base de données
    $conn = new mysqli("127.0.0.1", "root", "", "ecoride");
    
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $sql = "INSERT INTO utilisateur ( email, password) VALUES ( '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie ! Vous béneficiez de 20 crédits";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

       echo
"<script>alert('Inscription réussie !');
document.location.href = 'index.html';
</script>";

    
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = htmlspecialchars($_POST["pseudo"]); // Sécuriser l'entrée utilisateur

    // Connexion à la base de données
    $conn = new mysqli("localhost", "username", "password", "database");

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Insérer le pseudo en base de données
    $sql = "INSERT INTO utilisateur (pseudo) VALUES ('$pseudo')";

    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur : " . $conn->error;
    }

    $conn->close();
}
?>
<script>
// script.js
document.getElementById('generatePseudo').addEventListener('click', function () {
  const randomNumber = Math.floor(Math.random() * 1000); // Génère un nombre aléatoire
  const basePseudo = "Utilisateur"; // Base du pseudo
  const generatedPseudo = `${basePseudo}${randomNumber}`; // Combine la base et le nombre
  document.getElementById('username').value = generatedPseudo; // Remplit le champ pseudo
});

document.getElementById('signupForm').addEventListener('submit', function (event) {
  event.preventDefault(); // Empêche l'envoi du formulaire pour cet exemple
  const pseudo = document.getElementById('username').value;
  document.getElementById('feedback').textContent = `Compte créé avec succès pour le pseudo : ${pseudo}`;
});
</script>