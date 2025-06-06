<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";

if (!estConnecte()) {
    $titre = "Origin - Connexion";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/connexion.php";
    include RACINE . "/vue/footer.php";
    exit;
}

require_once RACINE . "/modele/personnage_bdd.inc.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";

// si le membre est connecté.....
// on visualise les infos du membre.....
$email = recupererMailConnecte();
$membre = recupererMailMembre($email);
$id_membre = $membre["id_membre"];
$pseudo = $membre["pseudo"];
$role = $membre["role"];
// on récupère tous les personnage enregistrés.....
$personnages = recupererPersonnage();
// on récupère l'id des personnages du membre
$id_personnage = recupererIdPersonnageParIdMembre($id_membre);
$pseudo_personnage = recupererPseudoPersonnageParIdMembre($id_membre);
$royaume_personnage = recupererRoyaumeParIdMembre($id_membre);

// on peut ajouter un nouveau personnage.....
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["creation_pseudo"], $_POST["creation_royaume"])) {
    // récupération des données du formulaire PÖST
    $pseudo_personnage = $_POST["creation_pseudo"];
    $royaume_personnage = $_POST["creation_royaume"];
    // on insère le nouveau personnage en base de données
    $creer_personnage = ajouterPersonnage($pseudo_personnage, $royaume_personnage, $_SESSION["id_membre"]);
    $_SESSION["message"] = "Le personnage a bien été enregistré";
    // on redirige vers la même page pour éviter une nouvelle soumission
    header("Location: index.php?action=profil");
    exit;
}

// on peut éditer le pseudo.....
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nouveau_pseudo_compte"])) {
    //recupération des données du formulaire POST
    $nouveau_pseudo = $_POST["nouveau_pseudo_compte"];
    // on remplace le pseudo du membre dans la base de données
    $changer_pseudo = editerPseudoMembre($nouveau_pseudo, $id_membre);
    $_SESSION["message_modification_pseudo_compte"] = "Pseudo modifié avec succès";
    // on redirige vers la même page
    header("Location: index.php?action=profil");
    exit;
}

// on peut éditer le mot de passe.....
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nouveau_mot_de_passe"])) {
    // on récupère les données du formulaire POST
    $nouveau_mdp = $_POST["nouveau_mot_de_passe"];
    // on remplace le mot de passe dans la base de données
    $changer_mdp = editerMdpMembre($nouveau_mdp, $id_membre);
    $_SESSION["message_modification_mdp"] = "Mot de passe modifié avec succès";
    // on redirige vers la même page
    header("Location: index.php?action=profil");
    exit;
}

// on peut changer le royaume de son personnage.....
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nouveau_royaume"])) {
    // on récupère les données du formulaire POST
    $nouveau_royaume = $_POST["nouveau_royaume"];
    $id_personnage = $_POST["id_personnage"];
    // on remplace le royaume dans la base de données
    $changer_royaume = editerRoyaumePersonnage($nouveau_royaume, $id_personnage);
    $_SESSION["message"] = "Royaume modifié avec succès";
    // on redirige vers la même page
    header("Location: index.php?action=profil");
    exit;
}

// on peut modifier le pseudo de son personnage.....
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nouveau_pseudo_perso"])) {
    // on récupère les données du formulaire POST
    $nouveau_pseudo_perso = $_POST["nouveau_pseudo_perso"];
    $id_personnage = $_POST["id_personnage"];
    // on remplace le pseudo du personnage dans la base de données
    $changer_pseudo_perso = editerPseudoPersonnage($nouveau_pseudo_perso, $id_personnage);
    $_SESSION["message"] = $changer_pseudo_perso;
    // on redirige vers la même page
    header("Location: index.php?action=profil");
    exit;
}

// // on peut supprimer son personnage ou son compte......
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_personnage_a_supprimer"])) {
    // on récupère les données du formulaire POST
    $personnage_a_supprimer = $_POST["id_personnage_a_supprimer"];
    // on supprime le personnage dans la base de données
    $personnage_supprime = supprimerPersonnage($personnage_a_supprimer);
    $_SESSION["message"] = $personnage_supprime;
    // on redirige vers la même page
    header("Location: index.php?action=profil");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["suppression_compte"])) {
    // on récupère les données du formulaire POST
    $supprimer_son_compte = $_POST["suppression_compte"];
    // on supprime le compte dans la base de données
    $compte_supprime = supprimerMembre($supprimer_son_compte);
    $_SESSION["message_suppression_compte"] = $compte_supprime;
    // on redirige vers la page d'accueil
    header("Location: index.php?action=accueil");
    exit;
}

//----------------------On affiche le profil-------------------------------------
$titre = "Origin - Profil de $pseudo";
include RACINE . "/vue/header.php";
include RACINE . "/vue/profil.php";
include RACINE . "/vue/footer.php";
exit;