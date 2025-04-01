<?php
session_start();
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}

require_once RACINE . "/modele/authentification.inc.php";
include_once RACINE . "/modele/membre_bdd.inc.php";
include_once RACINE . "/modele/ajout_bdd.inc.php";

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
    $message = "Tous les champs doivent-être remplis";
}


if ($est_inscrit) {
    $titre = "Origin - Inscription confirmée - Profil de $pseudo";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/profil.php";
    include RACINE . "/vue/footer.php";
} else {
    $titre = "Origin - Inscription echouée";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}
