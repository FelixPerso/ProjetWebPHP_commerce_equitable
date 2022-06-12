<?php 
    include 'bd.php';
    session_start();
    $titre = mysqli_query($conn,"SELECT name FROM TypeItem ORDER BY id ASC ");
?>
<!-- <!DOCTYPE_html> -->
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
                    <div class="page-actuelle"><li class="items">Achat</li></div>
                    <li class="items"><a href="./vente.php" class="vente">Vente</a></li>
                    <li class="items"><a href="./profil.php" class="profil">Mon profil</a></li>
                    <li class="items"><a href="./connexion.php" class="connexion">Connexion</a></li>   
                </ul>
            </div>
            <div class="w3-container">
                <div class="w3-dropdown-click">
                    <button class="w3-button w3-marina" onclick="rechercheMenuFunction()">Rechercher</button>
                    <div class="w3-dropdown-content w3-bar-block w3-card w3-white" id="myDIV">
                        <input class="w3-input w3-padding" type="text" placeholder="..." id="myInput" onkeyup="rechercheFiltreFunction()">
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
                    $val =0;
                    $titre = mysqli_query($conn,"SELECT name FROM TypeItem ORDER BY id ASC ");
                    if($titre){
                        foreach($titre as $titreprod)
                        {
                        echo"<title>{$titreprod['name']}</title>";
                        echo"<div class='rectangle'>";
                        echo"<p>{$titreprod['name']}</p>";
                        $val++;
                    $itemAndDetails = mysqli_query($conn,"SELECT attribute,value FROM TypeItemDetails where  typeItem = $val");
                    if($itemAndDetails ) {
                        foreach($itemAndDetails as $detail) {
                        echo"<p>{$detail['attribute']} : {$detail['value']}</p>";
                        
                        }
                    }
                     echo"<a href='./pages/achat.php'>
                        <img class='image' src='../images/tel1.png' alt='tel1'>
                        <div class='bouton'>
                        <p>ACHETER</p></div></a></div>";
                } 
            }
                   

                    ?>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>

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


        // Recherche Filtre
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
    </script>
<a href="#">
    <img class="arrowtop" src="../images/arrow_top.png" alt="arrowtop">
</a>

</body>

</html>
<?php
mysqli_close($conn);
?>