<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecoride";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['participer'])) {
      function verifierParticipation($conn, $id_utilisateur, $id_covoiturage) {
        $sql = "SELECT * FROM participants WHERE user_id = ? AND covoiturage_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_utilisateur, $id_covoiturage);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            echo "L'utilisateur participe déjà à ce covoiturage.";
        } else {
            echo "L'utilisateur ne participe pas à ce covoiturage.";
        }
    
        $stmt->close();
    }
    
    // Exemple d'utilisation
    verifierParticipation($conn, 1, 33);
        echo "votre  réservation a été prise en compte";
    
}
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue detail</title>
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" media="screen and (min-width: 768px) and (max-width: 1025px)" href="styles-tablet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link rel="icon" href="/img/DelftStack/favicon.png">
</head>

<body >

        
        <div class="overlay | hidden"></div>
        <nav class="nav | ">
            <a href="index.html"> 
                <img src="img\electric-vehicle_17165746.png" class="imglogo" alt="logo EcoRide" >
            </a> 
            
            <a button class="btn" href="Saisir-voyage.php">Publier un trajet</button>
          </a>
            <button class="profils" aria-label="profil" aria-controls="user-menu" arial-expanded="false" type="button">
                <span calss="avatar" data-testid="topbar-user-avatar">  
                </span>
            </button>
            
 <div class="menu_button">
<button id="menu-toggle" class="menu-button">☰</button>
    <nav id="menu2" class="menu2">
      <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="vue_covoiturages.html">Covoiturages</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="login.html">Connexion</a></li>
        <li>
        <form action="verification.php" method="post">
        <a href="login.html">Déconnecter</a></li>
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


        </nav>
         <header>
        
          <div class="container2">
            <div class="left-side">
                <!-- Contenu de la partie gauche -->
            
                
                  <div class="conducteur">
                    
                  <div class="conducteur-info">
                <img src="img\profile-picture_12225881.png" alt="photo de profil" class="conducteur-photo">
               

               <div class="profil-vérifier">
                    <img src="img\shield_11735080.png" alt="photo de profil" class="profil-vérifier">
    
                  </div>
                  <span class ="conducteur-photo">profil vérifié</span>
                  <div class="conduteur-info">
                    <p>jean</p>
                  </div>

                  <a data-testid=" details-driver" class="details-driver" href="Avis-conducteur.html">
                  <div class="avis">
                        
                    <p>4,8/5 - 30 avis </p>
                  </div>
                 
                  <div class="animated-arrow "></div>
                   </a> 
                  

              
                <div class="commentaires">
                  <p>Bonjour, j'aime bien discuter pendant le trajet ça passe plus vite.</p>
                </div>
              
              <ul>
                <li>
                 <div class="cigarettes">
                <img src="img\no-smoking_1201706.png" alt="cigarettes" class="cigarettes-photo">
                 
                    <div class="smoking">
                      <p>pas de cigarettes, SVP</p>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="preferences">
                    <img src="img\paw_10370528.png" alt="Animaux " class="preferences-photo" > 
                  </div>
                  <div class="animals">
                    <p>Animaux acceptés</p>
                  </div>
                </li>
                <li>
                  <div class="réservation">
                  <img src="img\calendar_13531347.png" alt="confirmer la réservation" class="réservation-photo">
                  </div>
                  <div class="confirmation">
                  <p> Votre réservation sera confirmée lorsque le conducteur acceptera votre demande</p>
                </div>
              </li>
          </ul>
                   
          <div class="container">
    <div class="trajet">
        <p>Nombre de places disponibles : <span id="places-disponibles">3</span></p>
        <button class="button" onclick="reserverPlace()">Réserver une place</button>
    </div>

    <script>
        function reserverPlace() {
            var placesDisponiblesElement = document.getElementById('places-disponibles');
            var placesDisponibles = parseInt(placesDisponiblesElement.textContent);

            if (placesDisponibles > 0) {
                placesDisponibles--;
                placesDisponiblesElement.textContent = placesDisponibles;

                if (placesDisponibles === 0) {
                    document.querySelector('.btn-reserver').disabled = true;
                }
            }
        }
    </script>
</div>    

      </div>
    </div>
</div>
          
         <div class="right-side">
          <div calss="vehicule">
            <img src="img\car_17357400.png" alt="photo de la voiture" class="vehicule-photo" >
            <p>Marque: Peugeot</p>
            <p>Modéle: 3008</p>
            <p>Energie utilisé: Electrique</p>
            
            <div class="duree">
              <p>Durée du trajet: 1:00h </p>
            </div>
            <div class="route">
        <p>Itinéraire: Lyon 9:00 h</p>
            </div>
            <div class="auto">
            <img src="img\purchases_2292283.png" alt="photo de la voiture" class="auto-photo" >
          </div>
            <div class="point2">
              <p> Grenoble 10:00 h</p>
            </div>
            
              <div class="bouton-participer">
                <a href="participer-covoiturage.php" class="button" >Participer</a>
                <a href="login.html" class="button" >Se Connecter</a>
                </div>
              <div class="prix-passager">
              
                <div class="passager">
                  <p>1 Passager 11&#8364</p>
                </div>
              </div>
              <div class="historique">
                <a href="historique_covoiturage.php" class="button" >Historique</a>
                </div> 
        </div>

</div>
          </div>
      
</div>
       </header>
        <script src="https://code.jqueries.com/jqueries-3.2.1.slim.min.js"></script>
        <script src = "scripts/app.js"></script>
      </body>

      <hr>
        <footer class="footer ">
        
            
              <p>EcoRide@covoiturage.fr</p>
              <a href="https://blog.EcoRide.fr/about-us/terms-and-condition" target="-blank" class="link">Mentions Legales</a>
        </footer>
   
    </hr>

</html>