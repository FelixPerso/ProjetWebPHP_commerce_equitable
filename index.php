Firof
#7970





Message privé
ThomAs
ALIAS
Thomas Dagorne
Rechercher

région
Automatique




9 juin 2022

ThomAs — 09/06/2022
Yo
[08:15]
Avec Hugo on vient pour 11h

ThomAs — 09/06/2022
finalement on vient pour 13h45 (modifié)

Firof — 09/06/2022
same

ThomAs — 09/06/2022
D'acc
[09:59]
Pour finir le projet on a : demain toute la journée; Lundi de 11h15 à 15h et Mardi de 11h15 à 15h
[09:59]
Et ce weekend
[09:59]
Ce weekend je rebosse sur le wireflow pour le rendu final
[10:00]
et je bosserai aussi sur les css des pages conn et insc (modifié)

Firof — 09/06/2022
ok moi je termine enfin la page d'achat, je vais la relier à la cagnotte quand l'utilisateur achète et je vais voir si je peux faire un panier

ThomAs — 09/06/2022
Okay, avec Hugo demain on va essayer de terminer le php de la page vente
[10:02]
Et après faudrait aussi qu'on pense à faire le texte du site (sur la page accueil)

Firof — 09/06/2022
okay, et tu pourrais m'envoyer comment vous avez fait pou envoyer une requête à la bd quand on clique sur un bouton

ThomAs — 09/06/2022
Bah pour l'instant on y arrive pas justement

@ThomAs
Et après faudrait aussi qu'on pense à faire le texte du site (sur la page accueil)

Firof — 09/06/2022
oui oklm, ça je te le fais rapidement demain

ThomAs — 09/06/2022
Hugo l'a peut être deja fait sur les pages conn et insc
[10:04]
Ca va le faire
[10:05]
Va aussi falloir modifier le rapport

Firof — 09/06/2022
ok ok
[10:05]
Vasi mais la priorité c'est rendre le site fonctionnel

ThomAs — 09/06/2022
évidemment

Firof — 09/06/2022
Après bon si tu es bloqué et tu avances pas, tu peux faire du rapport ou du CSS mais priorité php

1
[10:09]
je ferais le rapport et compléter le texte du site samedi matin

ThomAs — 09/06/2022
D'acc
[10:10]
go faire les turcs "moins important" ce weekend (modifié)

1
[10:11]
texte rapport css wireframe (modifié)
11 juin 2022

Firof — Hier à 18:16
Du coup, on fait comment tu m'envoies ton code et je git ?

ThomAs — Hier à 18:31
<?php

 session_start();


include 'bd.php';
Afficher plus
connexion.php
4 Ko
<?php

    session_start();

    include 'bd.php'; // Connexion à la base de données
Afficher plus
Inscription.php
9 Ko
<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/logout.css'>
    </head>
Afficher plus
logout.php
1 Ko
<?php 
    include 'bd.php';
    //session_start();
    $id = 1;//$_SESSION["cle_session"];
    $titre = mysqli_query($conn,"SELECT * FROM TypeItem ORDER BY id ASC ");
    $pays = mysqli_query($conn,"SELECT DISTINCT country FROM Business ORDER BY country ASC ");
Afficher plus
vente.php
8 Ko
[18:31]
*, ::before, ::after {

    text-decoration: none;
}

.site {
Afficher plus
inscConn.css
2 Ko
body, header, html, .site {

    margin: 0;
    padding: 0;
    border: 0;
    font-family: 'Lato', sans-serif;
Afficher plus
logout.css
1 Ko
*, ::before, ::after {

    text-decoration: none;
}

.site {
Afficher plus
vente.css
3 Ko

Firof — Hier à 18:31
carré je git tout ça après avoir ajouté des trucs dans la bd

ThomAs — Hier à 18:32
D'acc

Firof — Hier à 19:24
Dans le menu déroulant j'enlève "Inscription" du coup ?

ThomAs — Hier à 19:26
Nan j’ai pas touché à ça

Firof — Hier à 19:26
ok ok
[19:27]
Demain je vais modifier le menu de vente pour que ça récupère l'id de la personne co avec session_user
[19:27]
Ou alors si tu veux le faire ce soir vasi mais là je peux pas , c'est l'anniv de ma sister

ThomAs — Hier à 19:29
J'ai du monde chez moi
[19:29]
donc je peux pas

Firof — Hier à 19:39
ok pas de soucis
[19:39]
bonne soirée

ThomAs — Hier à 19:40
merci à toi aussi

ThomAs — Hier à 22:31
Possible de décaler l'appel à 13h/14h demain ?
[22:31]
Petit imprévu

Firof — Hier à 22:32
Ouais tqt mais peut-être plutôt 13h 30 car j'aurais pas fini de manger

ThomAs — Hier à 22:33

12 juin 2022

Firof — Aujourd’hui à 12:58
finalement 14h, je viens de commencer à manger

ThomAs — Aujourd’hui à 13:04
D’acc

ThomAs — Aujourd’hui à 13:46
Appelles-moi quand t'es ok

Firof — Aujourd’hui à 13:47
dac je lance mon pc

ThomAs — Aujourd’hui à 13:48

Firof
 a commencé un appel.
 — Aujourd’hui à 13:48

Firof — Aujourd’hui à 13:51
https://upecnumerique-my.sharepoint.com/:w:/g/personal/felix_brinet_etu_u-pec_fr/Eatj4l7tjSNHn70ZblpkqukBp2-bM0KAhVQ39TNl-FNejw?e=uHjjjf

ThomAs — Aujourd’hui à 14:06

[14:06]


Firof — Aujourd’hui à 14:16
https://dwarves.iut-fbleau.fr/~justiney/SAE-2.06-2.05/
[14:19]


ThomAs — Aujourd’hui à 14:20
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+  Accueil</title>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/main.css'>
Afficher plus
index.php
4 Ko
[14:20]
<?php 
    include 'bd.php';
    //session_start();
    $id = 1;//$_SESSION["cle_session"];
    $titre = mysqli_query($conn,"SELECT * FROM TypeItem ORDER BY id ASC ");
    $pays = mysqli_query($conn,"SELECT DISTINCT country FROM Business ORDER BY country ASC ");
Afficher plus
vente.php
8 Ko
<?php 
    include 'bd.php';
    session_start();
    $titre = mysqli_query($conn,"SELECT name FROM TypeItem ORDER BY id ASC ");
?>
<!-- <!DOCTYPE_html> -->
Afficher plus
achat.php
5 Ko
<?php

 session_start();


include 'bd.php';
Afficher plus
connexion.php
4 Ko
<?php

    session_start();

    include 'bd.php'; // Connexion à la base de données
Afficher plus
Inscription.php
9 Ko
<?php 
    include 'bd.php';
    session_start();
    if(!isset($_SESSION['cle_id'])){
        header("Location:./connexion.php");
    }
Afficher plus
profil.php
5 Ko
[14:20]
body, header, html, .site {

    margin: 0;
    padding: 0;
    border: 0;
    font-family: 'Lato', sans-serif;
Afficher plus
header.css
2 Ko
[14:20]

html {
    scroll-behavior: smooth;
}

*, ::before, ::after {
Afficher plus
achat.css
1 Ko
*, ::before, ::after {

    text-decoration: none;
}

.site {
Afficher plus
inscConn.css
2 Ko

.grand-rectangle1 {

    position: relative;
    grid-column-start: body1;
    grid-column-end: body1;
Afficher plus
profil.css
3 Ko

Envoyer un message à @ThomAs
﻿




4000 caractère(s) restant(s)
 pour sélectionner
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>IT+  Accueil</title>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/css/header.css'>
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
                    <div class="page-actuelle"><li class="items">Accueil</li></div>
                    <li class="items"><a href="./pages/achat.php" class="achat">Achat</a></li>
                    <li class="items"><a href="./pages/vente.php" class="vente">Vente</a></li>
                    <li class="items"><a href="./pages/profil.php" class="profil">Mon profil</a></li>
                    <li class="items"><a href="./pages/connexion.php" class="connexion">Connexion</a></li>
                </ul>
            </div>
        </header>
        <div class="grand-rectangle1">
            <div class="rectangle1">
                <h3>Achat</h3>
                <p class="phrases">Accéder aux produits vendues par nos partenaires ( Apple ,Google , Xiaomi, ...) sur cette page !<br><br> 
                Tous nos produits sont reconditionnées et garantie 30 jours satisfait ou remboursé.</p>
                <a href="./pages/achat.php">
                    <div class="bouton">
                        <p>VOIR</p>
                    </div>
                </a>
            </div>
            <div class="rectangle2">
                <h3>Profil</h3>
                <p class="phrases">Accéder à votre profil sur cette page ! <br><br>
                Vous pouvez suivre argent que vous avez gagné et
                     connaître le nombre de minerais que vous avez sauvé !</p>
                <a href="./pages/profil.php">
                    <div class="bouton">
                        <p>VOIR</p>
                    </div>
                </a>
            </div>
            <div class="rectangle3">
                <h3>Vente</h3>
                <p class="phrases">Accéder à la page de vente !<br><br> Nos partenaires reprennent vos produits à des prix très intérréssants !</p>
                <a href="./pages/vente.php">
                    <div class="bouton">
                        <p>VOIR</p>
                    </div>
                </a>
            </div>