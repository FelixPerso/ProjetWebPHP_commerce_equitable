<?php

$host = "localhost";
$user = "dagorne";
$mdp = "dabrbr";
$bd = "dagorne";

$conn = mysqli_connect($host,$user,$mdp,$bd);
if(!$conn){
    die("échec");
    echo "connexion échouée";
}
?>