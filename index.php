<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="index.css">
        <title>Accueil</title>
 
    </head>
    <body>
        <div class="page">    
         <!-- header -->
            <?php
                require ('header.php');
                require ('connect.php')
            ?>
            
            <div class="container1">          
                <button class="button button1" onclick="window.location.href='inscription.php'">Inscription</button>      
                <button class="button button2" onclick="window.location.href='connexion.php'">Connexion</button>
            </div>    
       

            <?php
                include 'footer.php';
            ?>
        </div>
    </body>
</html>