<?php
session_start();
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}


require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/commentaire_bdd.inc.php";
require_once RACINE . "/modele/postulation_bdd.inc.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";

$postulation = recupererPostulation();
$id_postulation = $postulation["id_postulation"];
$membre_postulant = $postulation["id_membre"];
$date_postulation = recupererDatePostuParIdPostu($id_postulation);
$contenu_postulation = htmlspecialchars(recupererContenuParIdMembre($membre_postulant));
$statut_postulation = recupererStatutPostuParIdPostu($id_postulation);
$votes_pour = recupererVoteParIdPostulation(true, $id_postulation);
$votes_contre = recupererVoteParIdPostulation(false, $id_postulation);

if (estConnecte()) {
    // On récupère les informations.....
    $email = recupererMailConnecte();
    $membre = recupererMailMembre($email);
    $id_membre = $membre["id_membre"];
    $pseudo = htmlspecialchars($membre["pseudo"]);
    $role_membre = recupererRoleMembreParMail($email);
    $titan = recupererRoleMembre("titan");
    $moderateur = recupererRoleMembre("moderateur");
    $commentaire = recupererCommentaires();
    $contenu_commentaire = htmlspecialchars($commentaire["contenu"]);
    $id_vote = recupererIdVoteParIdPostulation($id_postulation);

    // on peut ajouter un commentaire.....
    if ($titan || $moderateur) {
        $ajout_commentaire = trim(ajouterCommentaires($contenu_commentaire, $id_membre, $postulation["id_postulation"]), ENT_QUOTES, 'UTF-8');
        $date_commentaire = recupererDateCommentaireParIdPostulation($id_postulation);
    }

    // on peut ajouter un vote.....
    $voter_pour = ajouterVote(true, $id_membre, $id_postulation);
    $voter_contre = ajouterVote(false, $id_membre, $id_postulation);

    // ou le modifier.....
    $modifier_vote_pour = modifierVote(false, $id_vote, $id_membre, $id_postulation);
    $modifier_vote_contre = modifierVote(true, $id_vote, $id_membre, $id_postulation);

    if (recupererRoleMembre("titan") || recupererRoleMembre("moderateur")) {
        $titre = "Origin - Candidatures - Recrutement des raiders mythique";
        include RACINE . "/vue/header.php";
        include RACINE . "/vue/candidatures.php";
        include RACINE . "/vue/footer.php";
    }
} else {
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}
//---------------------------------Vue-------------------------------------------