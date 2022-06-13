<?php 
    include 'bd.php';
    session_start();
    if(!isset($_SESSION['cle_id'])){
        echo "connexion impossible";
    } else {
        $id = $_SESSION['cle_id'];
    }
    
    $titre = mysqli_query($conn,"SELECT * FROM TypeItem ORDER BY id ASC ");
    $vendeurs = mysqli_query($conn,"SELECT name,price FROM Business NATURAL JOIN BusinessSell");
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+ - Trouver un vendeur</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/vendeur.css'>
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
                    <li class="items"><a href="./vente.php" class="vente">Vente</a></li>
                    <li class="items"><a href="./profil.php" class="profil">Mon profil</a></li>
                    <li class="items"><a href="./connexion.php" class="connexion">Connexion</a></li>
                </ul>
            </div>
        </header>
    </section>
    <div class="rectangle">
        <h3>Trouver un vendeur</h3>
        <form class="formulaire" action="" method="POST">
            <div class="custom-select" style="width:300px;">
                <select name="produit">
                    <option value="0">Vendeurs :</option>
                    <?php
                        if($vendeurs){
                                    while(($namevendeurs = mysqli_fetch_array($vendeurs))!=null)
                                    {
                                        echo"<option value='{$namevendeurs['name']}'>{$namevendeurs['name']} - {$namevendeurs['price']}€ </option>";
                                    }
                            }
                    ?>
                </select>
            </div><br><br>
            <input type="number" placeholder="Quantité" id="quantite" name="quantite" value=""><br><br><br>
            <button type="submit" id="bouton" name="boutonVendre">VENDRE</button>
            <?php

                    if(!empty($_POST)){

                    extract($_POST);
                    $valid = true;

                    if (isset($_POST['boutonVendre'])) {
                       
                        $quantite = $_POST['quantite'];
                        $titreprod = $_POST['produit'];
                        $prixUnit = $_POST['prix'];
                        $prixTot = $prixUnit * $quantite ;

                    if(empty($quantite)){

                    $valid = false;

                    $er_nom = ("La quantite ne peut pas être vide");
                    }
                        
                            if ($valid) {
                                
                        
                            // on mets à jour la cagnotte de l'utilisateur    
                            $stmt = mysqli_prepare($conn,"UPDATE Customer SET stash = stash + ? WHERE id=? ");
                            mysqli_stmt_bind_param($stmt,'ii',$prixTot,$id);
                            mysqli_stmt_execute($stmt);


                            
                            // on cherche l'id du produit de la table TypeItem
                            $stmt = mysqli_prepare($conn,"SELECT id FROM TypeItem WHERE id=?");
                            mysqli_stmt_bind_param($stmt,'i',$titreprod);
                            mysqli_stmt_execute($stmt);
                            // on recupère l'id du produit de la table TypeItem 
                            $table = mysqli_stmt_get_result($stmt);
                            $tuple = mysqli_fetch_assoc($table);
                            $titreprodId = $tuple['id'];

                            $request = mysqli_query($conn,"SELECT element,quantity FROM ExtractionFromTypeItem WHERE TypeItem=$titreprodId");

                            

                            if ($request) {
                                $stmt = mysqli_prepare($conn,"UPDATE CustomerExtraction SET quantity = quantity + ? WHERE Customer=? AND element=? ");
                                
                                foreach ($request as $requestas) {
                                    mysqli_stmt_bind_param($stmt,'iii',$requestas['quantity'],$id,$requestas['element']);
                                    mysqli_stmt_execute($stmt);
                        }
                    }


            
                    echo"votre profil à été mis à jour";

                        }else{
                            $valid = false;
                        }
                    }
                }
                ?>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    <script src="../assets/javascript/menuSelectionVente.js"></script>

</body>
</html>












<?php

// // Dans ce fichier, il faut : 
// 								Un liste déroulante avec les entreprises qui recherchent le produit choisis (de la page vente.php)
// 								Le prix des entreprises qui recherchent le produit choisis
// 								La quantité..
// 								Mettre les requetes sql qui permettent de calculer les extractions des matériaux et la stash.
?>