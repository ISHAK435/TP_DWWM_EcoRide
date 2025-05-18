<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen and (min-width: 768px) and (max-width: 1025px)" href="styles-tablet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Validation des Avis de Covoiturage</title>
    <link rel="stylesheet" href="styles.css">
</head>


<header>
<nav>
<a href="http://localhost:3000/frontend/index.html"> <img src="img\electric-vehicle_17165746.png" class="imglogo" alt="logo EcoRide" >
</a>
</nav>
   
</header>
<body>
        
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #16890b;
    top: 50px;
}

#avis-container {
    position: relative;
    justify-content: center;
    max-width: 800px;
    height: 500px;
    margin: 0 auto;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(106, 209, 92, 0.1);
}

.avis-item {
    padding: 10px 0;
    border-radius: 20px;
}
.avis-item small {
    color: #666;
}
    </style>
    <h1>Bienvenue dans l'Espace Employé</h1>

    <div id="avis-container">
        <form action="backend/fetch_reviews.php" method="post"></form>
    <h2>Validation des Avis de Covoiturage</h2>
    <form action="http://localhost:3000/backend/fetch_reviews.php" method="post">
        <label for="review_id">ID de l'avis :</label>
        <input type="text" id="review_id" name="review_id" required><br><br>
        
        <label for="action">Action :</label>
        <select id="action" name="action" required>
            <option value="valider">Valider</option>
            <option value="refuser">Refuser</option>
        </select><br><br>
        
        <input type="submit" value="Soumettre">
    </form>



<?php
$host = "127.0.0.1"; 
$user = "root"; 
$password = ""; 
$database = "ecoride";
// Exemple de données d'avis de trajet
$avis= [
    ['id' => 1, 'description' => 'Trajet parfait, Jean est très agréable, très arrangeant et réactif. Un grand merci!'],
    ['id' => 2, 'description' => 'Trajet très bien passé avec Jean. ponctuel et très bonne conduite! Je recommande!.']
];

// Vérification si un avis a été sélectionné
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_avis'])) {
    $Idavis = $_POST['id_avis'];
    $avisSelectionne = array_filter($avis, fn($avis) => $avis['id'] == $Idavis);
    if (!empty($avisSelectionne)) {
        $avisSelectionne = array_values($avisSelectionne)[0];
        echo "<p>Avis sélectionné : {$avisSelectionne['description']}</p>";
    } else {
        echo "<p>Avis non trouvé.</p>";
    }
}
?>


    <h3>Sélectionnez un avis de trajet</h3>
    <form action=" process_review.php" method="POST">
        <?php foreach ($avis as $avis): ?>
            <div>
                <label>
                    <input type="radio" name="id_avis" value="<?= $avis['id'] ?>">
                    <?= htmlspecialchars($avis['description']) ?>
                </label>
            </div>
        <?php endforeach; ?>
        
        <input type="submit" value="Sélectionner">
        
    </form>
        
    </div>
</body>
</html>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Visionner les covoiturages problématiques</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des covoiturages problématiques</h1>
    <table>
        <thead>
            <tr>
                <th>id covoiturage</th>
                <th>pseudo chauffeur</th>
                <th>email chauffeur</th>
                <th>pseudo passager</th>
                <th>email passager</th>
                <th>date départ</th>
                <th>date d'arrivée</th>
                <th>descriptif du trajet</th>
            </tr>
        </thead>
        <tbody>
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

            // Requête pour obtenir les covoiturages problématiques
            $sql = "SELECT id_covoiturage, pseudo chauffeur, email chauffeur, pseudo passager, email passager, date_départ, date_d'arrivée, descriptif du trajet FROM covoiturage WHERE descriptif du trajet IS NOT NULL";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                // Afficher les données de chaque ligne
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id_covoiturage"]. "</td><td>" . $row["pseudo chauffeur"]. "</td><td>" . $row["email chauffeur"]. "</td> <td>" . $row["pseudo passager"]. "</td> <td>" . $row["email passager"]. "</td> <td>" . $row["date départ"]. "</td> <td>" . $row["date d'arrivée"]. "</td> <td>" . $row["descriptif du trajet"]. "</td></tr>";
                     echo "<div class='avis'>";
        echo "<h3>" . htmlspecialchars($row["id_covoiturage" ]) . "</h3>";
        echo "<p>" . htmlspecialchars($row["Pseudo chauffeur"]) . "</p>";
        echo "<small>" . htmlspecialchars($row["Email Chauffeur"]) . "</small>";
        echo "<p>" . htmlspecialchars($row["Pseudo Passager"]) . "</p>";
        echo "<small>" . htmlspecialchars($row["Email Passager"]) . "</small>";
        echo "<p>" . htmlspecialchars($row["date départ"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["Date d'arrivée"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["descriptif du trajet"]) . "</p>";
        echo "<form action='process_review.php' method='post'>";
        echo "<input type='hidden' name='review_id' value='" . htmlspecialchars($row["id_covoiturage"]) . "'>";
        echo "<input type='submit' name='action' value='valider'>";
        echo "<input type='submit' name='action' value='refuser'>";
        echo "</form>";
        echo "<p>" . htmlspecialchars($row["statut"]) . "</p>";
        echo "</div>";
                }
            } else {
                echo "<tr><td colspan='8'>Aucun covoiturage problématique trouvé</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
