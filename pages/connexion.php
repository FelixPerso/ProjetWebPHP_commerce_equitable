<?php
//session_start();
include 'bd.php';
$login = $_POST['login'] ?? NULL;
$mdp = $_POST['mdp'] ?? NULL;


$sql = "SELECT mdp,id FROM Customer WHERE login='$login'";
$res = mysqli_query($conn,$sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $hashed_mdp = $row['mdp'];
        

        if (password_verify($mdp,$hashed_mdp)) {
            //$_SESSION ["cles_session"] = $row["id"];
            echo "OK";
        }
        else
            echo "PAS OK";
    }
    else
        die("error !!");
?>

<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>

                <input type="submit" id='submit' value='LOGIN' >

            </form>
        </div>
    </body>
</html>