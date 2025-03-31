<?php

include_once(RACINE . "/modele/bdd.inc.php");


/* Nom de la fonction : recupererVote
*
* A quoi sert cette fonction : récupérer les votes sur une postulation
*
* Paramètres de la fonction ($choix, $idpostulation)
*   $choix : le choix du vote, pour ou contre
*   $idpostulation : la postulation concernée par le vote
*
* Retour : un tableau associatif avec toutes les informations sur tous les personnages
*/

function recupererVote($choix, $idpostulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `vote` WHERE choix=:choix AND id_postulation=:id_postulation");
        $requete->bindValue(":choix", $choix, PDO::PARAM_BOOL);
        $requete->bindValue(":id_postulation", $idpostulation, PDO::PARAM_INT);

        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


// ------------------------------test--------------------------------------------
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    header('Content-Type:text/plain');

    echo "recupererVote() : \n";
    print_r(recupererVote("1", "1"));
}
