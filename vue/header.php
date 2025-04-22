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

<?php include RACINE . "/vue/head.php";  ?>

<body>
    <header>
        <a href="?action=accueil"><img class="logo_origin" src="public/images/logo.webp" alt="Logo de la guilde Origin"></a>
        <!-- Menu navigation -->
        <nav class="navigation">
            <div id="burger">
                <a href="#" aria-label="Menu déroulant"><i class="fa-solid fa-bars"></i></a>
            </div>
            <ul class="nav_liste">
                <!-- navigation visible par tout le monde -->
                <li><a href="?action=accueil" aria-label="Lien vers l'accueil">Accueil</a></li>
                <!-- navigation visible par les personnes enregistrées et connectées -->
                <?php if (isset($_SESSION["email"])) : ?>
                    <li><a href="?action=profil" aria-label="Lien vers la page de profil">Profil</a></li>
                <?php endif;
                if (isset($_SESSION["email"]) && ($_SESSION["role"] == "Membre")) : ?>
                    <li class="nav_visiteur"><a href="?action=postuler" aria-label="Lien vers le formulaire de postulation">Postuler</a></li>
                <?php endif;
                if (isset($_SESSION["email"]) && ($_SESSION["role"] == "Titan")): ?>
                    <!-- navigation visible par les membres ayant le rôle titan -->
                    <li class="nav_roster"><a href="?action=candidatures" aria-label="Lien vers les candidatures">Candidatures</a></li>
                    <!-- navigation visible par les visiteurs  -->
                <?php endif;
                if (isset($_SESSION["email"]) && (($_SESSION["role"] == "Admin") || ($_SESSION["role"] == "Moderateur"))) : ?>
                    <!-- navigation visible par les membres ayant le rôle titan -->
                    <li class="nav_admin"><a href="?action=moderation_candidatures" aria-label="Lien vers la modération des candidatures">Gérer candidatures</a></li>
                    <!-- navigation visible par les visiteurs  -->
                <?php endif;
                if (isset($_SESSION["email"]) && (($_SESSION["role"] == "Admin") || ($_SESSION["role"] == "Moderateur"))) : ?>
                    <!-- navigation visible par les membres ayant le rôle titan -->
                    <li class="nav_admin"><a href="?action=gestion_utilisateurs" aria-label="Lien vers la modération des utilisateurs">Gérer utilisateurs</a></li>
                    <!-- navigation visible par les visiteurs  -->
                <?php endif;
                if (!isset($_SESSION["email"])) : ?>
                    <li class="nav_visiteur"><a href="?action=connexion" aria-label="Se connecter">Se connecter</a></li>
                    <li class="nav_visiteur"><a href="?action=inscription" aria-label="S'inscrire">S'inscrire</a></li>
                <?php endif; ?>
                <!-- log out -->
                <?php if (isset($_SESSION["email"])): ?>
                    <li class="nav_connecte"><a href="?action=deconnexion" class="deconnexion" aria-label="Déconnexion">Déconnexion</a></li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>