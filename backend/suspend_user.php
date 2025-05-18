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
            echo " ";
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
$id_utilisateur=14; // Remplacez par l'ID du l'utilisateur à supprimer
supprimerutilisateur($id_utilisateur);

// Fermer la connexion
$conn->close();
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
   left: 700px;
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
      <p>Le compte de l'utilisateur a étè supprimé avec sucées!</p>
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