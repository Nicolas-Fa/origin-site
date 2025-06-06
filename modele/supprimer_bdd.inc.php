<?php

include_once(RACINE . "/modele/bdd.inc.php");

//---------------------------Suppression du commentaire---------------------------

/* Nom de la fonction : supprimerCommentaire
*
* A quoi sert cette fonction : permet de supprimer un commentaire
*
* Paramètres de la fonction ($id_commentaire)
*   $id_commentaire : l'id du commentaire
*
* Retour : la suppression d'un commentaire
*/
function supprimerCommentaire($id_commentaire)
{
    try {
        $connexion = connexionBdd();
        $requete = $connexion->prepare("DELETE FROM `commentaire` WHERE id_commentaire=:id_commentaire");
        $requete->bindValue(":id_commentaire", $id_commentaire, PDO::PARAM_INT);
        $requete->execute();
        $lignessupprimees = $requete->rowCount();
        if ($lignessupprimees > 0) {
            $message = "Commentaire supprimé avec succès.";
        } else {
            $message = "Erreur lors de la suppression du commentaire.";
        }
        return $message;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

//---------------------------Suppression du compte membre-------------------------

/* Nom de la fonction : supprimerMembre
*
* A quoi sert cette fonction : permet de supprimer un membre
*
* Paramètres de la fonction ($id_membre)
*   $id_membre : l'id du membre
*
* Retour : la suppression d'un membre
*/
function supprimerMembre($id_membre)
{
    try {
        $connexion = connexionBdd();
        $requete = $connexion->prepare("DELETE FROM `membre` WHERE id_membre=:id_membre");
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->execute();
        $lignessupprimees = $requete->rowCount();
        if ($lignessupprimees > 0) {
            $message = "Compte supprimé avec succès.";
        } else {
            $message = "Erreur lors de la suppression du compte.";
        }
        return $message;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

//---------------------------Suppression du personnage----------------------------

/* Nom de la fonction : supprimerPersonnage
*
* A quoi sert cette fonction : permet de supprimer un personnage
*
* Paramètres de la fonction ($id_personnage)
*   $id_personnage : l'id du personnage
*
* Retour : la suppression du personnage choisi
*/
function supprimerPersonnage($id_personnage)
{
    try {
        $connexion = connexionBdd();
        $requete = $connexion->prepare("DELETE FROM `personnage` WHERE id_personnage=:id_personnage");
        $requete->bindValue(":id_personnage", $id_personnage, PDO::PARAM_INT);
        $requete->execute();
        $lignessupprimees = $requete->rowCount();
        if ($lignessupprimees > 0) {
            $message = "Personnage supprimé avec succès.";
        } else {
            $message = "Erreur lors de la suppression du personnage.";
        }
        return $message;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

//---------------------------Suppression de la postulation------------------------

/* Nom de la fonction : supprimerPostulation
*
* A quoi sert cette fonction : permet de supprimer une postulation
*
* Paramètres de la fonction ($id_postulation)
*   $id_postulation : l'id de la postulation
*
* Retour : la suppression de la postulation
*/
function supprimerPostulation($id_postulation)
{
    try {
        $connexion = connexionBdd();
        $requete = $connexion->prepare("DELETE FROM `postulation` WHERE id_postulation=:id_postulation");
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);
        $requete->execute();
        $lignessupprimees = $requete->rowCount();
        if ($lignessupprimees > 0) {
            $message = "Postulation supprimée avec succès.";
        } else {
            $message = "Erreur lors de la suppression de la postulation.";
        }
        return $message;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

//---------------------------Suppression du vote----------------------------------

/* Nom de la fonction : supprimerVote
*
* A quoi sert cette fonction : permet de supprimer un vote
*
* Paramètres de la fonction ($id_vote)
*   $id_postulation : l'id du vote
*
* Retour : la suppression du vote
*/
function supprimerVote($id_vote)
{
    try {
        $connexion = connexionBdd();
        $requete = $connexion->prepare("DELETE FROM `vote` WHERE id_vote=:id_vote");
        $requete->bindValue(":id_vote", $id_vote, PDO::PARAM_INT);
        $requete->execute();
        $lignessupprimees = $requete->rowCount();
        if ($lignessupprimees > 0) {
            $message = "Vote supprimée avec succès.";
        } else {
            $message = "Erreur lors de la suppression du vote.";
        }
        return $message;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}