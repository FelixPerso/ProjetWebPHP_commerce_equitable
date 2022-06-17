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
    <title>IT+ - Panier</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/cart.css'>
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
    <img class="logo" src="../images/logo_IT+_.png" style="width:4%" >
    <h3 class="titre-panier">Panier</h3>
    <?php
        /**on créer une variable pour calculer le prix total du panier*/
        $totalPrix= 0;
        /**
         * Pour avoir le panier du user, on récupère tout ce qu'il y a dans la table "cart"
         * en fonction de la personne qui est connectée.
         */
        $cartProd = mysqli_query($conn,"SELECT id,Prix,typeItem FROM Cart WHERE idUser=$id");
        /**Pour retirer un article du panier en fonction de son nom*/
        $retirerArticle =  mysqli_prepare($conn,"DELETE FROM Cart where id = ?");
        
        if($cartProd){
            echo "<table class='table-panier'><td><b>Produit</b></td><td><b>Prix</b></td></tr>";
        while(($cart = mysqli_fetch_array($cartProd))!=null) {
            echo"<tr class='produits'><td>{$cart['typeItem']}</td><td>{$cart['Prix']}€</td><td>
            <form id='frm' name='frm' method='post'>
            <input type='hidden' name='nomduprod' value='{$cart['id']}'/>
            
            <input class='bouton-retirer-panier' type='submit' name='btn1' value='Retirer du panier'/>
            </form></td></tr>";
            $totalPrix = $totalPrix + $cart['Prix'];
        }
        }
        echo"<tr><td><b>Total</b></td><td style='color: #68B6FD;'><b>{$totalPrix}€</b></td></tr>";
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

                       /**
                        * On recupere le prix total du panier grâce à $totalPrix calculé avant
                        * et on verifie que la cagnotte de l'utilisateur est bien supérieur au total du panier.
                        */
               if ($cagnotteUser<$totalPrix) {
                   $valid = false;
                   $er_cagnotte = "Vous n'avez pas assez dans votre cagnotte !";
                   echo "$er_cagnotte";
               }else{
                   $valid = true;
                       // Si toutes les conditions sont remplies alors on update la stash
                if($totalPrix!=0){
                   if($valid){
                       $stmt = mysqli_prepare($conn,"UPDATE Customer SET stash = stash - ? WHERE id=?");
                       mysqli_stmt_bind_param($stmt,'ii',$totalPrix,$id);
                       mysqli_stmt_execute($stmt);
                       
                       /**
                        * On va inserer les informations de achat dans une nouvelle table "HistoriqueBuy"
                        * afin de recenser nos historiques d'achat
                        */
                    
                    $cartProd = mysqli_query($conn,"SELECT prix,typeItem FROM Cart WHERE idUser=$id");
                    if($cartProd){
                        while(($cart = mysqli_fetch_array($cartProd))!=null) {
                            $stmt = mysqli_query($conn,"INSERT INTO HistoriqueBuy(nameProduit,Prix,id) 
                            VALUES ('{$cart['typeItem']}',{$cart['prix']},$id)");
                        }
                    }
                        /**
                        * On supprime ensuite le contenu du panier de l'utilisateur
                        */
                       $deleteCart = mysqli_query($conn,"DELETE FROM Cart WHERE idUser = $id");
                       header("Refresh:1");
                       echo"Achat réussi ! {$totalPrix} € on était déduis de votre cagnotte."; 
                        
                        
                   }
               }else{
                echo"<div class='w3-container w3-center'><p><b>Veuillez ajouter des articles au panier avant effectuer un achat !</b></p></div>";
               }
            }
           }
       }     
?>

    </section>
    
    <script>
    // When the user clicks on <div>, open the popup
 function popupCartEmpty() {            
    ar width=250, height=150;            
    var x=Math.round((screen.width-width)/2);            
    var y=Math.round((screen.height-height)/2);            
    var popup2=window.open("popup2.html", "centre", "width="+width+",height="+height+",left="+x+",top="+y);                   
}
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    <script src="../assets/javascript/menuSelectionVente.js"></script>
    <a href="#">
        <img class="arrowtop" src="../images/arrow_top.png" alt="arrowtop">
    </a>
</body>
</html>
<?php
    mysqli_close($conn);
?>