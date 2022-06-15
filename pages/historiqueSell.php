<?php
include 'bd.php';
    session_start();

    if(!isset($_SESSION['cle_id']))
        echo "connexion impossible";

    else {
        $id = $_SESSION['cle_id'];
    }

    $HistoSell = mysqli_query($conn,"SELECT nameEntreprise,nameProduit,Prix,Quantite FROM HistoriqueSell WHERE id=$id");


?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+ - Trouver un vendeur</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/main.css'>
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
        <h3>Historique de vente</h3>
  
                    <?php
                        if($HistoSell){
                            while(($HistoriqueSell = mysqli_fetch_array($HistoSell))!=null)
                            {
                                echo"<table><tr><td>{$HistoriqueSell['nameEntreprise']}</td><td>{$HistoriqueSell['nameProduit']}</td><td>{$HistoriqueSell['Prix']}€</td><td>(x{$HistoriqueSell['Quantite']})</td></table>";
                            }
                        }
                    ?>
          
                </section>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>

</body>
</html>
<?php
mysqli_close($conn);
?>