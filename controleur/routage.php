<?php

// routage du site, les actions sont récupérées par la Superglobale $_GET
/* Nom de la fonction : navigation
*
* A quoi sert cette fonction : permet de naviguer entre les pages
*
* Paramètres de la fonction ($action)
*	$action = la page sur laquelle on est
*
* Retour : la navigation sur la page souhaitée
*/

function navigation($action = "defaut")
{
    $choix_action = array();
    $choix_action["defaut"] = "accueil_ctr.php";
    $choix_action["accueil"] = "accueil_ctr.php";
    $choix_action["profil"] = "profil_ctr.php";
    $choix_action["postuler"] = "postuler_ctr.php";
    $choix_action["candidatures"] = "candidatures_ctr.php";
    $choix_action["connexion"] = "connexion_ctr.php";
    $choix_action["inscription"] = "inscription_ctr.php";
    $choix_action["deconnexion"] = "deconnexion_ctr.php";
    $choix_action["page404"] = "404_ctr.php";

    $fichier_ctrl = $choix_action[$action];

    //si le fichier n'existe pas :
    if (! file_exists(__DIR__ . '/' . $fichier_ctrl)) die("Le fichier : " . $fichier_ctrl . " n'existe pas !");

    //si la clé "action" existe dans notre tableau "choix_action" :
    if (array_key_exists($action, $choix_action)) {
        // le fichier à inclure sera retourné :
        return $fichier_ctrl;
    } else {
        // sinon, erreur 404
        return $choix_action["page404"];
    }
}
