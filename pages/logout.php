<?php   
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
header("location:/index.php"); //to redirect back to "index.php" after logging out
exit();
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Logout</title>
    </head>
    <body>      
        <div>Logout</div>
        <input class="favorite styled"
       		type="button"
       		value="Add to favorites">
    </body>

</html>

