<?php 
    include 'bd.php';
    session_start();

    if(!isset($_SESSION['cle_id']))
        echo "connexion impossible";
    else {

        $id = $_SESSION['cle_id'];
        $typeProduit = $_SESSION['cle_typeProduit'];
    }

    $vendeurs = mysqli_query($conn,"SELECT name,price,quantity,business FROM Business NATURAL JOIN BusinessSell WHERE typeItem=$typeProduit AND id=business");


    // on recupere la quantite des vendeurs
    if (isset($_POST['vendeurs'])) {
        $stmt = mysqli_prepare($conn,"SELECT quantity FROM Business JOIN BusinessSell ON (Business.id = BusinessSell.business) WHERE typeItem=? AND name=?");
    mysqli_stmt_bind_param($stmt,'is',$typeProduit,$_POST['vendeurs']);
    mysqli_stmt_execute($stmt);

    $table = mysqli_stmt_get_result($stmt);
    $tuple = mysqli_fetch_assoc($table);
    $quantityVendeur = $tuple['quantity'];
    }
    

    
    // on recupere les prix des vendeurs
    if (isset($_POST['vendeurs'])) {
        $stmt = mysqli_prepare($conn,"SELECT price FROM Business JOIN BusinessSell ON (Business.id = BusinessSell.business)WHERE typeItem=? AND name=?");
        mysqli_stmt_bind_param($stmt,'is',$typeProduit,$_POST['vendeurs']);
         mysqli_stmt_execute($stmt);

        $table = mysqli_stmt_get_result($stmt);
        $tuple = mysqli_fetch_assoc($table);
        $prixVendeur = (int) $tuple['price'];
    }

    // on recupere les prix des vendeurs
    if (isset($_POST['vendeurs'])) {
        $stmt = mysqli_prepare($conn,"SELECT business FROM Business JOIN BusinessSell ON (Business.id = BusinessSell.business) WHERE typeItem=? AND name=?");
        mysqli_stmt_bind_param($stmt,'is',$typeProduit,$_POST['vendeurs']);
         mysqli_stmt_execute($stmt);

        $table = mysqli_stmt_get_result($stmt);
        $tuple = mysqli_fetch_assoc($table);
        $idBusiness = (int) $tuple['business'];
    }
    



    $stmt = mysqli_prepare($conn,"SELECT name FROM Business NATURAL JOIN BusinessSell WHERE typeItem=? AND id=business");
    mysqli_stmt_bind_param($stmt,'i',$typeProduit);
    mysqli_stmt_execute($stmt);

    $table = mysqli_stmt_get_result($stmt);
    $tuple = mysqli_fetch_assoc($table);
    $namevendeurs = $tuple['name'];

    // on recupere le nom du produit sélectionner grâce à l'id récuperer par la $_SESSION
    $stmt = mysqli_prepare($conn,"SELECT name FROM TypeItem WHERE id=?");
    mysqli_stmt_bind_param($stmt,'i',$typeProduit);
    mysqli_stmt_execute($stmt);

    $table = mysqli_stmt_get_result($stmt);
    $tuple = mysqli_fetch_assoc($table);
    $nameTypeItem = $tuple['name'];
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
                <select id="vendeurs" name="vendeurs">
                    <option value="0">Vendeurs :</option>
                    <?php
                        if($vendeurs){
                            while(($namevendeurs = mysqli_fetch_array($vendeurs))!=null)
                            {
                                echo"<option value='{$namevendeurs['name']}'>{$namevendeurs['name']} - {$namevendeurs['price']}€ (x{$namevendeurs['quantity']})</option>";
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
                        $prixTot = $quantite*$prixVendeur;

                        if(empty($vendeurs)){

                            $valid = false;
                            $er_nom = ("Les vendeurs ne peut pas être vide");

                        }

                        if(empty($quantite) || $quantite>$quantityVendeur || $quantite<0){

                            $valid = false;
                            echo "<p style='padding-bottom:2%; font-size:14pt;'><b>Vous dépassez la quantité maximale demandée par l'acheteur ! Maximum: $quantityVendeur</b></p>";

                            $er_nom = ("La quantité ne peut pas être vide");
                        }
                        
                            if ($valid) {
                                
                            // on mets à jour la cagnotte de l'utilisateur    
                            $stmt = mysqli_prepare($conn,"UPDATE Customer SET stash = stash + ? WHERE id=? ");
                            mysqli_stmt_bind_param($stmt,'ii',$prixTot,$id);
                            mysqli_stmt_execute($stmt);                       

                            $request = mysqli_query($conn,"SELECT element,quantity FROM ExtractionFromTypeItem WHERE TypeItem=$typeProduit");

                                if ($request) {
                                    $stmt = mysqli_prepare($conn,"UPDATE CustomerExtraction SET quantity = quantity + ? WHERE Customer=? AND element=? ");
                                    
                                    foreach ($request as $requestas) {

                                        mysqli_stmt_bind_param($stmt,'iii',$requestas['quantity'],$id,$requestas['element']);
                                        mysqli_stmt_execute($stmt);

                                    }

                                    if ($stmt) {
                                        echo "<p style='padding-bottom:2%; font-size:14pt;'><b>Votre cagnotte a été augmentée de $prixTot € et vos métaux recyclés ont été mis à jour.</b></p>";
                                        

                                        $stmt = mysqli_prepare($conn,"UPDATE BusinessSell SET quantity = quantity - ? where business = ? AND typeItem = ? ");
                                        mysqli_stmt_bind_param($stmt,'iii',$quantite,$idBusiness,$typeProduit);
                                        mysqli_stmt_execute($stmt);


                                        $stmt = mysqli_prepare($conn,"INSERT INTO HistoriqueSell(nameEntreprise,nameProduit,Prix,Quantite,id) VALUES (?,?,?,?,?)");
                                        mysqli_stmt_bind_param($stmt,'ssiii',$_POST['vendeurs'],$nameTypeItem,$prixVendeur,$quantite,$id);
                                        mysqli_stmt_execute($stmt);
                                        echo $_POST['vendeurs'];
                                        echo $nameTypeItem;
                                        echo $prixVendeur;
                                        echo $quantite;


                                    }
                                }   

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

























