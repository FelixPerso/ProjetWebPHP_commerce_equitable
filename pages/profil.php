<?php 
    include './script.php';
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
                </ul>
            </div>
        </header>
        <div class="grand-rectangle1">
            <div class="rectangle1">
                <h3>Métaux précieux recyclés</h3>
            </div>
        </div>
        <div class="grand-rectangle2">
            <div class="rectangle2">
                <img src="../images/cagnotte.png" alt="image-cagnotte">
                <h1>21,775<!--FAKE INFO--></h1>
            </div>
            <div class="rectangle3">
                <h3>Vos informations</h3>
                <?php
                    $result = mysqli_query($conn,"SELECT * FROM Mendeleiev");
                    if($result){
                        echo"<table><tr><th>Name</th><th>symbol</th><th>Z</th>";
                        while($Mendeleiev = mysqli_fetch_assoc($result))
                    {
                        echo "<tr><td>{$Mendeleiev['name']}</td><td>{$Mendeleiev['symbol']}</td><td>{$Mendeleiev['Z']}</td><td></tr>";
                    } 
                        echo"</table";
                    }
                        mysqli_close($conn);
                ?>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>

</body>
</html>
