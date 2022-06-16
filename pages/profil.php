<?php 
    include 'bd.php';
    session_start();
    if(!isset($_SESSION['cle_id'])){
        header("Location:./connexion.php");
    }
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+ - Mon profil</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/profil.css'>
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
                    <div class="page-actuelle"><li class="items">Mon profil</li></div>
                    <li class="items"><a href="./connexion.php" class="connexion">Connexion</a></li>
                    
                </ul>
            </div>
        </header>
        <button class="bouton-deconnexion" onclick="window.location.href = 'logout.php';">Déconnexion</button>
        <button class="bouton-historique" onclick="window.location.href = 'historiqueSell.php';">Historique</button>
        <div class="grand-rectangle1">
            <div class="rectangle1">
                <h3>Métaux précieux recyclés</h3>
                <?php

                    $result1 = mysqli_query($conn,"(Select name,v1.quantity 
                    from Mendeleiev left join (Select quantity,element from
                    CustomerExtraction where Customer = {$_SESSION['cle_id']} ) v1 on (v1.element = Z))");

                    if($result1){
                        echo"<table style='border-spacing:15px; margin-left:5%;'>";
                        while($Mendeleiev = mysqli_fetch_assoc($result1))
                        {
                            if($Mendeleiev['quantity']==null){
                                $Mendeleiev['quantity']=0;
                                echo "<tr><td>{$Mendeleiev['name']}</td><td>
                                {$Mendeleiev['quantity']}</td></tr>";
                            }else{
                                echo "<tr><td><b>{$Mendeleiev['name']} :</b></td><td>
                                {$Mendeleiev['quantity']} mg</td></tr>";
                            }
                        } 
                        echo"</table>";
                    }
                ?> 
            </div>
        </div>
        <div class="grand-rectangle2">
            <div class="rectangle2">
                <img src="../images/cagnotte.png" alt="image-cagnotte">
                <h1>
                <?php
                    $result3 = mysqli_query($conn,"Select stash from
                     Customer where id={$_SESSION['cle_id']}");

                    if($result3){
                        $money = mysqli_fetch_assoc($result3);
                        echo "$money[stash]";
                    }
                ?>
                €</h1>
            </div>
            <div class="rectangle3">
                <h3>Vos informations</h3>
                <?php

                    $result2 = mysqli_query($conn,"Select * from 
                    CustomerProtectedData where id = {$_SESSION['cle_id']}");
                    $caract = mysqli_fetch_array($result2);
                     
                    if($result2!=null){
                        echo"<p style='margin-left:5%;'><b>Prénom : </b>{$caract["surname"]}</p>";
                        echo"<p style='margin-left:5%;'><b>Nom    : </b>{$caract["firstname"]}</p>";
                        echo"<p style='margin-left:5%;'><b>Email  : </b>{$caract["email"]}</p>";
                    }
                ?>
            </div>
        </div>
    </section>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>

</body>
</html>
<?php
mysqli_close($conn);
?>