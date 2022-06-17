<?php

 session_start();
if(isset($_SESSION['cle_id'])){
        header("Location:./profil.php");
    }

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
                    // echo "OK";
                    $_SESSION['cle_id'] = $row["id"];
                    header('Location:./profil.php');
                }
                else
                    echo "Mot de passe incorect";
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
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Connexion</title>
    </head>
    <img class="w3-display-topright w3-animate-opacity" src="../images/logo_IT+_.png" style="width:4%" >
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
                        <div class="page-actuelle"><li class="items">Connexion</li></div>
                    </ul>
                </div>
            </header>  
        </section>
        <img class="logo" src="../images/logo_IT+_.png" >   
        <div class="rectangle1">
            <h3>Connexion</h3>
            <form class="formulaire" method="post">
                <?php
                        // Si il y a une erreur sur le login alors on affiche
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
            <p>Vous n'avez pas de compte ? <a href="./Inscription.php">Inscrivez-vous !</a></p>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="../assets/javascript/transitionBurger.js"></script>
        
    </body>

</html>