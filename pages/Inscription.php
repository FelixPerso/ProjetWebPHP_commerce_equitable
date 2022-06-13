<?php

    session_start();

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    include 'bd.php'; // Connexion à la base de données

 

    // Si il y a une session alors on ne retourne plus sur cette page

    if (isset($_SESSION['cle_id'])){

        header('Location: ../index.php'); 

        exit;

    }

 

    // Si la variable "$_Post" contient des informations alors on les traites

    if(!empty($_POST)){

        extract($_POST);

        $valid = true;

 

        // On se place sur le bon formulaire grâce au "name" de la balise "input"

        if (isset($_POST['inscription'])){

            $login  = $_POST['login']; // On récupère le login

            $nom  = $_POST['nom']; // On récupère le nom

            $prenom = $_POST['prenom']; // on récupère le prénom

            $email = $_POST['email']; // On récupère l'email

            $mdp = $_POST['mdp']; // On récupère le mot de passe 

            $confmdp = $_POST['confmdp']; //  On récupère la confirmation du mot de passe

            
            //  Vérification du login

            if(empty($login)){

                $valid = false;

                $er_login = ("Le login ne peut pas être vide");

                // On vérifit que le login est dans le bon format

            }elseif(!preg_match("/^[a-zA-Z0-9]+$/", $login)){

                $valid = false;

                $er_login = "Le login n'est pas valide";

            }

            //  Vérification du nom

            if(empty($nom)){

                $valid = false;

                $er_nom = ("Le nom d' utilisateur ne peut pas être vide");

                // On vérifit que le nom est dans le bon format

            }elseif(!preg_match("/^[a-zA-Z]+$/", $nom)){

                $valid = false;

                $er_nom = "Le nom n'est pas valide";
            }       

 

            //  Vérification du prénom

            if(empty($prenom)){

                $valid = false;

                $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");

                // On vérifit que le prenom est dans le bon format

            }elseif(!preg_match("/^[a-zA-Z]+$/", $prenom)){

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
                $stmt = mysqli_prepare($conn, "INSERT INTO Customer(login,mdp,stash) VALUES (?,?,0)");
                $hashed_password = password_hash($mdp,PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"ss",$login,$hashed_password);
                mysqli_stmt_execute($stmt);


                // Si Insertion possible **
                if (mysqli_stmt_affected_rows($stmt) === 1) {
                    $stmt = mysqli_prepare($conn, "SELECT id 
                                                   FROM Customer 
                                                   WHERE login = ?");

                    mysqli_stmt_bind_param($stmt,'s',$login);
                    mysqli_stmt_execute($stmt);

                    $table = mysqli_stmt_get_result($stmt);
                    $tuple = mysqli_fetch_assoc($table);
                    $id = $tuple['id'];


                    $stmt = mysqli_prepare($conn,"INSERT INTO CustomerProtectedData(id, surname, firstname, email) 
                                            VALUES (?,?,?,?)");

                    mysqli_stmt_bind_param($stmt,"isss",$id,$nom,$prenom,$email);
                    mysqli_stmt_execute($stmt);
                    $_SESSION['cle_id'] = $id;


                    $element = mysqli_query($conn,"SELECT Z FROM Mendeleiev");
                    // On ajoute dans CustomerExtraction les matérieux des élements pour la vente.
        

                    if ($element) {
                         $stmt = mysqli_prepare($conn,"INSERT INTO CustomerExtraction(Customer, element, quantity) 
                                            VALUES (?,?,0)");
                         foreach ($element as $elementas) {
                             mysqli_stmt_bind_param($stmt,"ii",$id,$elementas['Z']);
                            mysqli_stmt_execute($stmt);
                         }
                    }
                    

                    header('Location:./profil.php');
                }

            }else{
                $valid = false;
            }

        }

    }

?>

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
        <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/inscConn.css'>
        <title>Inscription</title>
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
        <div class="rectangle1">
            <h3>Inscription</h3>
            <form class="formulaire" method="post">
                <?php
                    // S'il y a une erreur sur le login alors on affiche
                    if (isset($er_login)){
                    ?>
                        <div><?= $er_login ?></div>
                    <?php
                    }
                ?>
                <input type="text" placeholder="Votre login" id="login" name="login" value="<?php if(isset($login)){ echo $login; }?>" required><br><br><br>

                <?php
                    // S'il y a une erreur sur le nom alors on affiche
                    if (isset($er_nom)){
                    ?>
                        <div><?= $er_nom ?></div>
                    <?php
                    }
                ?>
                <input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required><br><br>
                <?php
                    if (isset($er_prenom)){
                    ?>
                        <div><?= $er_prenom ?></div>
                    <?php
                    }
                ?>
                <input type="text" placeholder="Votre prénom" id="prenom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>" required><br><br>
                <?php
                    if (isset($er_email)){
                    ?>
                        <div><?= $er_email ?></div>
                    <?php
                    }
                ?>
                <input type="email" placeholder="Adresse mail" id="email" name="email" value="<?php if(isset($email)){ echo $email; }?>" required><br><br><br>
                <?php
                    if (isset($er_mdp)){
                    ?>
                        <div><?= $er_mdp ?></div>
                    <?php
                    }
                ?>
                <input type="password" placeholder="Mot de passe" id="mdp" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required><br><br>
                <input type="password" placeholder="Confirmer le mot de passe" id="confmdp" name="confmdp" required><br><br><br>
                <button type="submit" id="bouton" name="inscription">INSCRIPTION</button>
            </form>
        </div>
        <div class="rectangle2">
            <p>Vous avez déjà un compte ? <a href="./connexion.php">Connectez-vous !</a></p>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="../assets/javascript/transitionBurger.js"></script>
    
    </body>

</html>