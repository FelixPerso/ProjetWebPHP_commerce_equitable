<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+ - Vente</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/vente.css'>
</head>
<body>
    <section class="site">
        <header>
            <div class="bouton-burger">
               <div class="barre"></div>
               <div class="barre"></div>
               <div class="barre"></div>
            </div>
            <div class="nav">
                <ul class="header_barre_nav">
                    <li class="items"><a href="../index.php" class="accueil">Accueil</a></li>
                    <li class="items"><a href="./achat.php" class="achat">Achat</a></li>
                    <div class="page-actuelle"><li class="items">Vente</li></div>
                    <li class="items"><a href="./profil.php" class="profil">Mon profil</a></li>
                </ul>
            </div>
        </header>
    </section>
    <div class="rectangle">
        <h3>Mettez votre produit en vente</h3>
        <div class="custom-select" style="width:200px;">
            <select>
                <option value="0">Type de produit :</option>
                <option value="1">Téléphone</option>
                <option value="2">Ordinateur portable</option>
                <option value="3">Ordinateur fixe</option>
                <option value="4">Clavier</option>
                <option value="5">Souris</option>
                <option value="6">Casque</option>
                <option value="7">RAM</option>
                <option value="8">Processeur</option>
                <option value="9">Carte graphique</option>
                <option value="10">Ecran</option>
            </select>
        </div>
        <form class="formulaire" action="">
            <label for="nom-offre">Nom de l'offre :</label><br>
            <input type="text" id="nom-offre" name="nom-offre" value=""><br><br><br>
            <label for="prenom">Prénom du vendeur :</label><br>
            <input type="text" id="prenom" name="prenom" value=""><br><br>
            <label for="nom-famille">Nom de famille du vendeur :</label><br>
            <input type="text" id="nom-famille" name="nom-famille" value=""><br><br><br>
            <label for="prix">Prix de l'offre (€) :</label><br>
            <input type="number" id="prix" name="prix" value=""><br><br>
            <!-- <input type="submit" value="Submit"> -->
        </form> 
        <a href="">
            <div class="bouton">
                <p>VENDRE</p>
            </div>
        </a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    <script src="../assets/javascript/menuSelectionVente.js"></script>

</body>
</html>