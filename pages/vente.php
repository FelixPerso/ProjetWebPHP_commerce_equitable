<?php 
    include 'bd.php';
    session_start();

    if(!isset($_SESSION['cle_id']))
        echo "connexion impossible";

    else {
        $id = $_SESSION['cle_id'];
    }
    
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
                    <li class="items"><a href="./connexion.php" class="connexion">Connexion</a></li>
                </ul>
            </div>
        </header>
    </section>
    <img class="logo" src="../images/logo_IT+_.png" style="width:4%" >
    <div class="rectangle">
        <h3>Quel est votre produit ?</h3>
        <form class="formulaire" action="" method="POST">
            <div class="custom-select" style="width:300px;">
                <select id="produit" name="produit">
                    <option value="0">Type de produit :</option>
                    <?php
                        if($titre){
                            while(($titreprod = mysqli_fetch_array($titre))!=null){
                                        
                                echo"<option value='{$titreprod['id']}'>{$titreprod['name']}</option>";
                            }
                        }
                    ?>
                </select>
            </div><br><br>
            <button type="submit" id="bouton" name="boutonVendre">TROUVER UN VENDEUR</button>
                <?php

                    if(!empty($_POST)){

                        extract($_POST);
                        $valid = true;

                        if (isset($_POST['boutonVendre'])) {
                            $titreprod  = $_POST['produit']; // On recupere le type produit selectionné
                           

                            if(empty($produit)){

                                $valid = false;
                                $er_nom = ("La quantite ne peut pas être vide");

                            }

                            
                            if ($valid) {
                                      
                                // on cherche l'id du produit de la table TypeItem
                                $stmt = mysqli_prepare($conn,"SELECT id FROM TypeItem WHERE id=?");
                                mysqli_stmt_bind_param($stmt,'i',$titreprod);
                                mysqli_stmt_execute($stmt);
                                // on recupère l'id du produit de la table TypeItem 
                                $table = mysqli_stmt_get_result($stmt);
                                $tuple = mysqli_fetch_assoc($table);
                                $titreprodId = $tuple['id'];
                                $_SESSION['cle_typeProduit'] = $titreprodId;
                                header('Location:./vendeur.php');

                            }
                        }
                    echo "<p style='padding-bottom:2%; font-size:14pt;'><b>Veuillez selectionner un produit !</b></p>";

                    }else{

                        $valid = false;
                    }
                ?>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    <script src="../assets/javascript/menuSelectionVente.js"></script>

</body>
</html>