<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}


require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";

$email = recupererMailConnecte();
$membre = recupererMailMembre($email);
$role_membre = recupererRoleMembre("membre");
$id_membre = $membre["id_membre"];
$titan = recupererRoleMembre("titan");

if (estConnecte() && $role_membre) {
    $ajout_contenu_postulation = ajouterPostulation($contenu, $id_membre);


    //---------------------------------Vue-------------------------------------------
    $titre = "Origin - Postuler - Rejoignez le roster compétitif de la 10ème guilde française";
    include(RACINE . "/vue/header.php");
    include(RACINE . "/vue/postuler.php");
    include(RACINE . "/vue/footer.php");
} elseif ($titan) {
    $titre = "Origin - Accueil - Guilde Horde WoW PvE HL Serveur Sargeras";
    include(RACINE . "/vue/header.php");
    include(RACINE . "/vue/accueil.php");
    include(RACINE . "/vue/footer.php");
} else {
    // sinon renvoi à la page d'inscription
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}
