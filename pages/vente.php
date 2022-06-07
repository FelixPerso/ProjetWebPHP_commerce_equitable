<?php 
    include 'bd.php';
    //session_start();
    $iduser = 1;//$_SESSION["cle_session"];
    $titre = mysqli_query($conn,"SELECT * FROM TypeItem ORDER BY id ASC ");
    $pays = mysqli_query($conn,"SELECT DISTINCT country FROM Business ORDER BY country ASC ");
?>
<!DOCTYPE HTML>
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
        <form class="formulaire" action="">
            <div class="custom-select" style="width:200px;">
                <select>
                    <option value="0">Type de produit :</option>
                    <?php
                        if($titre){
                                    while(($titreprod = mysqli_fetch_array($titre))!=null)
                                    {
                                        echo"<option value='{$titreprod['id']}'>{$titreprod['name']}</option>";
                                    }
                            }
                    ?>
                </select>
            </div><br>
            <label for="quantite">Quantité :</label><br>
            <input type="number" id="quantite" name="quantite" value=""><br><br>
            <label for="prix">Prix de l'offre (€) :</label><br>
            <input type="number" id="prix" name="prix" value=""><br><br><br>
            <input type="submit" id="bouton" value="VENDRE">
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    <script src="../assets/javascript/menuSelectionVente.js"></script>

</body>
</html>