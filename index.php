<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// controleur principal :
require(dirname(__FILE__) . "/controleur/config.php");
require(RACINE . "/controleur/routage.php");
require_once(RACINE . "/modele/authentification.inc.php"); // pour pouvoir utiliser la fonction estConnecte()

$action = "defaut";

// on récupère le contenu de la partie action dans l'url pour la navigation
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}

$fichier = navigation($action);
require(RACINE . "/controleur/" . $fichier);
