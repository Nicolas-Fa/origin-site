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
    $choixAction = array();
    $choixAction["defaut"] = "accueil_ctr.php";
    $choixAction["accueil"] = "accueil_ctr.php";
    $choixAction["profil"] = "profil_ctr.php";
    $choixAction["postuler"] = "postuler_ctr.php";
    $choixAction["candidatures"] = "candidatures_ctr.php";
    $choixAction["connexion"] = "connexion_ctr.php";
    $choixAction["inscription"] = "inscription_ctr.php";
    $choixAction["deconnexion"] = "deconnexion_ctr.php";
    $choixAction["page404"] = "404_ctr.php";

    $fichier_ctrl = $choixAction[$action];

    //si le fichier n'existe pas :
    if (! file_exists(__DIR__ . '/' . $fichier_ctrl)) die("Le fichier : " . $fichier_ctrl . " n'existe pas !");

    //si la clé "action" existe dans notre tableau "choixAction" :
    if (array_key_exists($action, $choixAction)) {
        // le fichier à inclure sera retourné :
        return $fichier_ctrl;
    } else {
        // sinon, erreur 404
        return $choixAction["page404"];
    }
}
