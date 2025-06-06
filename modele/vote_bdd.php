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

/* Nom de la fonction : recupererVoteParIdPostulationEtParIdMembre
*
* A quoi sert cette fonction : récupérer les votes sur une postulation par un membre donné
*
* Paramètres de la fonction ($id_postulation, $id_membre)
*   $id_postulation : la postulation concernée par le vote
*   $id_membre : le membre titulaire du (possible) vote
*
* Retour : Le vote du membre pour une postulation donnée ; le vote peut être inexistant
*/
function recupererVotesParIdPostulation($id_postulation)
{
    try {
        $connexion = connexionBdd();
        $requete = $connexion->prepare("SELECT * FROM `vote` WHERE id_postulation=:id_postulation");
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

/* Nom de la fonction : recupererVoteParIdPostulationEtParIdMembre
*
* A quoi sert cette fonction : récupérer les votes sur une postulation par un membre donné
*
* Paramètres de la fonction ($id_postulation)
*   $id_postulation : la postulation concernée par le vote
*   $id_membre : le membre titulaire du (possible) vote
*
* Retour : Le vote du membre pour une postulation donnée ; le vote peut être inexistant
*/

function recupererVoteParIdPostulationEtParIdMembre($id_postulation, $id_membre)
{
    try {
        $connexion = connexionBdd();
        $requete = $connexion->prepare("SELECT * 
            FROM `vote` 
            WHERE id_postulation=:id_postulation AND id_membre=:id_membre");
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->execute();

        return $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}