
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

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Double Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            justify-content: space-between;
        }
        .button {
            display: block;
            width: 20%;
            padding: 10px;
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #218838;
        }
    </style>

<body>
    <div class="container">
        <h1>Utilisation des Crédits</h1>
        <p>Vous avez demandé à utiliser <strong>2 crédits</strong>.</p>
        <button class="button" onclick="confirmCredits()">Confirmer</button>
    </div>

    <script>
        function confirmCredits() {
            if (confirm("Êtes-vous sûr de vouloir utiliser 2 crédits ?")) {
                if (confirm("Ceci est votre dernière chance de confirmer. Voulez-vous vraiment utiliser 2 crédits ?")) {
                    alert("Crédits utilisés avec succès !");
                    // Ajoutez ici le code pour traiter l'utilisation des crédits
                    // Par exemple, mettre à jour la base de données ou l'interface utilisateur
                    
                } else {
                    alert("Utilisation des crédits annulée.");
                }
            } else {
                alert("Utilisation des crédits annulée.");
            }
        }
</script>

<div>


<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 30px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .credit {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>

<br>
    <div class="container">
        <h2>Confirmation enregistrée</h2>
        <form id="confirmationForm">
            <div class="form-group">
                <label for="passengerName">Nom du Passager:</label>
                <input type="text" id="passengerName" name="passengerName" required>
            </div>
            <div class="form-group">
                <label for="tripId">ID du Trajet:</label>
                <input type="text" id="tripId" name="tripId" required>
            </div>
            <div class="form-group">
                <label for="credit">Crédit Actuel:</label>
                <input type="number" id="credit" name="credit" required>
            </div>
            <div class="form-group">
                <button type="submit">Confirmer</button>
            </div>
        </form>
        <div class="credit" id="updatedCredit">
            <!-- Le crédit mis à jour sera affiché ici -->
        </div>
    </div>

    <script>
        document.getElementById('confirmationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const passengerName = document.getElementById('passengerName').value;
            const tripId = document.getElementById('tripId').value;
            let credit = parseFloat(document.getElementById('credit').value);

            // Mise à jour du crédit (par exemple, ajout de 10 crédits)
            credit -= 2;

            document.getElementById('updatedCredit').innerHTML = `
                <p>Confirmation réussie pour ${passengerName} (ID du trajet: ${tripId}).</p>
                <p>Crédit mis à jour: ${credit} crédits.</p>
            `;
        });
    </script>
    </br>
</div>
</head>
</body>
</html>