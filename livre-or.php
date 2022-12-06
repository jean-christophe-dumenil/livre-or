<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Livre d'or</title>
</head>
<body>
   
    <?php
        require ('header.php');
        require ('connect.php')
    ?>
    
    <main>
    <?php     
        // requête pour récupérer tout ce qu'il y a dans la base de données commentaires
        $requete = "SELECT commentaires.commentaire, DATE_FORMAT(commentaires.date, '%d/%m/%Y') as date, utilisateurs.login FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ORDER BY date DESC";

        // exécution de la requête
        $exec_requete = $db -> query($requete);
     
        ?>

        <div id="container">            
            
            <form method="post" action="">
                <h1>Livre d'or</h1>    
                <table class="commentaires">
                    <thead>
                        <tr>
                            <th class="date">Posté le</th>
                            <th class="user">Par l'utilisateur</th>
                            <th class="comm">Commentaires</th>
                        </tr>
                    </thead>
                <tbody>
            </form>        
                    <?php
                        // affichage des commentaires
                        while ($reponse = mysqli_fetch_assoc($exec_requete)){
                            echo "<tr>";
                            echo "<td class='date'>".$reponse['date']."</td>";
                            echo "<td class='user'>".$reponse['login']."</td>";
                            echo "<td class='comm'>".$reponse['commentaire']."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </main>
    </main>
   
        <?php
            include 'footer.php';
        ?>       
</body>
</html>