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


        $sql = "SELECT mdp FROM Customer WHERE login='$login'";
        $res = mysqli_query($conn,$sql);

            if ($res) {
                $row = mysqli_fetch_assoc($res);
                $hashed_mdp = $row['mdp'];
                

                if (password_verify($mdp,$hashed_mdp)) {
                    echo "OK";
                }
                else
                    echo "PAS OK";
            }
            else
                die("error !!");

        if (password_verify($mdp,$hashed_mdp)) {
            //$_SESSION ["cles_session"] = $row["id"];
            echo "OK";
        }
        else
            echo "PAS OK";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connexion</title>
    </head>
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
    </body>

</html>

