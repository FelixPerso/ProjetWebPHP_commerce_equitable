<?php
    
$showAlert = false; 
$showError = false;
$exists=false; 
include 'bd.php';     

    if (isset($_POST['Inscription'])) {
    // Include file which makes the
    // Database Connection.  
    
    $login = $_POST["login"]; 
    $mdp = $_POST["mdp"]; 
    $cmdp = $_POST["cmdp"];
            
    
    $sql = "Select * from user where login='$login'";
    
    $result = mysqli_query($connexion, $sql);
    $num = mysqli_num_rows($result); 
    echo "$num";
     
    strip_tags($mdp);
    // This sql query is use to check if
    // the login is already present 
    // or not in our Database
    if($num == 0) {
        if(($mdp == $cmdp) && $exists==false) {
    
            $hashed_password = password_hash($mdp,PASSWORD_DEFAULT);
                
            // mdp Hashing is used here. 
            $sql = "INSERT INTO user VALUES ('$login', 
                '$hashed_password')";
    
            $result = mysqli_query($connexion, $sql);
    
            if ($result) {
                $showAlert = true; 
                echo "ok";
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
}
  
    
?>
    
<html>
    <form method="POST">
        <div>
            <label for="login">login:</label>
            <input type="login" id="login" name="login">
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