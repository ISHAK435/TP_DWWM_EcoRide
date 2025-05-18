<?php
$host='127.0.0.1';
$db = 'ecoride';
$username = 'root';
$password = '';

$bdd = new mysqli("127.0.0.1", "root", "");
$admin = $bdd->query('SELECT * FROM admin');

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Espace Administrateur</title>
        <link href="styles.css" rel="stylesheet">
        <link rel="stylesheet" media="screen and (min-width: 768px) and (max-width: 1025px)" href="styles-tablet.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
       
    </head>
    <body>
        <nav class="nav |  ">
            <a href="/frontend/index.html"> <img src="img\electric-vehicle_17165746.png" class="imglogo" alt="logo EcoRide" >
            </a> 
            
                    <ul class="nav-links" id="nav-links">
                   <a href="/frontend/index.html" >Accueil</a>
                  <a href="/frontend/vue_covoiturages.html" >Covoiturages</a>
                  <a href="/frontend/contact.html" >Contact</a>
                  <a href="/frontend/login.php">
                  <button class="button">Connexion</button>
                    </a>

 <div class="menu_button">
<button id="menu-toggle" class="menu-button">☰</button>
    <nav id="menu2" class="menu2">
      <ul>
        <li><a href="/frontend/index.html">Accueil</a></li>
        <li><a href="/frontend/vue_covoiturages.html">Covoiturages</a></li>
        <li><a href="/frontend/contact.html">Contact</a></li>
        <form action="verification.php" method="post">
      <li><a href="/frontend/login.html">Déconnecter</a></li>
        </form>
      </ul>
    </nav>
    </div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("menu2");

  menuToggle.addEventListener("click", () => {
    menu.classList.toggle("open");
  });
});

</script>
 </ul>
 </nav>
<header>
    
           <div class="container03">
            
                <h1>Bienvenue dans l'espace administrateur</h1>
            <h1>Créer un compte employé</h1>
    <form action="ajouter_employe.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Créer</button>
    </form>
            </div>   

            <div class="container04">
<h2>Suspendre un compte utilisateur</h2>
    <form action="suspend_user.php" method="post">
        <label for="user_id">ID de l'utilisateur :</label>
        <input type="text" id="user_id" name="user_id" required>
        <button type="submit">Supprimer</button>
    </form>
</div>
</div>
</header>
        </body>
        </html>


        <?php
// Connexion à la base de données
$host = '127.0.0.1';
$db = 'ecoride';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Requête SQL pour compter les covoiturages par jour
$sql = "SELECT date_depart, COUNT(*) as total FROM covoiturage GROUP BY date_depart ORDER BY date_depart";
$stmt = $pdo->query($sql);

$dates = [];
$totals = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dates[] = $row['date_depart'];
    $totals[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques Covoiturage</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="canva">
    <h2>Nombre de covoiturages par jour</h2>
    <canvas id="graphiqueCovoiturage" width="" height=""></canvas>
    </div>
    <script>
        const ctx = document.getElementById('graphiqueCovoiturage').getContext('2d');
        const graphique = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'Covoiturages par jour',
                    data: <?php echo json_encode($totals); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de covoiturages'
                        }
                    }
                }
            }
        });



    </script>


</body>
</html>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crédits de covoiturage</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="canavas2">
        <h3>Crédits de EcoRide</h3>
    <canvas id="covoiturageChart"></canvas>
    </div>
    <script>
       const labels = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
        const creditsParJour = [9, 10, 33, 11, 25, 6, 8];  // Exemple de crédits gagnés chaque jour
        const totalCredits = creditsParJour.map((sum => value => sum += value)(0)); // Calcul du total accumulé

        const data = {
            labels: labels,
            datasets: [
                {
                    label: "Crédits gagnés par jour",
                    data: creditsParJour,
                    borderColor: "blue",
                    backgroundColor: "rgba(0, 0, 255, 0.5)",
                    type: "bar"
                },
                {
                    label: "Total accumulé",
                    data: totalCredits,
                    borderColor: "green",
                    backgroundColor: "rgba(0, 255, 0, 0.5)",
                    type: "line"
                }
            ]
        };

        new Chart(document.getElementById("covoiturageChart"), {
            type: "bar",
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
    <br>
</body>
</html>