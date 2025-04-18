<?php 

if ($_SESSION["role"] !== "Moderateur" || $_SESSION["role"] !== "Admin") {
    /* l'utilisateur n'est pas connecté */
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/connexion.php";
    include RACINE . "/vue/footer.php";
    exit;           // fin du script
}
require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";
require_once RACINE . "/modele/commentaire_bdd.inc.php";
require_once RACINE . "/modele/postulation_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";
require_once RACINE . "/controleur/candidatures_ctr.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["supprimer_postulation"])) {
    supprimerPostulation($_POST[$id_postulation]);
    enregister_vote(false, $_POST["voter_contre"], $_SESSION["id_membre"]);
    //ajouterVote(false, $_SESSION["id_membre"], $_POST["voter_contre"]);
    $_SESSION["message_vote"] = "Votre vote a bien été enregistré";
    header("Location: index.php?action=candidatures");
    exit;
}

    
    $supprimer_commentaire = supprimerCommentaire($id_commentaire);



    $titre = "Origin - Modération des candidatures et commentaires";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/candidatures_back.php";
    include RACINE . "/vue/footer.php";