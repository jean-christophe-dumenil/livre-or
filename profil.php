<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Profil</title>
</head>

<body> 
    <!-- header -->
    <?php                 
        require ('header.php');
        require ('connect.php');
    ?>
    <main>
        
        <!-- modification des informations -->
            <?php
            // affichage en cas d'erreur
                if(isset($_POST['erreur'])){
                    if($_POST['erreur'] == 0)
                        echo "<p style='color:green'>Modifications réalisées</p>";
                    else if ($_POST['erreur'] == 1){
                        echo "<p style='color:red'>Mot de passe incorrect, modifications non réalisées</p>";
                    }
                    else if ($_POST['erreur'] == 2){
                        echo "<p style='color:red'>Veuillez entrer votre mot de passe pour réaliser des changements</p>";
                    }
                }
            ?>
            <div class="container_profil">  
                <div class="information">
                    <form action="" method="post">
                        
                        <h3>Modifiez vos informations</h3>
                        
                        <label><b>Login :</b></label>
                        <input type="text" placeholder="Entrer le login d'utilisateur" name="login" required>
                       
                        <label><b>Mot de pasee :</b></label>
                        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>                      
                                                        
                        <input type="submit" value="Modifier">
                    </form>
                </div>

                <?php
                    if(isset($_POST['login']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['password'])){
                        $login = $_POST['login'];
                        $prenom = $_POST['prenom'];
                        $nom = $_POST['nom'];
                        $password = $_POST['password'];
                        if ($password != ""){
                            $requete = "SELECT password FROM utilisateurs where login = '".$login."'";
                            $exec_requete = $db -> query($requete);
                            $reponse = mysqli_fetch_array($exec_requete);
                            $password_hash = $reponse['password'];
                            if (password_verify($password, $password_hash)) { //mot de passe correct
                                // stockage des nouvelles infos dans la BDD
                                $password = password_hash($password, PASSWORD_DEFAULT);
                                $requete = "UPDATE utilisateurs SET login = '".$_POST['login']."', prenom = '".$prenom."', nom = '".$nom."' where login = '".$login."'";
                                $exec_requete = $db -> query($requete);
                                // stockage des nouvelles infos dans les variables de session
                                $login = $_POST['login'];
                                $_SESSION['login'] = $login;
                                $_SESSION['prenom'] = $prenom;
                                $_SESSION['nom'] = $nom;
                                // redirection vers la page profil avec les nouvelles données
                                header('Location: profil.php?erreur=0');
                                }
                                else{
                                    header('Location: profil.php?erreur=1'); // mot de passe incorrect
                                    }
                                }
                            else{
                                header('Location: profil.php?erreur=2'); // mot de passe vide
                            }
                    }
                ?>
                <br>
                <br>
                <!-- modification du mot de passe -->
                <div class="mofifier-MDP">    
                    <form action="" method="post">
                        
                        <h3>Modifiez votre mot de passe</h3>
                       
                        <label><b>Ancien mot de passe :</b></label>
                        <input type="password" name="password1" id="password" placeholder="Entrez votre ancien mot de passe" required>
                      
                        <label><b>Nouveau mot de passe :</b></label>
                        <input type="password" name="newpassword" id="newpassword" placeholder="Entrez votre nouveau mot de passe" required>
                       
                        <label><b>Confirmez votre nouveau mot de passe :</b></label>
                        <input type="password" name="newpassword2" id="newpassword2" placeholder="Confirmez votre nouveau mot de passe" required>
                       
                        <input type="submit" value="Changer le mot de passe">
                    </form>
                </div> 

                <?php
                    if(isset($_POST['password1']) && isset($_POST['newpassword']) && isset($_POST['newpassword2'])){
                        if ($_POST['password1'] != ""){
                            $username = $_SESSION['username'];
                            $requete = "SELECT password from utilisateurs where `login` = '".$username."'";
                            $exec_requete = mysqli_query($db,$requete);
                            $reponse = mysqli_fetch_assoc($exec_requete);
                            if (password_verify($_POST['password1'], $reponse['password'])) { // ancien mot de passe correct
                                if (isset($_POST['newpassword']) && $_POST['newpassword'] !== '' && isset($_POST['newpassword2']) && $_POST['newpassword2'] !== ''){
                                    if ($_POST['newpassword'] == $_POST['newpassword2']){ // nouveau mot de passe correct
                                        $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
                                        // stockage du nouveau mot de passe dans la BDD
                                        $requete = "UPDATE utilisateurs SET password = '".$password."'";
                                        $exec_requete = $db -> query($requete);
                                        // stockage du nouveau mot de passe dans les variables de session
                                        $_SESSION['password'] = $password;
                                        // redirection avec message de réussite
                                        header('Location: profil.php?erreur=6');                     
                                        }
                                    else{
                                    // $_SESSION['erreur'] = 3; // les deux mots de passe ne correspondent pas
                                        header('Location: profil.php?erreur=3'); // deux mots de passe différents
                                    }
                                }
                                else{
                                    //$_SESSION['erreur'] = 4; // case nouveau mot de passe vide
                                    header('Location: profil.php?erreur=4'); // nouveau mot de passe vide
                                }
                            }
                            else{
                                //$_SESSION['erreur'] = 5; // ancien mot de passe incorrect
                                header('Location: profil.php?erreur=5'); // ancien mot de passe incorrect
                            }
                        }
                        else{
                        //$_SESSION['erreur'] = 5; // ancien mot de passe vide
                            header('Location: profil.php?erreur=5'); // ancien mot de passe vide
                        }
                    }
                ?>
            </div>
    </main>
            <!-- footer -->
    <?php
        include 'footer.php';
    ?>           
</body>
</html>