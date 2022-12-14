<?php
    session_start();
    if(isset($_POST['username']) && isset($_POST['password'])){
    // connexion à la base de données
        $db_username = 'root';
        $db_password = '';
        $db_name = 'livreor';
        $db_host = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
        or die('could not connect to database');
 
         // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
        $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
 
        if($username !== "" && $password !== ""){
            $requete = "SELECT count(*) FROM utilisateurs where `login` = '".$username."'";
            $exec_requete = mysqli_query($db,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
            if($count!=0) // nom d'utilisateur correct 
            {
                $requete = "SELECT * from utilisateurs where `login` = '".$username."'";
                $exec_requete = mysqli_query($db,$requete);
                $reponse = mysqli_fetch_assoc($exec_requete);
                if (password_verify($password,$reponse['password'])){  // mot de passe correct
                    $_SESSION['login'] = $username;
                    $_SESSION['connect'] = true;
                    $_SESSION['id'] = $reponse['id'];
                    header('Location: index.php');
                }
                else {
                    header('location: connexion.php?erreur=1'); // mot de passe incorrect
                }
            }
    
            else{
                header('Location: connexion.php?erreur=2');
            }
        }
        mysqli_close($db); // fermer la connexion
    }
?>
