<?php

    session_start();

    include('bd.php'); // Connexion à la base de données

 

    // S'il y a une session alors on ne retourne plus sur cette page

    if (isset($_SESSION['id'])){

        header('Location: ../index.php'); 

        exit;

    }

 

    // Si la variable "$_Post" contient des informations alors on les traitres

    if(!empty($_POST)){

        extract($_POST);

        $valid = true;

 

        // On se place sur le bon formulaire grâce au "name" de la balise "input"

        if (isset($_POST['inscription'])){

            $login  = htmlentities(trim($login)); // On récupère le login

            $nom  = htmlentities(trim($nom)); // On récupère le nom

            $prenom = htmlentities(trim($prenom)); // on récupère le prénom

            $email = htmlentities(strtolower(trim($email))); // On récupère l'email

            $mdp = trim($mdp); // On récupère le mot de passe 

            $confmdp = trim($confmdp); //  On récupère la confirmation du mot de passe

            
            //  Vérification du login

            if(empty($login)){

                $valid = false;

                $er_login = ("Le login ne peut pas être vide");

                // On vérifit que le login est dans le bon format

            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $login)){

                $valid = false;

                $er_login = "Le login n'est pas valide";

 

            }else{

                // On vérifit que le login est disponible

                $sql = "SELECT email FROM CustomerProtectedData WHERE email = ?";
                $result = mysqli_query($conn, $stmt);
 

                $alrd_used = mysqli_num_rows($result);
 

                if ($alrd_used > 0){

                    $valid = false;

                    $er_login = "Ce login existe déjà";

                }

            }  

            //  Vérification du nom

            if(empty($nom)){

                $valid = false;

                $er_nom = ("Le nom d' utilisateur ne peut pas être vide");

                // On vérifit que le nom est dans le bon format

            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $nom)){

                $valid = false;

                $er_nom = "Le nom n'est pas valide";
            }       

 

            //  Vérification du prénom

            if(empty($prenom)){

                $valid = false;

                $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");

                // On vérifit que le prenom est dans le bon format

            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $prenom)){

                $valid = false;

                $er_prenom = "Le prenom n'est pas valide";
            }        

 

            // Vérification de l'email

            if(empty($email)){

                $valid = false;

                $er_email = "L'email ne peut pas être vide";

 

                // On vérifit que l'email est dans le bon format

            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)){

                $valid = false;

                $er_email = "L'email n'est pas valide";

 

            }else{

                // On vérifit que le mail est disponible

                $sql = "SELECT email FROM CustomerProtectedData WHERE email = ?";
                $result = mysqli_query($conn, $stmt);
 

                $alrd_used = mysqli_num_rows($result);

 

                if ($alrd_used > 0){

                    $valid = false;

                    $er_email = "Cet email existe déjà";

                }

            }

 

            // Vérification du mot de passe

            if(empty($mdp)) {

                $valid = false;

                $er_mdp = "Le mot de passe ne peut pas être vide";

 

            }elseif($mdp != $confmdp){

                $valid = false;

                $er_mdp = "La confirmation du mot de passe ne correspond pas";

            }

 

            // Si toutes les conditions sont remplies alors on fait le traitement

            if($valid){

                // Insert dans la table "Customer"
                $stmt = mysqli_prepare($conn, "INSERT INTO Customer(login,stash,password) VALUES (?,0,?)");
                $hashed_password = password_hash($mdp,PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"ss",$login,$hashed_password);
                mysqli_stmt_execute($stmt);


                // Si Insertion possible
                if (mysqli_stmt_affected_rows($stmt) === 1) {
                    $stmt = mysqli_prepare($conn, "SELECT id 
                                                   FROM Customer 
                                                   WHERE login = ?");

                    mysqli_stmt_bind_param($stmt,'s',$login);
                    mysqli_stmt_execute($stmt);

                    $table = mysqli_stmt_get_result($stmt);
                    $tuple = mysqli_fetch_assoc($table);
                    $id = $tuple['id'];


                    $stmt = mysqli_prepare("INSERT INTO CustomerProtectedData(id, surname, firstName, email) 
                                            VALUES (?,?,?,?)");

                    mysqli_stmt_bind_param($stmt,"isss",$id,$nom,$prenom,$email);
                    mysqli_stmt_execute($stmt);
                    $_SESSION['id'] = $id;
                    header('Location : ./profile.php');
                }

            }

        }

    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription</title>
    </head>
    <body>      
        <div>Inscription</div>
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
                // S'il y a une erreur sur le nom alors on affiche
                if (isset($er_nom)){
                ?>
                    <div><?= $er_nom ?></div>
                <?php   
                }
            ?>
            <input type="text" placeholder="Votre nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required>   
            <?php
                if (isset($er_prenom)){
                ?>
                    <div><?= $er_prenom ?></div>
                <?php   
                }
            ?>
            <input type="text" placeholder="Votre prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>" required>   
            <?php
                if (isset($er_email)){
                ?>
                    <div><?= $er_email ?></div>
                <?php   
                }
            ?>
            <input type="email" placeholder="Adresse mail" name="email" value="<?php if(isset($email)){ echo $email; }?>" required>
            <?php
                if (isset($er_mdp)){
                ?>
                    <div><?= $er_mdp ?></div>
                <?php   
                }
            ?>
            <input type="password" placeholder="Mot de passe" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required>
            <input type="password" placeholder="Confirmer le mot de passe" name="confmdp" required>
            <button type="submit" name="inscription">Envoyer</button>
        </form>
    </body>

</html>
