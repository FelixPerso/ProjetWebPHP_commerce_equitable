<?php 
include 'bd.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();

if(!isset($_SESSION['cle_id'])) {
        echo "Veuillez vous connecter pour effectuer des achats";
    }else {
        $id= $_SESSION['cle_id'];
    }
    $cartProd = mysqli_query($conn,"SELECT Prix,typeItem FROM Cart WHERE idUser=$id");
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+ - Panier</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/HistoriqueSell.css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <section class="site2">
       <form id='frm' name='frm' method='post'>
             <input type='hidden' name='idprod' value=''/><input class='bouton-achat-panier' type='submit' name='btn' value='Acheter'/>
             </form>
    <script>
    <h3 class="titre-histo-vente">Historique des ventes</h3>
<?php

if($cartProd){
    echo "<table class='historique-vente'><tr class='legende'><td><b>Entreprise</b></td><td><b>Produit</b></td><td><b>Prix</b></td><td><b>Quantité</b></td><td><b>Total</b></td></tr>";
    while(($cart = mysqli_fetch_array($cartProd))!=null) {
        echo"<tr class='produits'><td>{$cart['typeItem']}</td><td>{$cart['Prix']}€</td></tr>";
    }
    echo "</table>";
}
if(!empty($_POST)){

            extract($_POST);
                        // On se place sur le bon formulaire grâce au "name" de la balise "input"

            if (isset($_POST['btn'])){

                        // on recupere la cagnotte de l'utilisateur.
                $cagnotteUser = mysqli_prepare($conn,"SELECT stash FROM Customer where id = ?");
                mysqli_stmt_bind_param($cagnotteUser,'i',$id);
                mysqli_stmt_execute($cagnotteUser);
                $table = mysqli_stmt_get_result($cagnotteUser);
                $tuple = mysqli_fetch_assoc($table);
                $cagnotteUser = $tuple['stash'];

                        // on recupere le prix du produit
                $stmt = mysqli_query($conn,"SELECT Prix FROM TypeItem where id = {$_POST['idprod']}");
                $tuple = mysqli_fetch_assoc($stmt);
                $produitPrix = $tuple['Prix'];

                        // on verifie que la cagnotte de l'utilisateur est bien supérieur au prix du produit.
                if ($cagnotteUser<$produitPrix) {
                    $valid = false;
                    $er_cagnotte = "Vous n'avez pas assez dans votre cagnotte";
                    echo "$er_cagnotte";
                }else{
                    $valid = true;
                        // Si toutes les conditions sont remplies alors update la stash

                    if($valid){
                        // $stmt = mysqli_prepare($conn,"UPDATE Customer SET stash = stash - ? WHERE id=?");
                        // mysqli_stmt_bind_param($stmt,'ii',$produitPrix,$id);
                        // mysqli_stmt_execute($stmt);
                        echo"<div class='popup' onclick='myFunction()'>
                        <span class='popuptext' id='myPopup'>Achat réussi,<br>{$produitPrix} € on était déduis de votre cagnotte.</span>
                        </div>";
                        
                        
                        $stmt = mysqli_prepare($conn,"SELECT name from TypeItem where id= ? ");
                        mysqli_stmt_bind_param($stmt,'i',$_POST['idprod']);
                        mysqli_stmt_execute($stmt);
                        $table = mysqli_stmt_get_result($stmt);
                        $tuple = mysqli_fetch_assoc($table);
                        $nomTypeItem = $tuple['name'];

                        
                        $stmt = mysqli_prepare($conn,"INSERT INTO Cart(prix,typeItem,idUser) VALUES (?,?,?)");
                        mysqli_stmt_bind_param($stmt,'isi',$produitPrix,$nomTypeItem,$id);
                        mysqli_stmt_execute($stmt);
                        // On va inserer les informations de vente dans une nouvelle table "HistoriqueBuy" afin de recenser nos historiques de vente
                        // $stmt = mysqli_prepare($conn,"INSERT INTO HistoriqueBuy(nameProduit,Prix,Pays,id) VALUES (?,?,?,?)");
                        // mysqli_stmt_bind_param($stmt,'sisii',$_POST[',$nameTypeItem,$produitPrix,$id);
                        // mysqli_stmt_execute($stmt);
                    }
                }
            }
        }   
    ?>











    </script>

</body>

</html>
<?php
    mysqli_close($conn);
?>