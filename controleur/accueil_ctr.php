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
    $role = $membre["role"];
}else{
    $role = '';
}

$titan = recupererRoleMembre("Titan");
$moderateur = recupererRoleMembre("Moderateur");
// on va chercher les images
$chemin_images = RACINE . "/public/images";
// puis on scanne le dossier
$fichiers = scandir($chemin_images);
// pour n'en filtrer que les images de boss
$images_boss = array_filter($fichiers, function($fichiers){
    return preg_match('/^boss_\d+\.webp$/', $fichiers); // on récupère les images qui commencent par boss_ avec un ou plusieurs chiffres, en format .webp
});
// et on les trie dans l'ordre
natsort($images_boss);

//---------------------------------Vue-------------------------------------------
$titre="Origin - Accueil - Guilde Horde WoW PvE HL Serveur Sargeras";
include (RACINE . "/vue/header.php");
include (RACINE . "/vue/accueil.php");
include (RACINE . "/vue/footer.php");