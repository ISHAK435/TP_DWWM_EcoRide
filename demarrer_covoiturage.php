<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Démarrer et arrêter Covoiturage</title>
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" media="screen and (min-width: 768px) and (max-width: 1025px)" href="styles-tablet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
</head>
<header>
    

        <a href="index.html"> <img src="img\electric-vehicle_17165746.png" class="imglogo" alt="logo EcoRide" >
        </a> 
<nav>
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
</nav>
<script>
    document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("menu2");

  menuToggle.addEventListener("click", () => {
    menu.classList.toggle("open");
  });
});

</script>


</header>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 30px;
        }
        .start button {

          position:relative;
          display: flex;
            align-items: center;
            bottom: 20px;
           justify-content: center;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            background-color: #28a745;
        }
      .send  form {
margin: 0 auto;
width: 600px;
padding: 1em;
border: 1px solid #ccc;
border-radius: 1em;
}
.send ul {
list-style: none;
padding: 0;
margin: 0;
}
.send label {
display: inline-block;
width: 180px;
text-align: right;
}
.send input, textarea {
    width: 200px;
    padding: 8px;
    border: 1px solid #403c3c;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 3px;
    margin-bottom: 8px;
    margin-right:5px;
    margin-left: 5px;
    resize: vertical;
    background-color: rgb(136, 165, 219);
}
.send button {
background-color: #28a745;
position: relative;
display: flex;

}

    </style>
    <h1>Démarrer un Covoiturage</h1>
    <div class="send">
    <form action="/frontend/start_covoiturage.php" method="post">
        
        
        <label for="driver_name">ID chauffeur </label>
        <input type="text" id="driver_name" name="driver_name" required><br><br>
       
        
        <label for="id_covoiturage">ID du covoiturage </label>
        <input type="text" id="id_covoiturage" name="id_covoiturage" required><br><br>
        
        
        
        <label for="departure">Lieu de départ </label>
        <input type="text" id="departure" name="departure" required><br><br>
       
        <label for="departure_time">Date de départ </label>
        <input type="datetime-local" id="departure_time" name="departure_time" required><br><br>

        
        <label for="destination">Destination </label>
        <input type="text" id="destination" name="destination" required><br><br>
        

        <label for="arrival_time">Date d'arrivée </label>
        <input type="datetime-local" id="arrival_time" name="arrival_time" required><br><br>
        
       
        <label for="passenger_count">Nombre de passagers </label>
        <input type="number" id="passenger_count" name="passenger_count" min="1" required><br><br>
       
       
        <label for="price_per_person">Prix par personne</label>
        <input type="number" id="price_per_person" name="price_per_person" min="0" step="0.01" required><br><br>
       
    
        <div class="start">
            <form action="/frontend/start_covoiturage.php" method="post">
                <button type="submit" name="action" value="start">Démarrer</button>
            </form>
    </div> 
    <div class="arrival"></div>
       <form action="/frontend/arrival_covoiturage.php" method="POST">
        <button type="submit" name="arrivee">Arriver</button>
    </form>



    <h2>Envoyer un message</h2>
    
    <form action="/frontend/start_covoiturage.php" method="post">
        
        
       <div class="email">
         
        
        Email <input type="text" name="email" placeholder="email" required><br>

       objet <input type="text" name="subject" placeholder="objet" required><br>

       Message <input type="text" name="message" placeholder="message" required><br>

          <button type="submit" name="send">Envoyer</button>
          </div>
      </form>
    </br>
   </div>
        </form>
</div>
    </div>
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
document.location.href = 'frontend/start_covoiturage.php';
</script>";
}
?>
</body>
</html>


