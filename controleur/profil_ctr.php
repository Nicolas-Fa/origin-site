<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}


require_once RACINE . "/modele/authentification.inc.php";
require_once RACINE . "/modele/membre_bdd.inc.php";
require_once RACINE . "/modele/personnage_bdd.inc.php";
require_once RACINE . "/modele/ajout_bdd.inc.php";
require_once RACINE . "/modele/maj_bdd.inc.php";
require_once RACINE . "/modele/supprimer_bdd.inc.php";

// si le membre est connecté.....
if (estConnecte()) {
    // on visualise les infos du membre.....
    $email = recupererMailConnecte();
    $membre = recupererMailMembre($email);
    // echo "<pre>";
    // var_dump($membre);
    // echo "</pre>";
    $id_membre = $membre["id_membre"];
    $pseudo = htmlspecialchars($membre["pseudo"]);
    $role = $membre["role"];

    // on récupère tous les personnage enregistrés.....
    $personnage = recupererPersonnage();
    // echo "<pre>";
    // var_dump($personnage);
    // echo "</pre>";

    // on récupère l'id des personnages du membre
    $id_personnage = recupererIdPersonnageParIdMembre($id_membre);
    // echo "<pre>";
    // var_dump($id_personnage);
    // echo "</pre>";


    $pseudo_personnage = recupererPseudoPersonnageParIdMembre($id_membre);
    // echo "<pre>";
    // var_dump($pseudo_personnage);
    // echo "</pre>";

    $royaume_personnage = recupererRoyaumeParIdMembre($id_membre, $pseudo_personnage);
    echo "<pre>";
    var_dump($royaume_personnage[0]["royaume"]);
    echo "</pre>";


    // on peut ajouter un nouveau personnage.....
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["creation_pseudo"], $_POST["creation_royaume"])) {
        // récupération des données du formulaire PÖST
        $creer_pseudo_personnage = $_POST["creation_pseudo"];
        $creer_royaume_personnage = $_POST["creation_royaume"];
        // on insère le nouveau personnage en base de données
        $creer_personnage = ajouterPersonnage($creer_pseudo_personnage, $creer_royaume_personnage, $id_membre);
        $message = "Le personnage a bien été enregistré";
        // on redirige vers la même page pour éviter une nouvelle soumission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // on peut éditer le pseudo.....
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nouveau_pseudo"])) {
        //recupération des données du formulaire POST
        $nouveau_pseudo = $_POST["nouveau_pseudo"];
        // on remplace le pseudo du membre dans la base de données
        $changer_pseudo = editerPseudoMembre($nouveau_pseudo, $id_membre);
        $message = "Pseudo modifié avec succès";

        // on redirige vers la même page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // on peut éditer le mot de passe.....
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nouveau_mot_de_passe"])) {
        // on récupère les données du formulaire POST
        $nouveau_mdp = $_POST["nouveau_mot_de_passe"];

        // on remplace le mot de passe dans la base de données
        $changer_mdp = editerMdpMembre($nouveau_mdp, $id_membre);
        $message = "Mot de passe modifié avec succès";

        // on redirige vers la même page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // on peut changer le royaume de son personnage.....
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nouveau_royaume"])) {
        // on récupère les données du formulaire POST
        $nouveau_royaume = $_POST["nouveau_royaume"];

        // on remplace le royaume dans la base de données
        $changer_royaume = editerRoyaumePersonnage($nouveau_royaume, $id_membre, $id_personnage);
        $message = "Royaume modifié avec succès";

        // on redirige vers la même page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // on peut modifier le pseudo de son personnage.....
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nouveau_pseudo_perso"])) {
        // on récupère les données du formulaire POST
        $nouveau_royaume = $_POST["nouveau_pseudo_perso"];

        // on remplace le royaume dans la base de données
        $changer_pseudo_perso = editerPseudoPersonnage($nouveau_pseudo_perso, $id_membre, $id_personnage);
        $message = "Pseudo du personnage modifié avec succès";

        // on redirige vers la même page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // // on peut supprimer son personnage ou son compte......
    // $supprimer_personnage = supprimerPersonnage($id_personnage);
    // $supprimer_compte = supprimerMembre($id_membre);


    //----------------------On affiche le profil-------------------------------------
    $titre = "Origin - Profil de $pseudo";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/profil.php";
    include RACINE . "/vue/footer.php";
} else {
    //----------------------Sinon on renvoie sur l'inscription-----------------------
    $titre = "Origin - Inscription";
    include RACINE . "/vue/header.php";
    include RACINE . "/vue/inscription.php";
    include RACINE . "/vue/footer.php";
}
