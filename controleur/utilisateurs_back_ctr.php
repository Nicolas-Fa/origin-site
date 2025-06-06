<?php
if (!isset($_SESSION["email"]) || ($_SESSION["role"] !== "Moderateur") && ($_SESSION["role"] !== "Admin")) {
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
require_once RACINE . "/modele/ajout_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";

$utilisateurs = recupererMembres();
$role_membre = [];
foreach ($utilisateurs as $utilisateur) {
    $role = recupererRoleMembre($utilisateur["role"]);
    array_push($role_membre, $role);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["membre"])) {
    editerRoleMembre("Membre",$_POST["pseudo_membre"]);

    $_SESSION["message"] = "L'utilisateur a maintenant le role Membre";
    header("Location: index.php?action=gestion_utilisateurs");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["titan"])) {
    editerRoleMembre("Titan",$_POST["pseudo_membre"]);

    $_SESSION["message"] = "L'utilisateur a maintenant le role Titan";
    header("Location: index.php?action=gestion_utilisateurs");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["moderateur"])) {
    editerRoleMembre("Moderateur",$_POST["pseudo_membre"]);

    $_SESSION["message"] = "L'utilisateur a maintenant le role modérateur";
    header("Location: index.php?action=gestion_utilisateurs");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["supprimer"])) {
    supprimerMembre($_POST["supprimer_membre"]);

    $_SESSION["message"] = "Utilisateur supprimé";
    header("Location: index.php?action=gestion_utilisateurs");
    exit;
}

$titre = "Origin - Modération des membres";
include RACINE . "/vue/header.php";
include RACINE . "/vue/utilisateurs_back.php";
include RACINE . "/vue/footer.php";