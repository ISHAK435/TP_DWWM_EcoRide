<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecoride";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$sql = "SELECT id_avis, commentaire, note, statut FROM avis ";
$result = $conn->query($sql);
if (!$result) {
    die("Erreur lors de l'exécution de la requête: " . $conn->error);
}
elseif ($result->num_rows > 0) {
    // Afficher le message de bienvenue
    echo "<!DOCTYPE html>";
    echo "<html lang='fr'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<title>Visionner les avis</title>";
    echo "<style>";
    echo "body { font-family: Arial, sans-serif;  align-items: center; position: relative; justify-content: center; }";
    echo ".avis { border: 1px solid #ccc; padding: 10px; margin: 10px 0; justify-content: center;   
    align-items: center; position: relative; }";
    echo "h1 { color:  #16890b; }";
    echo "h2 { color: #16890b;}";
    echo "h3 { color:  #16890b; }";
    echo "p { color:rgb(93, 98, 93); }";
    echo "</style>";
    echo "</head>";
    echo "<body>";

    echo "<h1>Bienvenue dans l'espace employé</h1>";
    echo "<h2> Avis des passagers traités</h2>";
    // Afficher le nombre d'avis
    echo "<h2>Nombre d'avis: " . $result->num_rows . "</h2>";
    // Afficher les avis
    while($row = $result->fetch_assoc()) {
        echo "<div class='avis'>";
        echo "<h3>" . htmlspecialchars($row["id_avis"]) . "</h3>";
        echo "<p>" . htmlspecialchars($row["commentaire"]) . "</p>";
        echo "<small>" . htmlspecialchars($row["note"]) . "</small>";
        echo "<p>" . htmlspecialchars($row["statut"]) . "</p>";
        echo "</div>";
    }
} else {
    echo "Aucun avis trouvé.";
}

$conn->close();