<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Inscription</title>
</head>

<body>   
        <!-- header -->
        <?php
            require ('header.php');
            require ('connect.php');
        ?>
        <!-- contenu -->
        <main>
           
                <?php
                    //par défaut, on affiche le formulaire
                    $AfficherFormulaire=1;
                    //traitement du formulaire:
                    if(isset($_POST['login'],$_POST['password'])){
                        $login = mysqli_real_escape_string($db, htmlspecialchars($_POST['login']));
                        $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));
             
                        if($_POST['login'] = ""){ // si le login est vide
                            echo "<p style='color:red'>Le champ nom d'utilisateur est vide.</p>";
                        } elseif(mysqli_num_rows(mysqli_query($db,"SELECT * FROM utilisateurs WHERE login='".$_POST['login']."'"))==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                            echo "<p style='color:red'>Ce pseudo est déjà utilisé.</p>";
                        } elseif($_POST['password']== "" || $_POST['password2']== ""){
                            echo "<p style='color:red'>Le champs Mot de passe est vide.</p>";
                        } elseif ($_POST['password'] != $_POST['password2']) { 
                            echo "<p style='color:red'>Les mots de passe ne correspondent pas.</p>";
                        } else {
                            //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
                            //cryptage du mot de passe
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            if(!mysqli_query($db,"INSERT INTO utilisateurs (login, password) values('".$login."','".$password."')")) {
                                echo "<p style='color:red'>Une erreur s'est produite: </p>".mysqli_error($db);
                            } else {
                                echo "Vous êtes inscrit(e) avec succès!";
                                //on n'affiche plus le formulaire
                                $AfficherFormulaire=0;
                                header('Location: connexion.php'); // redirection vers la page de connexion
                            }
                        }
                        mysqli_close($db); // fermeture de la connexion à la base de données pour plus de propreté
                    }
                    if($AfficherFormulaire==1){ // si le formulaire doit être affiché
                    }    
                ?>
                <div id="container">
                    <form method="post" action="">
                        
                        <h3>Créez votre profil</h3>
                        
                        <label><b>Nom d'utilisateur :</b></label>
                        <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required> 

                        <label><b>Mot de passe :</b></label>
                        <input type="password" placeholder="Entrer votre mot de passe" name="password" required> 

                        <label><b>Confirmez le mot de passe :</b></label>
                        <input type="password" placeholder="Veuillez confirmer votre mot de passe" name="password2" required> 

                        <input type="submit" value="Inscription">
                    </form>
                
            </div>
        </main> <!-- /main -->
        <!-- footer -->
        <?php
            include 'footer.php';
        ?>       
</body>
</html>