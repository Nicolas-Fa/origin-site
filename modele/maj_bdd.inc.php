<?php

include_once(RACINE . "/modele/bdd.inc.php");

//-----------------------------Edition Commentaires----------------------------------

/* Nom de la fonction : editerCommentaire
*
* A quoi sert cette fonction : permet d'éditer un commentaire
*
* Paramètres de la fonction ($contenu, $id_commentaire)
*   $contenu : le contenu du commentaire
*   $id_commentaire : l'id du commentaire
*
* Retour : la modification commentaire sur la postulation
*/

function editerCommentaire($contenu, $id_commentaire)
{
    try {
        $connexion = connexionBdd();

        $contenu = htmlspecialchars(trim($contenu));
        if ($contenu === '') {
            throw new Exception("Le commentaire ne peut pas être vide.");
        }

        $requete = $connexion->prepare("UPDATE `commentaire` SET contenu=:contenu WHERE id_commentaire=:id_commentaire");
        $requete->bindValue(":contenu", ucfirst($contenu), PDO::PARAM_STR);
        $requete->bindValue(":id_commentaire", $id_commentaire, PDO::PARAM_INT);

        if ($requete->execute()) {
            $message =  "Commentaire modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification du commentaire.";
        }
        return $message;
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
* Paramètres de la fonction ($pseudo, $id_membre)
*   $pseudo : le pseudo du membre
*   $id_membre : l'id du membre
*
* Retour : la modification de son pseudo
*/

function editerPseudoMembre($pseudo, $id_membre)
{
    try {
        $connexion = connexionBdd();

        $pseudo = htmlspecialchars(trim($pseudo));
        if ($pseudo === '') {
            throw new Exception("Le pseudo ne peut pas être vide.");
        }

        $requete = $connexion->prepare("UPDATE `membre` SET pseudo=:pseudo WHERE id_membre=:id_membre");
        $requete->bindValue(":pseudo", ucfirst($pseudo), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);

        if ($requete->execute()) {
            $message = "Pseudo modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification du pseudo.";
        }
        return $message;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//------------------------------Edition mot de passe---------------------------------

/* Nom de la fonction : editerMdpMembre
*
* A quoi sert cette fonction : permet d'éditer le mot de passe d'un membre
*
* Paramètres de la fonction ($pwd, $id_membre)
*   $pseudo : le mot de passe du membre
*   $id_membre : l'id du membre
*
* Retour : la modification du mot de passe du membre
*/

function editerMdpMembre($pwd, $id_membre)
{
    try {
        $connexion = connexionBdd();

        $pwd_crypte = trim(password_hash($pwd, PASSWORD_DEFAULT));
        $requete = $connexion->prepare("UPDATE `membre` SET mot_de_passe=:mot_de_passe WHERE id_membre=:id_membre");
        $requete->bindValue(":mot_de_passe", $pwd_crypte, PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_STR);

        if ($requete->execute()) {
            $message = "Mot de passe modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification du mot de passe.";
        }
        return $message;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//------------------------------Edition rôle-----------------------------------------

/* Nom de la fonction : editerRoleMembre
*
* A quoi sert cette fonction : permet d'éditer le rôle d'un membre
*
* Paramètres de la fonction ($role, $id_membre)
*   $role : le role du membre
*   $id_membre : l'id du membre
*
* Retour : la modification du rôle d'un membre
*/

function editerRoleMembre($role, $id_membre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `membre` SET role=:role WHERE id_membre=:id_membre");
        $requete->bindValue(":role", ucfirst($role), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);

        if ($requete->execute()) {
            $message = "Rôle du membre modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification du rôle.";
        }
        return $message;
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
* Paramètres de la fonction ($royaume, $id_membre, $id_personnage)
*   $royaume : le royaume du personnage
*   $id_membre : l'id du membre
*   $id_personnage : l'id du personnage
*
* Retour : la modification du royaume du personnage
*/

function editerRoyaumePersonnage($royaume, $id_personnage)
{
    try {
        $connexion = connexionBdd();

        $royaume = htmlspecialchars(trim($royaume));
        if ($royaume === '') {
            throw new Exception("Le royaume de votre personnage ne peut pas être vide.");
        }

        $requete = $connexion->prepare("UPDATE `personnage` SET royaume=:royaume WHERE id_personnage=:id_personnage");
        $requete->bindValue(":royaume", trim(str_replace(" ", "-", strtolower($royaume))), PDO::PARAM_STR);
        $requete->bindValue(":id_personnage", $id_personnage, PDO::PARAM_INT);

        if ($requete->execute()) {
            $message = "Royaume du personnage modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification du royaume.";
        }
        return $message;

    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//------------------------------Edition pseudo personnage-------------------------

/* Nom de la fonction : editerPseudoPersonnage
*
* A quoi sert cette fonction : permet d'éditer le pseudo de son personnage
*
* Paramètres de la fonction ($pseudo, $id_membre, $id_personnage)
*   $pseudo : le pseudo du personnage
*   $id_membre : l'id du membre
*   $id_personnage : l'id du personnage
*
* Retour : la modification du pseudo du personnage
*/

function editerPseudoPersonnage($pseudo, $id_personnage)
{
    try {
        $connexion = connexionBdd();

        $pseudo = htmlspecialchars(trim($pseudo));
        if ($pseudo === '') {
            throw new Exception("Le pseudo de votre personnage ne peut pas être vide.");
        }

        $requete = $connexion->prepare("UPDATE `personnage` SET pseudo_personnage=:pseudo_personnage WHERE id_personnage=:id_personnage");
        $requete->bindValue(":pseudo_personnage", strtolower($pseudo), PDO::PARAM_STR);
        // $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->bindValue(":id_personnage", $id_personnage, PDO::PARAM_INT);

        if ($requete->execute()) {
            $message = "Pseudo de votre personnage modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification du pseudo de votre personnage.";
        }
        return $message;

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
* Paramètres de la fonction ($contenu, $id_membre, $id_postulation)
*   $contenu : le contenu de la postulation
*   $id_membre : l'id du membre
*   $id_postulation : l'id de la postulation
*
* Retour : la modification de la postulation du membre
*/

function editerPostulation($contenu, $id_membre, $id_postulation)
{
    try {
        $connexion = connexionBdd();

        $contenu = htmlspecialchars(trim($contenu));
        if ($contenu === '') {
            throw new Exception("Le contenu de la postulation ne peut pas être vide.");
        }

        $requete = $connexion->prepare("UPDATE `postulation` SET contenu=:contenu WHERE id_membre=:id_membre AND id_postulation=:id_postulation");
        $requete->bindValue(":contenu", ucfirst($contenu), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);

        if ($requete->execute()) {
            $message = "Postulation modifiée avec succès.";
        } else {
            $message = "Erreur lors de la modification de la postulation.";
        }
        return $message;

    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}


//------------------------Edition du statut de la postulation---------------------

/* Nom de la fonction : editerStatutPostulation
*
* A quoi sert cette fonction : permet d'éditer le statut d'une postulation
*
* Paramètres de la fonction ($statut, $id_membre, $id_postulation)
*   $statut : le statut de la postulation
*   $id_membre : l'id du membre
*   $id_postulation : l'id de la postulation
*
* Retour : la modification du statut de la postulation
*/

function editerStatutPostulation($statut, $id_membre, $id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `postulation` SET statut=:statut WHERE id_membre=:id_membre AND id_postulation=:id_postulation");
        $requete->bindValue(":statut", ucfirst($statut), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);

        if ($requete->execute()) {
            $message = "Statut de la postulation modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification du statut de la postulation.";
        }
        return $message;
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
* Paramètres de la fonction ($choix, $id_vote, $id_membre, $id_postulation)
*   $choix : le choix du vote, pour ou contre
*   $id_vote : l'id du vote à modifier
*   $id_membre : l'id du membre
*   $id_postulation : l'id de la postulation
*
* Retour : la modification d'un vote
*/

function modifierVote($choix, $id_vote, $id_membre, $id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `vote` SET choix=:choix WHERE id_vote=:id_vote AND id_membre=:id_membre AND id_postulation=:id_postulation");
        $requete->bindValue(":choix", $choix, PDO::PARAM_BOOL);
        $requete->bindValue(":id_vote", $id_vote, PDO::PARAM_INT);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);

        if ($requete->execute()) {
            $message = "Vote modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification du vote.";
        }
        return $message;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}
