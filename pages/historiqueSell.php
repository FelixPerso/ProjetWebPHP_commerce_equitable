<?php
include 'bd.php';
session_start();

if(!isset($_SESSION['cle_id']))
    echo "connexion impossible";

else {
    $id = $_SESSION['cle_id'];
}

$HistoSell = mysqli_query($conn,"SELECT nameEntreprise,nameProduit,Prix,Quantite,Total FROM HistoriqueSell WHERE id=$id");
$HistoBuy = mysqli_query($conn,"SELECT nameProduit,Prix,Pays,Total FROM HistoriqueBuy WHERE id=$id");


?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+ - Historique</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/historiqueSell.css'>
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
<h3 class="titre-histo-vente">Historique des ventes</h3>
<?php
if($HistoSell){
    echo "<table class='historique-vente'><tr class='legende'><td><b>Entreprise</b></td><td><b>Produit</b></td><td><b>Prix</b></td><td><b>Quantité</b></td><td><b>Total</b></td></tr>";
    while(($HistoriqueSell = mysqli_fetch_array($HistoSell))!=null) {
        echo"<tr class='produits'><td>{$HistoriqueSell['nameEntreprise']}</td><td>{$HistoriqueSell['nameProduit']}</td><td style='color: #55B844;'><b>+{$HistoriqueSell['Prix']}€</b></td><td>{$HistoriqueSell['Quantite']}</td><td style='color: #55B844;'><b>+{$HistoriqueSell['Total']}€</b></td></tr>";
    }
    echo "</table>";
}
?>
<h3 class="titre-histo-achat">Historique des achats</h3>
<?php
if($HistoBuy){
    echo "<table class='historique-achat'><tr class='legende'><td><b>Produit</b></td><td><b>Prix</b></td><td><b>Pays</b></td><td><b>Quantité</b></td><td><b>Total</b></td></tr>";
    while(($HistoriqueBuy = mysqli_fetch_array($HistoBuy))!=null) {
        echo"<tr class='produits'><td>{$HistoriqueBuy['Pays']}</td><td>{$HistoriqueBuy['nameProduit']}</td><td style='color: #F01A25;'><b>-{$HistoriqueBuy['Prix']}€</b></td><td>{$HistoriqueBuy['Quantite']}</td><td style='color: #F01A25;'><b>-{$HistoriqueBuy['Total']}€</b></td></tr>";
    }
    echo "</table>";
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