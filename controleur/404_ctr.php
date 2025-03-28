<?php 
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}

$titre="La page que vous recherchez n'existe pas!";
include (RACINE . "/vue/header.php");
include (RACINE . "/vue/404_vue.php");
include (RACINE . "/vue/footer.php");
 ?>