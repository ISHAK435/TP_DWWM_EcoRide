<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen and (min-width: 768px) and (max-width: 1025px)" href="styles-tablet.css">
    <link href="styles.css" rel="stylesheet">
    <title>historique Covoiturage</title>
    </head>
<body>
   <div class="overlay | hidden "></div>
<nav class="nav | ">
    <a href="index.html"> 
        <img src="img\electric-vehicle_17165746.png" class="imglogo" alt="logo EcoRide" >
    </a>
    <!--hamberguer menu--> 
    <button class="mobil-open-modal">
        <span>
            <img src="img\list_12227852.png" alt="open Menu">
        </span>
    </button>
<!--nav list-->
<div class="nav-links">
<ul class="nav-links" id="nav-links">
<a href="index.html" >Accueil</a>
  <a href="vue_covoiturages.html" >Covoiturages</a>
    <a href="contact.html" >Contact</a>
    <a href="login.html">
    <button class="button">Connexion</button>
    </a>
</ul>
</div>

</nav>

<!--menu-->
<div class="menu | hidden">
    <button>
        <span calss="mobil-close-model">
            <img src="img\letter-x_5584845.png" alt="Close Menu">
        </span>
    </button>
    <div class="mobile-nav-links">
<ul class="mobile-nav-links">
    <a href="index.html" >Accueil</a>
    <a href="vue_covoiturages.html" >Covoiturages</a>
    <a href="contact.html" >Contact</a>
    <a href="login.html">
    <button class="button">Connexion</button>
    </a>
</ul>

</div>
</div>

<header>

    
<div class="history">
<?php
// Connexion à la base de données
$host = '127.0.0.1';
$db = 'ecoride';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
// ID de l'utilisateur dont on veut afficher l'historique
$id_utilisateur = 1;
// Requête pour récupérer l'historique des covoiturages
$sql = "SELECT  id_covoiturage, date_depart, heure_depart, lieu_depart, date_arrivee, heure_arrivee, lieu_arrivee, statut, nb_place, prix_personne, id_utilisateur FROM covoiturage WHERE id_utilisateur = :id_utilisateur";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
$stmt->execute();
$covoiturage = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($covoiturage) {
    echo "<h1>Historique des covoiturages</h1>";
    echo "<table border='1'>";
    echo "<tr><th>id_covoiturage</th><th>date_depart</th><th>heure_depart</th><th>lieu_depart</th><th>date_arrivee</th><th>heure_arrivee</th><th>lieu_arrivee</th><th>statut</th><th>nb_place</th><th>Prix_personne</th><th>id_utilisateur</th></tr>";
    foreach ($covoiturage as $covoiturage) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($covoiturage['id_covoiturage']) . " </td>";
        echo "<td>" . htmlspecialchars($covoiturage['date_depart']) . "</td>";
        echo "<td>" . htmlspecialchars($covoiturage['heure_depart']) . "</td>";
        echo "<td>" . htmlspecialchars($covoiturage['lieu_depart']) . "</td>";
        echo "<td>" . htmlspecialchars($covoiturage['date_arrivee']) . "</td>";
        echo "<td>" . htmlspecialchars($covoiturage['heure_arrivee']) . "</td>";
        echo "<td>" . htmlspecialchars($covoiturage['lieu_arrivee']) . "</td>";
        echo "<td>" . htmlspecialchars($covoiturage['statut']) . "</td>";
        echo "<td>" . htmlspecialchars($covoiturage['nb_place']) . "</td>";
        echo "<td>" . htmlspecialchars($covoiturage['prix_personne']) . " €</td>";
        echo "<td>" . htmlspecialchars($covoiturage['id_utilisateur']) . " </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Aucun covoiturage trouvé pour cet utilisateur.</p>";
}
?>
</div>
<div class="cancel">
    <h2>Annuler votre trajet</h2>
<form action="annuler_covoiturage.php" method="post">
        <input type="hidden" name="id_covoiturage" value="id_covoiturage"> 
        
        <button type="submit">Annuler Covoiturage</button>
        <button type="submit">Modifier le nombre de places</button>
    </form>
</div>

<br>


<div class="container_mail">
    <h1>Envoyer un email aux participants</h1>
    <form  action="" method="post">
        Email <input type="email" name="email" value="" required><br>
          Subject <input type="text" name="subject" value="" required><br>
          Messsage <input type="text" name="message" value="" required><br>
          <button type="submit" name="send">Envoyer</button>
          </div>
      </form>


</header>
      <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
if(isset($_POST['send'])) {
    // Connexion à la base de données
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth= true;
    $mail->Username = 'aliamira930@gmail.com';
    $mail->Password = 'zzoxluguwpkhjkfx';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('aliamira930@gmail.com');
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);
    $mail->Subject = $_POST['sujet'];
    $mail->Body = $_POST['message'];
    $mail->send();
    
    echo
"<script>alert('Email envoyé avec succès');
document.location.href = 'annuler_covoiturage.php';
</script>";
}
?>

  <hr>
        <footer class="footer ">
         <p>EcoRide@covoiturage.fr</p>
        <a href="https://blog.EcoRide.fr/about-us/terms-and-condition" target="-blank" class="link">Mentions Legales</a>
        </footer>
   
    </hr>
</body>
</html>


