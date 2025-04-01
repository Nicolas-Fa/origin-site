<?php
session_start();
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}


require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/personnage_bdd.inc.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";


if (estConnecte()) {
    // on visualise les infos du membre
    $email = recupererMailConnecte();
    $membre = recupererMailMembre($email);
    $id_membre = $membre["id_membre"];
    $pseudo = $membre["pseudo"];
    $role = $membre["role"];

    // on visualise les personnage enregistrés du membre
    $personnage = recupererPersonnage();
    $pseudo_personnage = ucfirst(recupererPseudoPersonnageParIdMembre($id_membre));
    $royaume_personnage = ucfirst(recupererRoyaumeParIdMembre($id_membre, $pseudo_personnage));

    // on peut ajouter un nouveau personnage
    $creer_personnage = ajouterPersonnage($creer_pseudo_personnage, $creer_royaume_personnage, $id_membre);

    // edition du profil 
    $changer_pseudo = editerPseudoMembre($nouveau_pseudo, $id_membre);
    $changer_mdp = editerMdpMembre($nouveau_mdp, $id_membre);
    $changer_royaume = editerRoyaumePersonnage($nouveau_royaume, $id_membre, $id_personnage);
    $changer_pseudo_perso = editerPseudoPersonnage($nouveau_pseudo_perso, $id_membre, $id_personnage);

    $titre = "Origin - Profil de $pseudo";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/profil.php";
    include RACINE . "/vue/footer.php";
}else{
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}
