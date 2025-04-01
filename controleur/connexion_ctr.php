<?php
session_start();
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}

require_once RACINE . "/controleur/authentification_ctr.php";

if(estConnecte()){
    // Si on a réussi à se connecter :
    include RACINE . "/controleur/profil_ctr.php"; // on redirige l'utilisateur vers son profil
}else{
    // sinon, on redirige vers la page d'inscription
    $titre = "Origin - S'enregistrer";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}