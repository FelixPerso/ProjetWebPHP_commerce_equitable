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

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
        <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/inscConn.css'>
        <title>Connexion</title>
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
                        <li class="items"><a href="../index.php" class="inscrit">Accueil</a></li>
                        <li class="items"><a href="./achat.php" class="achat">Achat</a></li>
                        <li class="items"><a href="./vente.php" class="vente">Vente</a></li>
                        <li class="items"><a href="./profil.php" class="profil">Mon profil</a></li>
                        <div class="page-actuelle"><li class="items">Connexion</li></div>
                        <li class="items"><a href="./Inscription.php" class="inscrit">Inscription</a></li>
                    </ul>
                </div>
            </header>  
        </section>   
        <div class="rectangle1">
            <h3>Connexion</h3>
            <form class="formulaire" method="post">
                <?php
                        // S'il y a une erreur sur le login alors on affiche
                        if (isset($er_login)){
                        ?>
                            <div><?= $er_login ?></div>
                        <?php   
                        }
                ?>
                <input type="text" placeholder="Votre login" id="login" name="login" value="<?php if(isset($login)){ echo $login; }?>" required>  <br><br> 
                <?php
                        if (isset($er_mdp)){
                        ?>
                            <div><?= $er_mdp ?></div>
                        <?php   
                        }
                ?>
                <input type="password" placeholder="Mot de passe" id="mdp" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required><br><br><br>
                <button type="submit" id="bouton" name="connexion">CONNEXION</button>
            </form>
        </div>
        <div class="rectangle2">
            <p>Vous n'avez pas de compte ? <a href="./inscription.php">Inscrivez-vous !</a></p>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="../assets/javascript/transitionBurger.js"></script>
        
    </body>

</html>