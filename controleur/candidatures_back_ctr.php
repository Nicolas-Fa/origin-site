<?php
if (!isset($_SESSION["email"]) || ($_SESSION["role"] !== "Moderateur") && ($_SESSION["role"] !== "Admin")) {
    /* l'utilisateur n'est pas connecté */
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Accueil - Guilde Horde WoW PvE HL Serveur Sargera";
    require RACINE . "/controleur/accueil_ctr.php";
    exit;           // fin du script
}

require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";
require_once RACINE . "/modele/commentaire_bdd.inc.php";
require_once RACINE . "/modele/postulation_bdd.inc.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";
require_once RACINE . "/modele/vote_bdd.php";


// ---------------------------partie disponible également aux non modérateurs---------------------
// les modérateurs doivent avoir les mêmes options que les utilisateurs sans avoir à changer de compte à chaque fois
// --- Ajout d'un commentaire
if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["commentaire_postulation"])
    && isset($_POST["contenu_commentaire"])
) {
    $ajout_commentaire = ajouterCommentaires(
        $_POST["contenu_commentaire"],
        $_SESSION["id_membre"],
        $_POST["commentaire_postulation"]
    );
    $_SESSION["message_commentaire"] = "Votre commentaire a bien été publié";
    // on redirige vers la même page pour éviter une nouvelle soumission
    header("Location: index.php?action=moderation_candidatures");
    exit;
}
// ou le modifier.....
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["contenu_edition"])) {
    editerCommentaire(
        $_POST["contenu_edition"],
        $_POST["editer_commentaire"]
    );
    $_SESSION["message_commentaire"] = "Votre commentaire a bien été modifié";
    // on redirige vers la même page pour éviter une nouvelle soumission
    header("Location: index.php?action=moderation_candidatures");
    exit;
}

// --- Récupérer toutes les postulations en cours
$postulations = recupererPostulationsEnCours();

// --- Récupérer tous les commentaires pour chaque postulation en cours
// Les commentaires sont classées par postulations
$agregat_commentaires = [];
foreach ($postulations as $postulation) {
    $commentaires = recupererCommentairesParIdPostulation($postulation["id_postulation"]);
    array_push($agregat_commentaires, $commentaires);
}
// echo "<pre>";
// var_dump($agregat_commentaires);
// echo "</pre>";

// récupérer les votes pour chaque postulation en cours
$agregat_votes = [];
foreach ($postulations as $postulation) {
    $votes = recupererVotesParIdPostulation($postulation["id_postulation"]);
    array_push($agregat_votes, $votes);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["voter_pour"])) {
    enregister_vote(true, $_POST["voter_pour"], $_SESSION["id_membre"]);
    $_SESSION["message_vote"] = "Votre vote a bien été enregistré";
    header("Location: index.php?action=moderation_candidatures");
    exit;
}
// ou contre
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["voter_contre"])) {
    enregister_vote(false, $_POST["voter_contre"], $_SESSION["id_membre"]);
    $_SESSION["message_vote"] = "Votre vote a bien été enregistré";
    header("Location: index.php?action=moderation_candidatures");
    exit;
}

// ---------------------------partie disponible uniquement aux modérateurs---------------------

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["supprimer_postulation"])) {
    supprimerPostulation($_POST["supprimer_postulation"]);

    $_SESSION["message_suppression"] = "Postulation supprimée";
    header("Location: index.php?action=moderation_candidatures");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["supprimer_commentaire"])) {
    supprimerCommentaire($_POST["supprimer_commentaire"]);

    $_SESSION["message_suppression"] = "Commentaire supprimé";
    header("Location: index.php?action=moderation_candidatures");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["refuser_postulation"])) {
    editerStatutPostulation("Refusee", $_POST["refuser_postulation"]);

    $_SESSION["message_statut"] = "Postulation refusée";
    header("Location: index.php?action=moderation_candidatures");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accepter_postulation"])) {
    editerStatutPostulation("Validee", $_POST["accepter_postulation"]);

    $_SESSION["message_statut"] = "Postulation refusée";
    header("Location: index.php?action=moderation_candidatures");
    exit;
}



$titre = "Origin - Modération des candidatures et commentaires";
include RACINE . "/vue/header.php";
include RACINE . "/vue/candidatures_back.php";
include RACINE . "/vue/footer.php";

// ----- fonction de prise en compte du vote par un membre sur une postulation -----

function enregister_vote($vote, $id_postulation, $id_votant)
{
    // Le votant a-t-il déjà voté pour cette postulation ?
    $vote_actuel = recupererVoteParIdPostulationEtParIdMembre($id_postulation, $id_votant);
    if ($vote_actuel == null) {
        // le membre n'a jamais voté pour cette postulation -> ajout du vote
        ajouterVote($vote, $id_votant, $id_postulation);
        return;
    }
    // sinon, le votant s'est déjà exprimé sur cette postulation -> modification de son vote
    modifierVote($vote, $vote_actuel['id_vote']);
    return;
}
