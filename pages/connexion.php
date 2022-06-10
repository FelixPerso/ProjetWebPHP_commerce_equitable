<?php

 session_start();


include 'bd.php';

        if(!empty($_POST)){

        extract($_POST);

        $valid = true;



        if (isset($_POST['connexion'])){
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];


$sql = "SELECT mdp,id FROM Customer WHERE login='$login'";
$res = mysqli_query($conn,$sql);

            if ($res) {
                $row = mysqli_fetch_assoc($res);
                $hashed_mdp = $row['mdp'];
                

                if (password_verify($mdp,$hashed_mdp)) {
                    echo "OK";
                    $_SESSION['cle_id'] = $row["id"];
                }
                else
                    echo "PAS OK";
            }
            else
                die("error !!");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
        <title>Connexion</title>
    </head>
            <header>
            <div class="bouton-burger">
                <div class="barre"></div>
                <div class="barre"></div>
                <div class="barre"></div>
            </div>
            <div class="nav">
                <ul class="header_barre_nav">
                    <li class="items"><a href="../index.php" class="inscrit">Accueil</a></li>
                    <li class="items"><a href="./achat.php" class="achat">Achat</a></li>
                    <li class="items"><a href="./vente.php" class="vente">Vente</a></li>
                    <li class="items"><a href="./profil.php" class="profil">Mon profil</a></li>
                    <div class="page-actuelle"><li class="items">Connexion</li></div>
                    <li class="items"><a href="./Inscription.php" class="inscrit">Inscription</a></li>
                </ul>
            </div>
        </header>
    <body>      
        <div>Connexion</div>
        <form method="post">
            <?php
                // S'il y a une erreur sur le login alors on affiche
                if (isset($er_login)){
                ?>
                    <div><?= $er_login ?></div>
                <?php   
                }
            ?>
            <input type="text" placeholder="Votre login" name="login" value="<?php if(isset($login)){ echo $login; }?>" required>

            
            <?php
                if (isset($er_mdp)){
                ?>
                    <div><?= $er_mdp ?></div>
                <?php   
                }
            ?>
            <input type="password" placeholder="Mot de passe" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required>

            <button type="submit" name="connexion">Envoyer</button>
        </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    </body>


</html>

