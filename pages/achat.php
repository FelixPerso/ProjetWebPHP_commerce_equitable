<?php 
include 'bd.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();

$titre = mysqli_query($conn,"SELECT name FROM TypeItem ORDER BY id ASC ");

?>
<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <title>IT+ - Achat</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/achat.css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                    <div class="page-actuelle">
                        <li class="item">Achat</li>
                    </div>
                    <li class="items"><a href="./vente.php" class="vente">Vente</a></li>
                    <li class="items"><a href="./profil.php" class="profil">Mon profil</a></li>
                    <li class='items'><a href='./connexion.php' class='connexion'>Connexion</a></li>

                </ul>
            </div>
            <div class="w3-container">
                <div class="w3-dropdown-click">
                    <button class="w3-button w3-marina" onclick="rechercheMenuFunction()">Rechercher</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card w3-white" id="myDIV">
                        <input class="w3-input w3-padding" type="text" placeholder="..." id="myInput"
                        onkeyup="rechercheFiltreFunction()">
                        <?php
                        if($titre){
                            while(($titreprod = mysqli_fetch_array($titre))!=null)
                            {
                                echo"<a class='w3-bar-item w3-button' href='#{$titreprod['name']}'>{$titreprod['name']}</a>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </header>

        <?php
<<<<<<< HEAD
        $val =0;
        $numimg = 0;
        $titre = mysqli_query($conn,"SELECT id,name,Prix FROM TypeItem ORDER BY id ASC");
=======
            $val =0;
            $numimg = 0;
            $titre = mysqli_query($conn,"SELECT id,name,Prix FROM TypeItem ORDER BY id ASC");
                 
                 
                 if($titre){
                     echo "<table>";
                    foreach($titre as $titreprod)
                     {
                         
                     echo"<tr><td><h4 id='{$titreprod['name']}'>{$titreprod['name']}</h4></td></tr><tr><td>{$titreprod['Prix']} €</td></tr><br><br>";
                     
                     $val++;
                     $numimg++;
                     
                     $itemAndDetails = mysqli_query($conn,"SELECT attribute,value FROM TypeItemDetails where  typeItem = $val");
                 if($itemAndDetails) {
                     foreach($itemAndDetails as $detail) {
                     echo"<tr><td>{$detail['attribute']} : {$detail['value']}</td></tr>";
                     } 
                 }
>>>>>>> 52970ef09d7d1c8a8e4cef628926cd9acb0fc936


        if($titre){
           echo "<table>";
           foreach($titre as $titreprod)
           {

               echo"<tr><td>{$titreprod['name']}</td></tr><tr><td>{$titreprod['Prix']} €</td></tr><br><br>";

               $val++;
               $numimg++;

               $itemAndDetails = mysqli_query($conn,"SELECT attribute,value FROM TypeItemDetails where  typeItem = $val");
               if($itemAndDetails) {
                   foreach($itemAndDetails as $detail) {
                       echo"<tr><td>{$detail['attribute']} : {$detail['value']}</td></tr>";
                   } 
               }

               echo"<tr><td><img class='image' src='../images/img$numimg.png' alt='img' height='40%' width='40%'></td></tr>  
               <tr><td><form id='frm' name='frm' method='post'><input type='hidden' name='idprod' value='{$titreprod['id']}'/><input type='submit' name='btn' value='acheter'/>
               </form></td></tr>";



           } 
           echo "</table>";

       }


       if(!isset($_SESSION['cle_id'])) {
        echo "Veuillez vous connecter pour effectuer des achats";
    }else {
        $id= $_SESSION['cle_id'];

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
                        // Si toutes les conditions sont remplies alors on fait le traitement

                    if($valid){
                        $stmt = mysqli_prepare($conn,"UPDATE Customer SET stash = stash - ? WHERE id=?");
                        mysqli_stmt_bind_param($stmt,'ii',$produitPrix,$id);
                        mysqli_stmt_execute($stmt);
                        echo"<div class='popup' onclick='myFunction()'>
                        <span class='popuptext' id='myPopup'>Achat réussi,<br>{$produitPrix} € on était déduis de votre cagnotte.</span>
                        </div>";
                        print_r($id);
                        echo"<br>";
                        print_r($produitPrix);
                        echo"<br>";
                        $stmt = mysqli_query($conn,"SELECT name from TypeItem where id= ? ");
                        mysqli_stmt_bind_param($stmt,'i',$_POST['idprod']);
                        mysqli_stmt_execute($stmt);
                        echo"$stmt";
                            // On va inserer les informations de vente dans une nouvelle table "HistoriqueBuy" afin de recenser nos historiques de vente
                        // $stmt = mysqli_prepare($conn,"INSERT INTO HistoriqueBuy(nameProduit,Prix,Pays,id) VALUES (?,?,?,?)");
                        // mysqli_stmt_bind_param($stmt,'sisii',$_POST[',$nameTypeItem,$produitPrix,$id);
                        // mysqli_stmt_execute($stmt);
                    }
                }
            }
        } 
    }   
    ?>
</section>
<script>
    // Menu cliquable Recherche
    function rechercheMenuFunction() {
        var x = document.getElementById("myDIV");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }


    // Recherche filtre
    function rechercheFiltreFunction() {
        var input, filtre, ul, li, a, i;
        input = document.getElementById("myInput");
        filtre = input.value.toUpperCase();
        div = document.getElementById("myDIV");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filtre) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }

    // When the user clicks on <div>, open the popup
    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
    </script>
    <a href="#">
        <img class="arrowtop" src="../images/arrow_top.png" alt="arrowtop">
    </a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    <script src="../assets/javascript/menuSelectionVente.js"></script>
</body>

</html>
<?php
mysqli_close($conn);
?>