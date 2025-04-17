<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}

require_once RACINE . "/controleur/authentification_ctr.php";

if (estConnecte()) {
    // Si on est connecté :
    include RACINE . "/controleur/profil_ctr.php"; // on redirige l'utilisateur vers son profil
} else {
    // sinon, on redirige vers la page de connexion
    $titre = "Origin - Se connecter";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/connexion.php";
    include RACINE . "/vue/footer.php";
}
