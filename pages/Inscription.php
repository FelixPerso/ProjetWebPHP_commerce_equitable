<?php
    
$showAlert = false; 
$showError = false;
$exists=false; 
$error=0;
include 'bd.php';     

    if (isset($_POST['Inscription'])) {
    // Include file which makes the
    // Database Connection.  
    
    $login = $_POST["login"];
    $firstName = $_POST["firstName"]; 
    $name = $_POST["name"];  
    $mdp = $_POST["mdp"]; 
    $cmdp = $_POST["cmdp"];
            
    
    $sql = "Select * from customer where login='$login'";
    
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); 
    echo "$num";

     
    // This sql query is use to check if
    // the login is already present 
    // or not in our Database
    if($num == 0) {
            
            if (empty($login) || strlen($login) > 50 || preg_match("^[A-Za-z '-]+$",$login)) {
                echo "Votre login contient des caractères non acceptés";
                $error++;
            }

            if (empty($name) || strlen($name) > 50 || preg_match("^[A-Za-z '-]+$",$name)) {
                echo "Votre nom contient des caractères non acceptés";
                $error++;
            }

            if (empty($firstName) || strlen($firstName) > 50 || preg_match("^[A-Za-z '-]+$",$firstName)) {
                echo "Votre prénom contient des caractères non acceptés";
                $error++;
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Votre email n'est pas correcte. Veuillez respecter un email du type : test@gmail.fr";
                $error++;
            }

            if ($mdp != $cmdp) {
                echo "Les mots de passes ne correspondent pas !";
                $error++;
            }

            if ($error==0) {
    
            $hashed_password = password_hash($mdp,PASSWORD_DEFAULT);
                
            // mdp Hashing is used here. 
            $sql = "INSERT INTO customer(id, login, stash, mdp) VALUES (?,$login,0,'$hashed_password')";

            $result = mysqli_query($conn, $sql); 

            $sql = "INSERT INTO CustomerProtectedData(id, surname, firstName, email) VALUES (?,$surname,$firstName,$email)";

            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $showAlert = true; 
                echo "ok";
            }
        }
    } 
        else { 
            $showError = true; 
            echo "mdp pas correcte";
        }      
    }// end if 
    
   if($num>0) 
   {
      echo "Le login est déjà utilisé !"; 
   } 
  
    
?>
    
<html>
    <form method="POST">
        <div>
            <label for="login">login:</label>
            <input type="login" id="login" name="login">
        </div>

        <div>
            <label for="name">Prenom:</label>
            <input type="name" id="name" name="firstName">
        </div>

        <div>
            <label for="name">Nom:</label>
            <input type="name" id="name" name="name">
        </div>

        <div>
            <label for="email">email:</label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label for="mdp">mdp:</label>
            <input type="password" id="password" name="mdp">
        </div>

        <div>
            <label for="mdp">cmdp:</label>
            <input type="password" id="password" name="cmdp">
        </div>


        <div class="button">
            <button type="submit" name="Inscription">S'inscrire</button>
        </div>
    </form>
</html>