
<?php
$host = '127.0.0.1';
$dbname = 'ecoride';
$username = 'root';
$password = '';

// Vérification si le bouton a été cliqué
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['arrivee'])) {
    // Action à effectuer lorsque le bouton est cliqué
    $message = "Vous avez signalé que vous êtes arrivé à destination.";
    // Vous pouvez ajouter ici des actions supplémentaires, comme mettre à jour une base de données
}
?>


<?php
// État du trajet (par exemple, récupéré depuis une base de données)
$etatTrajet = "en_cours"; // Les valeurs possibles : "non_commence", "en_cours", "termine"

// Fonction pour afficher le bouton approprié
function afficherBouton($etatTrajet) {
    if ($etatTrajet === "non_commence") {
        echo '<button onclick="demarrerTrajet()">Démarrer</button>';
    } elseif ($etatTrajet === "en_cours") {
        echo '<button onclick="arriverTrajet()">Arriver</button>';
    } else {
        echo '<p>Trajet terminé</p>';
    }
}

// Exemple d'appel
afficherBouton($etatTrajet);
?>

<script>
// Fonctions JavaScript pour gérer les actions des boutons
function demarrerTrajet() {
    alert("Le trajet a commencé !");
    // Ici, vous pouvez ajouter une requête AJAX pour mettre à jour l'état du trajet côté serveur
    
}

function arriverTrajet() {
    alert("Vous êtes arrivé !");
    // Ici, vous pouvez ajouter une requête AJAX pour mettre à jour l'état du trajet côté serveur
}
</script>