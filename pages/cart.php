<?php 
include 'bd.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();

if(!isset($_SESSION['cle_id'])) {
        header("Location:./connexion.php");
    }else {
        $id= $_SESSION['cle_id'];
    }
 
?>

<html lang="fr">
<!DOCTYPE HTML>
<head>
    <meta charset='utf-8'>
    <title>IT+ - Achat</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/achat.css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <section class="site2">
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
                    <li class='items'><a href='./connexion.php' class='connexion'>Connexion</a></li>

                </ul>
            </div>
        </header>

<body>
    <section class="site2">
    <h3 class="titre-histo-vente">Panier</h3>

 
    
    <?php
        /**on créer une variable pour calculer le prix total du panier*/
        $totalPrix= 0;
        /**
         * Pour avoir le panier du user, on récupère tout ce qu'il y a dans la table "cart"
         * en fonction de la personne qui est connectée.
         */
        $cartProd = mysqli_query($conn,"SELECT Prix,typeItem FROM Cart WHERE idUser=$id");
        /**Pour retirer un article du panier en fonction de son nom*/
        $retirerArticle =  mysqli_prepare($conn,"DELETE FROM Cart where typeItem = ?");
        
        if($cartProd){
            echo "<table class='historique-vente'><td><b>Produit</b></td><td><b>Prix</b></td></tr>";
        while(($cart = mysqli_fetch_array($cartProd))!=null) {
            echo"<tr class='produits'><td>{$cart['typeItem']}</td><td>{$cart['Prix']}€</td><td>
            <form id='frm' name='frm' method='post'>
            <input type='hidden' name='nomduprod' value='{$cart['typeItem']}'/>
            <input class='bouton-retirer-panier' type='submit' name='btn1' value='Retirer Panier'/>
            </form></td></tr>";
            $totalPrix = $totalPrix + $cart['Prix'];
        }
        }
        echo"<tr><td><b>Total</b></td><td>{$totalPrix}€</td></tr>";
        echo "</table>";

        if(!empty($_POST)){

            extract($_POST);
                        /**On se place sur le bon formulaire grâce au "name" de la balise "input"*/
            if (isset($_POST['btn1'])){
                        mysqli_stmt_bind_param($retirerArticle,'s',$_POST['nomduprod']);
                        mysqli_stmt_execute($retirerArticle);
                        header("Refresh:1");
    
                    }
                } 
        
        echo "<form id='frm' name='frm' method='post'>
        <input type='hidden' name='nomprod' value='acheter'/>
        <input class='bouton-achat-panier' type='submit' name='btn2' value='Acheter'/>
        </form>";
        
        if(!empty($_POST)){

           extract($_POST);
                       /**On se place sur le bon formulaire grâce au "name" de la balise "input".*/

           if (isset($_POST['btn2'])){

                       /**on recupere la cagnotte de l'utilisateur.*/
               $cagnotteUser = mysqli_prepare($conn,"SELECT stash FROM Customer where id = ?");
               mysqli_stmt_bind_param($cagnotteUser,'i',$id);
               mysqli_stmt_execute($cagnotteUser);
               $table = mysqli_stmt_get_result($cagnotteUser);
               $tuple = mysqli_fetch_assoc($table);
               $cagnotteUser = $tuple['stash'];

                       /**On recupere le prix total du panier grâce à $totalPrix calculé avant
                        * et on verifie que la cagnotte de l'utilisateur est bien supérieur au total du panier.
                        */
               if ($cagnotteUser<$totalPrix) {
                   $valid = false;
                   $er_cagnotte = "Vous n'avez pas assez dans votre cagnotte";
                   echo "$er_cagnotte";
               }else{
                   $valid = true;
                       // Si toutes les conditions sont remplies alors on update la stash
                if($totalPrix!=0){
                   if($valid){
                       $stmt = mysqli_prepare($conn,"UPDATE Customer SET stash = stash - ? WHERE id=?");
                       mysqli_stmt_bind_param($stmt,'ii',$totalPrix,$id);
                       mysqli_stmt_execute($stmt);
                       echo"Achat réussi,{$totalPrix} € on était déduis de votre cagnotte.";
                        $deleteCart = mysqli_query($conn,"DELETE FROM Cart WHERE idUser = $id");
                       
                       
                       /**On va inserer les informations de vente dans une nouvelle table "HistoriqueBuy" afin de recenser nos historiques de vente
                        * $stmt = mysqli_prepare($conn,"INSERT INTO HistoriqueBuy(nameProduit,Prix,Pays,id) VALUES (?,?,?,?)");
                        * mysqli_stmt_bind_param($stmt,'sisii',$_POST[',$nameTypeItem,$produitPrix,$id);
                        * mysqli_stmt_execute($stmt);
                        */
                   }
               }
            }
           }
       }     
?>

    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    <script src="../assets/javascript/menuSelectionVente.js"></script>
</body>

</html>
<?php
    mysqli_close($conn);
?>