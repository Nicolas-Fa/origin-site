<?php 

include_once(RACINE . "/modele/bdd.inc.php");

//-----------------------------Commentaires------------------------------------------

/* Nom de la fonction : ajouterCommentaire
*
* A quoi sert cette fonction : ajouter un commentaire
*
* Paramètres de la fonction ($contenu, $idmembre, $idpostulation)
*   $contenu : le contenu du commentaire
*   $idmembre : l'id du membre ayant écrit le commentaire
*   $idpostulation : l'id de la postulation concernée par le commentaire
*
* Retour : l'ajout du commentaire sur la postulation
*/

function ajouterCommentaires($contenu, $idmembre, $idpostulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("INSERT INTO `commentaire`(contenu, id_membre, id_postulation) VALUES (':contenu', :id_membre, :id_postulation)");
        $requete->bindValue(":contenu", $contenu, PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $idpostulation, PDO::PARAM_INT);
        
        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}
