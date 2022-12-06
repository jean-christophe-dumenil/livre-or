<?php
    session_start();
?>
<header>   
            <!-- tester si l'utilisateur est connecté -->
            <?php

                if (isset($_GET['deconnexion'])){
                    if($_GET['deconnexion']==true){
                        session_unset();
                        header('Location: index.php');
                    }
                }

                else if (isset($_SESSION['login'])) {
                    $user = $_SESSION['login'];
                    $id = $_SESSION['id'];
                    // afficher les liens menus correspondants à la session
                    ?>
                    <nav id="wrap">
                        <ul class="navbar">
                            <li><a href="index.php"></i>Accueil</a></li>
                            <li><a href="profil.php"></i>Profil</a></li>
                            <li><a href="livre-or.php"></i>Livre d'or</a></li>
                            <li><a href="commentaire.php"></i>Commentaire</a></li>
                        
                        
                            <li><a href="index.php?deconnexion=true">Déconnexion</a></li>
                        </ul>
                    </nav>
                    <?php
                        } else { 
                    ?>
                    <nav id="wrap">
                        <ul class="navbar">
                            <li><a href="index.php"></i>Accueil</a></li>
                            <li><a href="livre-or.php"></i>Livre d'or</a></li>
                        </ul>
                    </nav>
                    <?php   
                        }   
                    ?>
</header>
