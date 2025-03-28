<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>
<!DOCTYPE html>
<html lang="fr">

<?php include('head.php');  ?>

<body>
    <header class="container">
        <!----------------------------------Menu navigation------------------------------------------>
        <nav class="navigation">
            <ul class="nav_liste">
                <!-- navigation visible par tout le monde -->
                <li><a href="?action=accueil">Accueil</a></li>
                <li><a href="?action=profil">Profil</a></li>
                <!-- navigation visible par les membres du roster -->
                <?php //if (estConnecte()) { ?>
                    <li class="nav_roster"><a href="?action=candidatures">Candidatures</a></li>
                    <!-- navigation visible par les visiteurs  -->
                    <li class="nav_visiteur"><a href="?action=postuler">Postuler</a></li>
                <?php //} else { ?>
                    <li class="nav_visiteur"><a href="?action=connexion">Se connecter</a></li>
                    <li class="nav_visiteur"><a href="?action=inscription">S'inscrire</a></li>
                <?php // } ?>
                <!-- log out -->
                <li class="nav_connecte"><button type="button">Se déconnecter</button></li>

            </ul>
        </nav>
    </header>