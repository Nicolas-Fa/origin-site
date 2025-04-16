<?php
if (!estConnecte()) {
    /* l'utilisateur n'est pas connecté */
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/connexion.php";
    include RACINE . "/vue/footer.php";
    exit;           // fin du script
}

// l'utilisateur est connecté puisque son role est rangé dans la session
if ($_SESSION["role"] != "Titan" && $_SESSION["role"] != "Moderateur") {
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

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
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
    header("Location: index.php?action=candidatures");
    exit;
}
// ou le modifier.....
$commentaires = recupererCommentaires();

$auteurs = [];
foreach ($commentaires as $commentaire) {
    // on récupère le pseudo du membre qui a posté le commentaire 
    $id_auteur = $commentaire["id_membre"];
    array_push($auteurs, $id_auteur);
}
echo "<pre>";
var_dump($commentaire);
echo "</pre>";

for ($i = 0; $i < count($auteurs); $i++) {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["editer_commentaire"]) && isset($_POST["contenu_edition"])) {
        $modification = editerCommentaire(
            $_POST["contenu_edition"],
            $commentaires[$i]["id_commentaire"]
        );
    }
}

// echo "<pre>";
// var_dump($commentaire);
// echo "</pre>";
// ... to be done ...


// --- Récupérer toutes les postulations en cours
$postulations = recupererPostulationsEnCours();
// echo "<pre>";
// var_dump($postulations);
// echo "</pre>";

// --- Récupérer tous les commentaires pour chaque postulation en cours
// Les commentaires sont classées par postulations
$agregat_commentaires = [];
foreach ($postulations as $postulation) {
    $commentaires = recupererCommentairesParIdPostulation($postulation["id_postulation"]);
    array_push($agregat_commentaires, $commentaires);
}



// -------------------- Génération de la vue------------------

if ($_SESSION["role"] != null && $_SESSION["role"] != "Membre") {
    $titre = "Origin - Candidatures - Recrutement des raiders mythique";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/candidatures.php"; // on accède à la page des candidatures sur lesquelles on peut commenter
    include RACINE . "/vue/footer.php";
    exit;
}


// ------------------ if available according to the role ------------------

$votes_pour = recupererVoteParIdPostulation(true, $id_postulation);
$votes_contre = recupererVoteParIdPostulation(false, $id_postulation);

if (estConnecte()) {
    // On récupère les informations.....
    $email = recupererMailConnecte();
    $membre = recupererMailMembre($email);
    $id_membre = $membre["id_membre"];
    $pseudo = $membre["pseudo"];
    $role = $membre["role"];
    // echo "<pre>";
    // var_dump($role);
    // echo "</pre>";
    $titan = recupererRoleMembre("titan");
    $moderateur = recupererRoleMembre("moderateur");
    $commentaires = recupererCommentaires();
    // echo "<pre>";
    // var_dump($commentaires);
    // echo "</pre>";

    foreach ($commentaires as $commentaire) {
        // on récupère le pseudo du membre qui a posté le commentaire 
        $pseudo_auteur = recupererPseudoMembreParIdMembre($commentaire["id_membre"]);
        $commentaire["pseudo"] = $pseudo_auteur["pseudo"];
        // on récupère la date du commentaire dans la bdd
        $date_commentaire_bdd = recupererDateCommentaireParIdPostulation($id_postulation);
        // on la formate au format europeen
        $commentaire["date_commentaire"] = date("d-m-Y H:i:s", strtotime($date_commentaire_bdd["date_commentaire"]));
    }
    // echo "<pre>";
    // var_dump($commentaire["date_commentaire"]);
    // echo "</pre>";

    // $contenu_commentaire = [];
    // for ($i = 0; $i < count($commentaires); $i++) {
    //     $contenu_commentaire[] = $commentaires[$i]["contenu"];
    //     $id_commentaire = $commentaires[$i]["id_commentaire"];
    // }


    $id_vote = recupererIdVoteParIdPostulation($id_postulation);

    // on peut ajouter un commentaire.....
    if ($titan || $moderateur) {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["commentaire_postulation_$id_postulation"])) {
            $ajout_commentaire = ajouterCommentaires($contenu_commentaire, $id_membre, $id_postulation);
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


}
