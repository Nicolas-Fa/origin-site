<?php

if (!isset($_SESSION['email'])) {
    /* l'utilisateur n'est pas connecté */
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/connexion.php";
    include RACINE . "/vue/footer.php";
    exit;           // fin du script
}

// l'utilisateur est connecté puisque son role est rangé dans la session
if ($_SESSION["role"] != "Titan" && $_SESSION["role"] != "Moderateur" && $_SESSION["role"] != "Admin") {
    // c'est un simple membre
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Postuler - Rejoignez le roster compétitif de la 10ème guilde française";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/postuler.php";
    include RACINE . "/vue/footer.php";
    exit;           // fin du script
}

require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";
require_once RACINE . "/modele/commentaire_bdd.inc.php";
require_once RACINE . "/modele/postulation_bdd.inc.php";
require_once RACINE . "/modele/vote_bdd.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";

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
    $_SESSION["message"] = "Votre commentaire a bien été publié";
    // on redirige vers la même page pour éviter une nouvelle soumission
    header("Location: index.php?action=candidatures");
    exit;
}
// ou le modifier.....
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["contenu_edition"])) {
    editerCommentaire(
        $_POST["contenu_edition"],
        $_POST["editer_commentaire"]
    );
    $_SESSION["message"] = "Votre commentaire a bien été modifié";
    // on redirige vers la même page pour éviter une nouvelle soumission
    header("Location: index.php?action=candidatures");
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

// récupérer les votes pour chaque postulation en cours
$agregat_votes = [];
foreach ($postulations as $postulation) {
    $votes = recupererVotesParIdPostulation($postulation["id_postulation"]);
    array_push($agregat_votes, $votes);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["voter_pour"])) {
    enregistrer_vote(true, $_POST["voter_pour"], $_SESSION["id_membre"]);
    $_SESSION["message"] = "Votre vote a bien été enregistré";
    header("Location: index.php?action=moderation_candidatures");
    exit;
}

// ou contre
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["voter_contre"])) {
    enregistrer_vote(false, $_POST["voter_contre"], $_SESSION["id_membre"]);
    $_SESSION["message"] = "Votre vote a bien été enregistré";
    header("Location: index.php?action=moderation_candidatures");
    exit;
}

// -------------------- Génération de la vue------------------

$titre = "Origin - Candidatures - Recrutement des raiders mythique";
include RACINE . "/vue/header.php";
include RACINE . "/vue/candidatures.php"; // on accède à la page des candidatures sur lesquelles on peut commenter
include RACINE . "/vue/footer.php";
exit;

// ----- fonction de prise en compte du vote par un membre sur une postulation -----
/**
 * Enregistre le vote d'un membre pour une postulation.
 * Si le membre a déjà voté, son vote est mis à jour.
 * @param bool $vote - Le choix du vote : true pour "pour", false pour "contre"
 * @param int $id_postulation - L'identifiant de la postulation concernée par le vote
 * @param int $id_votant - L'identifiant du membre qui vote
 * @return void
 */
function enregistrer_vote($vote, $id_postulation, $id_votant): void
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