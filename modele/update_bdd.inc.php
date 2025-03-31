<?php

include_once(RACINE . "/modele/bdd.inc.php");

//-----------------------------Commentaires------------------------------------------

/* Nom de la fonction : editerCommentaire
*
* A quoi sert cette fonction : permet d'éditer un commentaire
*
* Paramètres de la fonction ($contenu)
*   $contenu : le contenu du commentaire
*
* Retour : l'ajout du commentaire sur la postulation
*/

function editerCommentaire($contenu)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("UPDATE `commentaire` SET contenu=':contenu' WHERE ");
        $requete->bindValue(":contenu", $contenu, PDO::PARAM_STR);
        
        $requete->execute();
        $confirmation = "Commentaire modifié";
        return $confirmation;
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}
