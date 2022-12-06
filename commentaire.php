<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Commentaire</title>
</head>
<body>
    <!-- header -->
    <?php
        require ('header.php');
        require ('connect.php');

    ?>
    <!-- contenu -->
    <main>
     

        <div class="commentaire">
            <?php
                if (isset($_GET['erreur'])) {
                    if ($_GET['erreur'] == 1)
                        echo "<p style='color:red'>Ne pas envoyer avec le champ vide</p>";
                }
            ?>
 	        <form action="" method="post">
                <label for="subject">Commentaire :</label>
                
                <textarea id="subject" name="subject" placeholder="Ecrivez votre commentaire.." style="height:200px"></textarea>
                <br>    
                <input name="commentaire" type="submit" value="Envoyer">
            </form>
        </div>
    
    </main>
    <?php
        if(isset($_POST['commentaire'])){
            $login = $_SESSION['login'];
            $id = $_SESSION['id'];
            $commentaire = mysqli_real_escape_string($db,htmlspecialchars($_POST['subject']));
            if (!empty($commentaire)){
                $requete = "INSERT INTO `commentaires` (commentaire, id_utilisateur, date) VALUES ('$commentaire', $id, NOW())";
                $exec_requete = $db -> query($requete);
                //header('Location: livre-or.php');
                echo "vide";
            }
            else{
                header('Location: commentaire.php?erreur=1'); // commentaire vide
            }
        }
    ?>
        <!-- footer -->
        <?php
            include 'footer.php';
        ?>       
</body>
</html>