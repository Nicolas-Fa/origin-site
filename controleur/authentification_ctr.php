<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}

require_once RACINE . "/modele/authentification.inc.php";

// On va récupérer les données POST et SESSION

if (isset($_POST["email"]) && isset($_POST["mot_de_passe"])) {
    $email = htmlspecialchars($_POST["email"]);
    $pwd = $_POST["mot_de_passe"];
    if ($email && password_verify($pwd, $pwd_bdd)) {
        // Lorsque les infos sont correctes on se connecte
        seConnecter($email, $pwd);
        $messageCo = "Connexion réussie";
    }else{
        $messageErreurCo = "L'email ou le mot de passe sont inccorects";
    }
} else {
    $email = null;
    $pwd = null;
}

seConnecter($email, $pwd);