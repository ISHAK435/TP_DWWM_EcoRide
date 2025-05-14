<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $connexion = new mysqli("127.0.0.1", "root", "", "ecoride");

    if ($connexion->connect_error) {
        die("Connexion échouée : " . $connexion->connect_error);
    }

    // Exemple d'insertion de données (ajustez selon votre structure)
    $sql = "INSERT INTO covoiturage (lieu_depart, lieu_arrivee, date_depart, prix_personne, id_voiture) VALUES ('Gare de Lyon Part-Dieu','2025-06-20', 'Hôtel de ville de Grenoble', '11', '1')";


    if ($connexion->query($sql) === TRUE) {
        echo "Trajet publié avec succès !";

        $id_voiture = 2;
// Requête pour récupérer l'historique des covoiturages
$sql = "SELECT id_covoiturage,date_depart, heure_depart, lieu_depart, date_arrivee, heure_arrivee, lieu_arrivee, prix_personne, id_voiture FROM covoiturage WHERE id_voiture = ?";
$stmt = $connexion->prepare($sql);
$stmt->bind_param('i', $id_voiture);
$stmt->execute();
$result = $stmt->get_result();
$covoiturage = $result->fetch_all(MYSQLI_ASSOC);

if ($id_voiture ){
    echo "<table border='1'>";
    echo "<tr><th>id_covoiturage</th><th>date_depart</th><th>lieu_depart</th><th>date_arrivee</th><th>lieu_arrivee</th><th>Prix_personne</th><th>id_voiture</th></tr>";
    foreach ( $covoiturage as  $id_voiture) {

         echo "<tr>";
          echo "<td>" . htmlspecialchars( $id_voiture['id_covoiturage']) . "</td>";
        echo "<td>" . htmlspecialchars($id_voiture['lieu_depart']) . " </td>";
        
        echo "<td>" . htmlspecialchars( $id_voiture['date_depart']) . "</td>";

         echo "<td>" . htmlspecialchars( $id_voiture['lieu_arrivee']) . "</td>";

        echo "<td>" . htmlspecialchars( $id_voiture['date_arrivee']) . "</td>";

        
        echo "<td>" . htmlspecialchars( $id_voiture['prix_personne']) . " €</td>";
        echo "<td>" . htmlspecialchars( $id_voiture['id_voiture']) . " </td>";
        echo "</tr>";
    }
    echo "</table>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $connexion->error;
    }
}
    $connexion->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <style>
        .message {
            position: relative;
            top: 200px;
            font-family: Arial, sans-serif;
            font-size: 20px;
            color: white;
            background-color: #4CAF50;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            width: 30%;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php
        $message = "Trajet publié avec succès !";
        echo "<div class='message'>$message</div>";
    ?>
</body>