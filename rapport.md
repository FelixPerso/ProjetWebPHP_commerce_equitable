# Rapport du projet SAE 2.02 #

## Ce dépôt contient la réalisation du projet SAE 2.02 de création de site web pour une entreprise de B2C.##
### Les auteurs de ce dépôt sont les suivants : ###
* Thomas Dagorne
* Hugo Brenet
* Félix Brinet 

## Introduction ##
<p> Ce projet a été réalisé dans le cadre d'une <b>SAE 2.02</b> dans la matière Développement Web en première année de BUT informatique. 
Cette SAE est en commun avec les <b>SAE 2.05</b> et <b>2.06</b> dans les matières Communication et EGOD. Vous trouverez donc les pages HTML, CSS, PHP mais aussi le wireflow de notre site.<p>

Vous pouvez également y accéder avec le [lien suivant](https://www.figma.com/proto/aylnUzhfTIFKKPsthPNOqB/Prototype-1?node-id=9%3A3&scaling=scale-down&page-id=0%3A1&starting-point-node-id=9%3A3).

<br>

## Création du Site Internet ##

Dans la première partie de la création de ce site web, nous avons créé, plusieurs pages PHP pour chaque partie du site : 
* Page d'accueil 
* Page de connexion 
* Page d'inscription 
* Page de profil 
* Page d'achat 
* Page de vente 
* Page d'historiques

>Nous avons également créé un CSS commun à toutes les pages page contenant le header et footer du site. Chaque page possède en plus une page de CSS unique. 
Pour la connexion à la base de données créer sur PhpMyAdmin, un fichier script.php avec toutes les informations a été créé.

<br>

### &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. Organisation et Répartition des tâches ###

Dans un premier temps, nous nous sommes concentré sur la réalisation du wireflow avec le SIte Internet [Figma](https://www.figma.com/). Par la suite, nous avons amélioré la base de données en rajoutant quelques tables (_les tables des historiques et du panier_) et en rajoutant de nombreux tuples dans chacune des tables.

Lorsque ces premières tâches ont été finalisées. Nous avons entammé la construction du Site Internet en se divisant le travail :
* <b>Thomas</b>, qui a déjà réalisé une grande partie de wireflow, s'est occupé principalement de l'aspect graphique de l'intégralité du site. Il s'est également occupé en partie de la page de vente et de la page d'accueil.
* <b>Hugo</b> s'est occupé des parties connexions et inscription ainsi qu'une partie de la page vente et de la page des historiques.
* <b>Félix</b> s'est occupé des pages d'achat et de profil.

>Au final, tout le monde a touché un peu à tout selon les quelques difficultés rencontrées.

<br>

### &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. Nos réalisations particulièremet réussies ###

Les réalisations que nous avons décidé de mettre en avant sont celles de la page de vente car nous les trouvons intéressantes. De plus, se sont également les plus aboutis du site internet.

La page de ventre est simple. Dessus, on trouve un bouton avec un menu déroulant, celui-ci permet de choisir quel produit l'on souhaite vendre 

>Si vous ne sélectionnez rien, une erreur apparait.

Une fois le produit sélectionné, il faut cliquer sur le bouton "Trouver un vendeur". Par la suite, nous sommes redirectionné vers une sous-page de vente où vous avez de nouveau un bouton avec un menu déroulant, celui-ci contient la liste de toutes les entreprises qui souhaitent acheter le produit que vous avez sélectionné précédemment avec le prix d'achat de l'entreprise ainsi que le nombre de produit qu'elles souhaitent acheter.<br>
En dessous de ce menu déroulant, vous avez la possibilité d'entrer une quantité, celle-ci représente le nombre de produits que vous allez vendre à l'entreprise sélectionnée au dessus.<br>

>Si la quantité mentionnée est suppérieure à celle que demande l'entreprise sélectionnée, une erreur s'affiche.

>Si vous ne rentrer aucunes informations où qu'une seule, une erreur s'affiche.

Après avoir sélectionné une offre et mentionné une quantité, vous finalisez votre vente en cliquant sur le bouton "Vendre". Cette action vous affiche un message qui contient la somme finale de votre vente (_Prix de l'offre * Quantité mentionnée_).<br> 
Par la suite, si vous retournez sur votre page de profil, vous pourrez apercevoir que votre cagnotte a été mise à jour avec l'ajout de la somme finale de la vente effectuée précédemment. De plus, vos métaux recyclés ont égelement été mis à jour avec les quantités présentent dans le produit que vous avez vendu.<br><br>
Si vous cliquez sur le bouton "Historique", vous verez alors votre vente effectuée précédemment dans l'historique des ventes.

<br>

## Conclusions personnelles :

* <b>Thomas :</b> 
* <b>Hugo   :</b> Très satisfait de ce projet ! Pour ma part, je trouve que nous avons réalisé un très bon travail, l'organisation était plus que correcte, cela nous a permis d'avancer rapidement et efficacement. J'ai beaucoup apprécié manier la base de données ainsi que le php, j'ai pu approfondir mes connaissances en SQL qui me sera très utile pour ma prochaine alternance. Je remercie mon équipe, Thomas et Felix de m'avoir fait confiance, j'ai pris un réel plaisir à travailler avec eux. 
* <b>Félix  :</b> 
