<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <title>Connexion</title>
</head>
<body>
    <!-- header -->
    <?php
        require ('header.php');
        require ('connect.php')
    ?>
    <!-- contenu -->
    <main>
        <div id="container">
        <!-- zone de connexion -->
 
            <form action="verification.php" method="post">
                <h1>Connexion</h1>
 
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='Se connecter' >
                <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 ){//|| $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                        }
                        else if ($err==2) {
                            echo "login";
                        }
                    }
                    ?>
            </form>
        </div>
    </main>
        <!-- footer -->
        <?php
            include 'footer.php';
        ?>       
</body>
</html>