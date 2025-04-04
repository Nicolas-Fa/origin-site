<?php

include_once(RACINE . "/modele/bdd.inc.php");


/* Nom de la fonction : recupererIdVoteParIdPostulation
*
* A quoi sert cette fonction : récupérer l'id d'un vote sur une postulation en fonction de l'id de celle-ci
*
* Paramètres de la fonction ($id_postulation)
*   $id_postulation : la postulation concernée par le vote
*
* Retour : L'id des votes pour une postulation donnée
*/

function recupererIdVoteParIdPostulation($id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT id_vote FROM `vote` WHERE id_postulation=:id_postulation");
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);

        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererVoteParIdPostulation
*
* A quoi sert cette fonction : récupérer les votes sur une postulation en fonction de l'id de celle-ci
*
* Paramètres de la fonction ($choix, $id_postulation)
*   $choix : le choix du vote, pour ou contre
*   $id_postulation : la postulation concernée par le vote
*
* Retour : L'ensemble des votes pour une postulation donnée correspondant à un choix
*/

function recupererVoteParIdPostulation($choix, $id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `vote` WHERE choix=:choix AND id_postulation=:id_postulation");
        $requete->bindValue(":choix", $choix, PDO::PARAM_BOOL);
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);

        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


// ------------------------------test--------------------------------------------
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    header('Content-Type:text/plain');

    echo "recupererVoteParIdPostulation() : \n";
    print_r(recupererVoteParIdPostulation("1", "1"));
}
