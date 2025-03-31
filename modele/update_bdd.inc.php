<?php

include_once(RACINE . "/modele/bdd.inc.php");

//-----------------------------Edition Commentaires----------------------------------

/* Nom de la fonction : editerCommentaire
*
* A quoi sert cette fonction : permet d'éditer un commentaire
*
* Paramètres de la fonction ($contenu)
*   $contenu : le contenu du commentaire
*
* Retour : la modification commentaire sur la postulation
*/

function editerCommentaire($contenu, $idcommentaire)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `commentaire` SET contenu=:contenu WHERE id_commentaire=:id_commentaire");
        $requete->bindValue(":contenu", ucfirst($contenu), PDO::PARAM_STR);
        $requete->bindValue(":id_commentaire", $idcommentaire, PDO::PARAM_INT);
        
        if ($requete->execute()) {
            return "Commentaire modifié avec succès.";
        } else {
            return "Erreur lors de la modification du commentaire.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

//---------------------------------------PROFIL------------------------------------------------------

//------------------------------Edition pseudo---------------------------------------

/* Nom de la fonction : editerPseudoMembre
*
* A quoi sert cette fonction : permet d'éditer le pseudo d'un membre
*
* Paramètres de la fonction ($pseudo, $idmembre)
*   $pseudo : le pseudo du membre
*   $idmembre : l'id du membre
*
* Retour : la modification de son pseudo
*/

function editerPseudoMembre($pseudo, $idmembre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `membre` SET pseudo=:pseudo WHERE id_membre=:id_membre");
        $requete->bindValue(":pseudo", ucfirst($pseudo), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        
        if ($requete->execute()) {
            return "Pseudo modifié avec succès.";
        } else {
            return "Erreur lors de la modification du pseudo.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//------------------------------Edition mot de passe---------------------------------

/* Nom de la fonction : editerMdpMembre
*
* A quoi sert cette fonction : permet d'éditer le mot de passe d'un membre
*
* Paramètres de la fonction ($pwd, $idmembre)
*   $pseudo : le mot de passe du membre
*   $idmembre : l'id du membre
*
* Retour : la modification du mot de passe du membre
*/

function editerMdpMembre($pwd, $idmembre)
{
    try {
        $connexion = connexionBdd();

        $pwdCrypte = password_hash($pwd, PASSWORD_DEFAULT);
        $requete = $connexion->prepare("UPDATE `membre` SET mot_de_passe=:mot_de_passe WHERE id_membre=:id_membre" );
        $requete->bindValue(":mot_de_passe", $pwdCrypte, PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_STR);
        
        if ($requete->execute()) {
            return "Mot de passe modifié avec succès.";
        } else {
            return "Erreur lors de la modification du mot de passe.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//------------------------------Edition rôle-----------------------------------------

/* Nom de la fonction : editerRoleMembre
*
* A quoi sert cette fonction : permet d'éditer le rôle d'un membre
*
* Paramètres de la fonction ($role, $idmembre)
*   $role : le role du membre
*   $idmembre : l'id du membre
*
* Retour : la modification du rôle d'un membre
*/

function editerRoleMembre($role, $idmembre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `membre` SET role=:role WHERE id_membre=:id_membre");
        $requete->bindValue(":role", ucfirst($role), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        
        if ($requete->execute()) {
            return "Rôle du membre modifié avec succès.";
        } else {
            return "Erreur lors de la modification du rôle.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

//---------------------------------------PERSONNAGE--------------------------------------------------

//------------------------------Edition royaume personnage-------------------------

/* Nom de la fonction : editerRoyaumePersonnage
*
* A quoi sert cette fonction : permet d'éditer le pseudo de son personnage
*
* Paramètres de la fonction ($royaume, $idmembre, $idpersonnage)
*   $royaume : le royaume du personnage
*   $idmembre : l'id du membre
*   $idpersonnage : l'id du personnage
*
* Retour : la modification du royaume du personnage
*/

function editerRoyaumePersonnage($royaume, $idmembre, $idpersonnage)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `personnage` SET royaume=:royaume WHERE id_membre=:id_membre AND id_personnage=:id_personnage");
        $requete->bindValue(":royaume", trim(str_replace(" ", "-", $royaume)), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_personnage", $idpersonnage, PDO::PARAM_INT);
        
        if ($requete->execute()) {
            return "Royaume du personnage modifié avec succès.";
        } else {
            return "Erreur lors de la modification du royaume.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//------------------------------Edition pseudo personnage-------------------------

/* Nom de la fonction : editerPseudoPersonnage
*
* A quoi sert cette fonction : permet d'éditer le pseudo de son personnage
*
* Paramètres de la fonction ($pseudo, $idmembre, $idpersonnage)
*   $pseudo : le pseudo du personnage
*   $idmembre : l'id du membre
*   $idpersonnage : l'id du personnage
*
* Retour : la modification du pseudo du personnage
*/

function editerPseudoPersonnage($pseudo, $idmembre, $idpersonnage)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `personnage` SET pseudo_personnage=:pseudo_personnage WHERE id_membre=:id_membre AND id_personnage=:id_personnage");
        $requete->bindValue(":pseudo_personnage", ucfirst($pseudo), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_personnage", $idpersonnage, PDO::PARAM_INT);
        
        if ($requete->execute()) {
            return "Pseudo de votre personnage modifié avec succès.";
        } else {
            return "Erreur lors de la modification du pseudo de votre personnage.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

//---------------------------------------POSTULATION-------------------------------------------------

//------------------------------Edition postulation-------------------------------

/* Nom de la fonction : editerPostulation
*
* A quoi sert cette fonction : permet d'éditer une postulation
*
* Paramètres de la fonction ($contenu, $idmembre, $idpostulation)
*   $contenu : le contenu de la postulation
*   $idmembre : l'id du membre
*   $idpostulation : l'id de la postulation
*
* Retour : la modification de la postulation du membre
*/

function editerPostulation($contenu, $idmembre, $idpostulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `postulation` SET contenu=:contenu WHERE id_membre=:id_membre AND id_postulation=:id_postulation");
        $requete->bindValue(":contenu", ucfirst($contenu), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $idpostulation, PDO::PARAM_INT);
        
        if ($requete->execute()) {
            return "Postulation modifiée avec succès.";
        } else {
            return "Erreur lors de la modification de la postulation.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//------------------------Edition du statut de la postulation---------------------

/* Nom de la fonction : editerStatutPostulation
*
* A quoi sert cette fonction : permet d'éditer le statut d'une postulation
*
* Paramètres de la fonction ($statut, $idmembre, $idpostulation)
*   $statut : le statut de la postulation
*   $idmembre : l'id du membre
*   $idpostulation : l'id de la postulation
*
* Retour : la modification du statut de la postulation
*/

function editerStatutPostulation($statut, $idmembre, $idpostulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `postulation` SET statut=:statut WHERE id_membre=:id_membre AND id_postulation=:id_postulation");
        $requete->bindValue(":statut", ucfirst($statut), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $idpostulation, PDO::PARAM_INT);
        
        if ($requete->execute()) {
            return "Statut de la postulation modifié avec succès.";
        } else {
            return "Erreur lors de la modification du statut de la postulation.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//----------------------------------------VOTE-------------------------------------------------------

//------------------------------Edition du vote-----------------------------------

/* Nom de la fonction : modifierVote
*
* A quoi sert cette fonction : permet de modifier son vote
*
* Paramètres de la fonction ($choix, $idvote, $idmembre, $idpostulation)
*   $choix : le choix du vote, pour ou contre
*   $id_vote : l'id du vote à modifier
*   $idmembre : l'id du membre
*   $idpostulation : l'id de la postulation
*
* Retour : la modification d'un vote
*/

function modifierVote($choix, $idvote, $idmembre, $idpostulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `vote` SET choix=:choix WHERE id_vote=:id_vote AND id_membre=:id_membre AND id_postulation=:id_postulation");
        $requete->bindValue(":choix", $choix, PDO::PARAM_BOOL);
        $requete->bindValue(":id_vote", $idvote, PDO::PARAM_INT);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $idpostulation, PDO::PARAM_INT);
        
        if ($requete->execute()) {
            return "Vote modifié avec succès.";
        } else {
            return "Erreur lors de la modification du vote.";
        }
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}
