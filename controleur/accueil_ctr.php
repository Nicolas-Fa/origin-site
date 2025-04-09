<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}

require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";

if (estConnecte()) {
    $email = recupererMailConnecte();
    $membre = recupererMailMembre($email);
    // var_dump($membre);
    $role = $membre["role"];
    // var_dump($role);
}else{
    $role = '';
}

$titan = recupererRoleMembre("Titan");
// echo "<pre>";
// var_dump($titan);
// echo "</pre>";

//---------------------------------Vue-------------------------------------------
$titre="Origin - Accueil - Guilde Horde WoW PvE HL Serveur Sargeras";
include (RACINE . "/vue/header.php");
include (RACINE . "/vue/accueil.php");
include (RACINE . "/vue/footer.php");