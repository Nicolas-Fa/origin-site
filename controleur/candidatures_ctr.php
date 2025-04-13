<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}


require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/commentaire_bdd.inc.php";
require_once RACINE . "/modele/postulation_bdd.inc.php";
require_once RACINE . "/modele/vote_bdd.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";

$postulation = recupererPostulation();
echo "<pre>";
var_dump($postulation);
echo "</pre>";
for ($i = 0; $i < count($postulation); $i++) {
    $id_postulation = $postulation[$i]["id_postulation"];
    $membre_postulant = $postulation[$i]["id_membre"];
}

$date_postulation = recupererDatePostuParIdPostu($id_postulation);
$contenu_postulation = recupererContenuParIdMembre($membre_postulant);
$statut_postulation = recupererStatutPostuParIdPostu($id_postulation);
$votes_pour = recupererVoteParIdPostulation(true, $id_postulation);
$votes_contre = recupererVoteParIdPostulation(false, $id_postulation);

if (estConnecte()) {
    // On récupère les informations.....
    $email = recupererMailConnecte();
    $membre = recupererMailMembre($email);
    $id_membre = $membre["id_membre"];
    $pseudo = $membre["pseudo"];
    $role = recupererRoleMembreParMail($email);
    $titan = recupererRoleMembre("titan");
    $moderateur = recupererRoleMembre("moderateur");
    $commentaire = recupererCommentaires();
    // echo "<pre>";
    // var_dump($commentaire);
    // echo "</pre>";
    for ($i = 0; $i < count($commentaire); $i++) {
        $contenu_commentaire = $commentaire[$i]["contenu"];
        $id_commentaire = $commentaire[$i]["id_commentaire"];
        echo "<pre>";
        var_dump($contenu_commentaire);
        echo "</pre>";
    }
    $id_vote = recupererIdVoteParIdPostulation($id_postulation);

    // on peut ajouter un commentaire.....
    if ($titan || $moderateur) {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["commentaire"])) {
            $ajout_commentaire = ajouterCommentaires($contenu_commentaire, $id_membre, $id_postulation);
            $date_commentaire = recupererDateCommentaireParIdPostulation($id_postulation);
        }
        // ou le modifier.....
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["commentaire"])) {
            $modifier_commentaire = editerCommentaire($contenu_commentaire, $id_commentaire);
        }

        // on peut ajouter un vote.....
        // pour
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["vote_pour"])) {

            $voter_pour = ajouterVote(true, $id_membre, $id_postulation);
        }
        // ou contre
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["vote_contre"])) {
            $voter_contre = ajouterVote(false, $id_membre, $id_postulation);
        }
        // ou le modifier.....
        $modifier_vote_pour = modifierVote(false, $id_vote, $id_membre, $id_postulation);
        $modifier_vote_contre = modifierVote(true, $id_vote, $id_membre, $id_postulation);
    }

    // modération de l'espace candidatures 
    if ($moderateur) {
        $supprimer_postulation = supprimerPostulation($id_postulation);
        $supprimer_commentaire = supprimerCommentaire($id_commentaire);
    }

    //---------------------------------Vue-------------------------------------------
    // si on a le rôle "titan" ou au dessus :
    if ($titan || $moderateur) {
        $titre = "Origin - Candidatures - Recrutement des raiders mythique";
        include RACINE . "/vue/header.php";
        include RACINE . "/vue/candidatures.php"; // on accède à la page des candidatures sur lesquelles on peut commenter
        include RACINE . "/vue/footer.php";
    }
} elseif ($membre) {
    // sinon, retour à la page de postulation pour les inscrits 
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Postuler - Rejoignez le roster compétitif de la 10ème guilde française";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/postuler.php";
    include RACINE . "/vue/footer.php";
} else {
    // sinon renvoi à la page d'inscription
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}
