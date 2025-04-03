<?php
session_start();
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}

require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";

$est_inscrit = false;
$message = null;

// On va récupérer les données POST et SESSION et vérifier que les informations n'existent pas déjà

if (isset($_POST["pseudo"]) && isset($_POST["email"]) && isset($_POST["mot_de_passe"])) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $email = htmlspecialchars($_POST["email"]);
    $pwd = $_POST["mot_de_passe"];

    if (recupererPseudoMembre($pseudo) == true) {
        $message = "Ce pseudo existe déjà.";
    } else {
        if (recupererMailMembre($email) == true) {
            $message = "Email déjà utilisé.";
        } else {
            $inscription = sInscrire($pseudo, $email, $pwd);
            if ($inscription) {
                $est_inscrit = true;
            } else {
                $message = "Enregistrement impossible";
            }
        }
    }
} else {
    if ($message !== null) {
        $message = "Tous les champs doivent-être remplis";
    }
}

//---------------------------------Vue-------------------------------------------
if ($est_inscrit) { // si l'inscription a fonctionné : redirection vers le profil
    include RACINE . "/controleur/profil_ctr.php";
} else { // sinon, retour sur la page d'inscription
    $titre = "Origin - S'inscrire - Rejoignez notre communauté!";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}
