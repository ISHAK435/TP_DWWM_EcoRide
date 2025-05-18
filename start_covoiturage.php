<?php
$host = '127.0.0.1';
$db = 'ecoride';
$user = 'root';
$pass = '';
if(isset($_POST['driver_name']) && isset($_POST['id_covoiturage']) && isset($_POST['departer']) && isset($_POST['destination']) && isset($_POST['departure_time']) && isset($_POST['passenger_count']) && isset($_POST['price_per_person'])){
    var_dump($_POST);
    $driver_name = $_POST["driver_name"];
    $id_covoiturage = $_POST["id_covoiturage"];
    $departure = $_POST["departure"];
    $destination = $_POST["destination"];
    $departure_time = $_POST["departure_time"];
    $passenger_count = $_POST["passenger_count"];
    $price_per_person = $_POST["price_per_person"];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        echo " Vous étes connecté!";
    } catch (PDOException $e) {
        echo "Connection echouée: " . $e->getMessage();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $driver_name = htmlspecialchars($_POST['driver_name']);
    $id_covoiturage = htmlspecialchars($_POST['id_covoiturage']);
    $departure = htmlspecialchars($_POST['departure']);
    $destination = htmlspecialchars($_POST['destination']);
    $departure_time = htmlspecialchars($_POST['departure_time']);
    $passenger_count = htmlspecialchars($_POST['passenger_count']);
    $price_per_person = htmlspecialchars($_POST['price_per_person']);
   
   

    // Traitement des données (par exemple, les enregistrer dans une base de données)
    // Pour cet exemple, nous allons simplement afficher les informations

    echo "<h1>Covoiturage Démarré</h1>";

    echo "<p>chauffeur: " . $driver_name. "</p>";
    echo "<p>id_covoiturage : " . $id_covoiturage . "</p>";
    echo "<p>Lieu de départ : " . $departure . "</p>";
    echo "<p>Destination : " . $destination . "</p>";
    echo "<p>Heure de départ : " . $departure_time . "</p>";
    echo "<p>Nombre de passagers : " . $passenger_count . "</p>";
    echo "<p>Prix par personne : " . $price_per_person . " €</p>";
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'start') {
        echo "Le covoiturage a démarré.";
// le code pour enregistrer l'heure de départ, etc.
$heure_depart = date("Y-m-d H:i:s");
    }  else {
        echo "Action non reconnue.";
    }
} 
?>

<?php
$host = '127.0.0.1';
$dbname = 'ecoride';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Enregistrement de l'heure de départ
$heure_depart = date("Y-m-d H:i:s");

$sql = "INSERT INTO covoiturage (heure_depart) VALUES (:heure_depart)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':heure_depart', $heure_depart, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo "Heure de départ enregistrée : " . $heure_depart;
} else {
    echo "Erreur lors de l'enregistrement.";
}


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
document.location.href = 'start_covoiturage.php';
</script>";
}

?>

