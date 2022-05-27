<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+ - Mon profil</title>
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
                    <li class="items"><a href="./achat.php" class="achat">Achat</a></li>
                    <li class="items"><a href="./vente.php" class="vente">Vente</a></li>
                    <div class="page-actuelle"><li class="items">Mon profil</li></div>
                </ul>
          </div>
		</header>
	</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../assets/javascript/transitionBurger.js"></script>
    <?php

include './script.php';
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
</body>
</html>
