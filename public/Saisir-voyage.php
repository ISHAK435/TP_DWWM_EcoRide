<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Saisir-voyage</title>
        <link href="styles.css" rel="stylesheet">
        <link rel="stylesheet" media="screen and (min-width: 768px) and (max-width: 1025px)" href="styles-tablet.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
       
    </head>
    <body>
        <nav class="nav | padding ">
            <a href="US1 Accueil.html"> <img src="img\electric-vehicle_17165746.png" class="imglogo" alt="logo EcoRide" >
            </a> 
                    <ul class="nav-links" id="nav-links">
                   <a href="US1 Accueil.html" >Accueil</a>
                  <a href="Vue covoiturages.html" >Covoiturages</a>
                  <a href="contact.html" >Contact</a>
                  <a href="login.html">
                  <button class="button">Connexion</button>
                    </a>
                </ul>
                </nav>

                <header>
                   
                
                    <h1 class="Clacul-trajet">Organisez votre voyage </h1>
                    <div class="organize">
                         <main class="main02">
                        <form action="publier_trajet.php" method="post">
                               <div class="Mon-depart">
                            <input type="text" name="depart" id="depart-input" list="depart-suggestions" placeholder="Départ" class="Mon-depart" value>
                               </div>
        <datalist id="depart-suggestions">
            <option value="Paris"></option>
            <option value="Nîmes"></option>
            <option value="Nice"></option>
            <option value="Marseille"></option>
            <option value="Lyon"></option>
            <option value="Caen"></option>
            <option value="Toulouses"></option>
            <option value="Grenoble"></option>
            <option value="Strasbourg"></option>
            <option value="Toulon"></option>
            <option value="Nantes"></option>
            <option value="Montpellier"></option>
            <option value="Bordeaux"></option>
            <option value="Annecy"></option>
            <option value="Lille"></option>
            <option value="Valence"></option>
            </datalist>
            
                        <input type="text" name="arriver" id="arriver-input" list="arriver-suggetions" placeholder="Destination" class="arriver" value>
                      

            <datalist id="arriver-suggetions">
                <option value="Paris"></option>
                <option value="Nîmes"></option>
                <option value="Nice"></option>
                <option value="Marseille"></option>
                <option value="Lyon"></option>
                <option value="Caen"></option>
                <option value="Toulouses"></option>
                <option value="Grenoble"></option>
                <option value="Strasbourg"></option>
                <option value="Toulon"></option>
                <option value="Nantes"></option>
                <option value="Montpellier"></option>
                <option value="Bordeaux"></option>
                <option value="Annecy"></option>
                <option value="Lille"></option>
                <option value="Valence"></option>
                </datalist>
              <input type="date" name="date" id="date_depart" placeholder="date" class="date_depart" value>
                <input type="number" name="prix" id="prix-passager" placeholder="prix" class="prix" value>

                <input type="text" name="véhicule" id="véhicule" list="vehicule_suggestions"     placeholder="sélectionner véhicule" class="my-vehicle" value>
                <datalist id="vehicule_suggestions">
                    <option value="peugeot 3008"></option>
                    <option value="peugeot 308"></option>
                    <option value="peugeot 5008"></option>
                    <option value="Renault scenic"></option>
                    <option value="Renault clio"></option>
                    <option value="Ford Puma"></option>
                    <option value="Ford fiesta"></option>
                    <option value="Ford focus"></option>
                    <option value="Mercedes classe A"></option>
                    <option value="Mercedes classe B"></option>
                    <option value="Citroen"></option>
                    <option value="BMW serie1"></option>
                </datalist>
             <div class="butt-publication">
                <button type="submit" name="Publier" >Publier</button>
            </div>

                        </form>
</main>


       <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Exemple de traitement des données lors de la soumission
    $depart = $_POST['depart'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $date = $_POST['date'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $vehicule = $_POST['vehicule'] ?? '';

    if (!empty($depart) && !empty($destination) && !empty($date) && !empty($prix) && !empty($vehicule)) {
        // Ici, vous pouvez ajouter le code pour enregistrer le trajet dans une base de données
        echo "Trajet publié avec succès : $depart -> $destination le $date.";
    } else {
        echo "Veuillez remplir tous les champs avant de publier le trajet.";
    }
}
?>

                        </div>

                    </div>
                </div>


                </header>
                <script src="script.js"></script>
    </body>
</html>