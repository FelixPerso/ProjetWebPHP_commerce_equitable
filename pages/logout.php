<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/pages/logout.css'>
    </head>
    <body>
         
        <?php
            session_start();
            session_destroy();
        ?>
        <p>Vous avez été déconnecté. <a href='./connexion.php'>Retourner sur le site</a></p>
    </body>
</html>