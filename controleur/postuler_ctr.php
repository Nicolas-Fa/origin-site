<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}


require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";

$email = recupererMailConnecte();
$membre = recupererMailMembre($email);
$role = $membre["role"];
// var_dump($role);
$id_membre = $membre["id_membre"];
$titan = recupererRoleMembre("titan");

if (estConnecte() && $role == "membre") {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["contenu_postulation"])) {
        // on récupère le contenu du formulaire
        $contenu_postulation = $_POST["contenu_postulation"];
        $url_logs = $_POST["page_de_logs"];

        // on vérifie que l'url est valide
        if(!empty($url_logs) && !filter_var($url_logs, FILTER_VALIDATE_URL)) {
            throw new Exception("L'URL fournie n'est pas valide");
        }

        // on ajoute l'url des logs au contenu
        $contenu = $contenu_postulation;
        if(!empty($url_logs)){
            $contenu .= " Logs : $url_logs";
        }

        // on enregistre le contenu dans la base de données
        $ajout_contenu_postulation = ajouterPostulation($contenu, $id_membre);
        $_SESSION["message_postulation_envoyee"] = "Votre postulation a bien été enregistrée";

        // on redirige vers la page d'accueil
        header("Location: index.php?action=postuler");
        exit;
    }

    //---------------------------------Vue-------------------------------------------
    $titre = "Origin - Postuler - Rejoignez le roster compétitif de la 10ème guilde française";
    include(RACINE . "/vue/header.php");
    include(RACINE . "/vue/postuler.php");
    include(RACINE . "/vue/footer.php");
} elseif ($titan) {
    $titre = "Origin - Accueil - Guilde Horde WoW PvE HL Serveur Sargeras";
    include(RACINE . "/vue/header.php");
    include(RACINE . "/vue/accueil.php");
    include(RACINE . "/vue/footer.php");
} else {
    // sinon renvoi à la page d'inscription
    $message = "Vous n'avez pas l'autorisation d'accéder à cette page";
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}
