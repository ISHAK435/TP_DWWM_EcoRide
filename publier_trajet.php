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
        echo "votre Trajet";

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
    echo "<tr><th>id_covoiturage</th><th>date_depart</th><th>heure_depart</th><th>lieu_depart</th><th>date_arrivee</th><th>heure_arivee</th><th>lieu_arrivee</th><th>Prix_personne</th><th>id_voiture</th></tr>";
    foreach ( $covoiturage as  $id_voiture) {

         echo "<tr>";
          echo "<td>" . htmlspecialchars( $id_voiture['id_covoiturage']) . "</td>";
        
        echo "<td>" . htmlspecialchars( $id_voiture['date_depart']) . "</td>";
        echo "<td>" . htmlspecialchars($id_voiture['heure_depart']) . " </td>";
        echo "<td>" . htmlspecialchars($id_voiture['lieu_depart']) . " </td>";
        echo "<td>" . htmlspecialchars( $id_voiture['date_arrivee']) . "</td>";
        echo "<td>" . htmlspecialchars( $id_voiture['heure_arrivee']) . "</td>";
        echo "<td>" . htmlspecialchars( $id_voiture['lieu_arrivee']) . "</td>";
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
  <title>Pop-up</title>
  <style>
    /* Style pour le fond du pop-up */
    #popup {
      display: none; /* Caché par défaut */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
      justify-content: center;
      align-items: center;
      
    }
.showPopup-btn button {
   position: relative;
   width: 150px;
   height: 30px;
   top: 100px;
   background-color: #4CAF50; 
   color: aliceblue;
   border-radius: 10px;
   border: aliceblue;
  
}
    
    /* Style pour le contenu du pop-up */
    #popup-content {
      background: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #close-btn {
      margin-top: 10px;
      padding: 10px 20px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    #close-btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
    <div class="showPopup-btn">
  <button onclick="showPopup()">Afficher le message</button>
    </div>
  <div id="popup">
    <div id="popup-content">
      <p> Trajet publié avec succès!</p>
      <button id="close-btn" onclick="closePopup()">Fermer</button>
    </div>
  </div>

  <script>
    // Fonction pour afficher le pop-up
    function showPopup() {
      document.getElementById('popup').style.display = 'flex';
    }

    // Fonction pour fermer le pop-up
    function closePopup() {
      document.getElementById('popup').style.display = 'none';
    }
  </script>
</body>
</html>
