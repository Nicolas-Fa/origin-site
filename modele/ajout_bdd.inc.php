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

        $requete = $connexion->prepare("INSERT INTO `commentaire`(contenu, id_membre, id_postulation) VALUES (:contenu, :id_membre, :id_postulation)");
        $requete->bindValue(":contenu", ucfirst($contenu), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $idpostulation, PDO::PARAM_INT);
        
        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


//-----------------------------Creation de membre------------------------------------

/* Nom de la fonction : sInscrire
*
* A quoi sert cette fonction : enregistre un nouvel utilisateur dans la Base de données
*
* Paramètres de la fonction ($pseudo, $email, $pwd)
*	$pseudo : le pseudonyme de l'utilisateur
*	$email : l'adresse mail de l'utilisateur
*   $pwd : le mot de passe de l'utilisateur
*
* Retour : l'ajout de l'utilisateur associé à son mail
*/
function sInscrire($pseudo, $email, $pwd)
{
    try {
        $connexion = connexionBdd();

        $role = "Membre";
        $pwdCrypte = password_hash($pwd, PASSWORD_DEFAULT);
        $requete = $connexion->prepare("INSERT INTO `membre` (pseudo, email, mot_de_passe, role) VALUES (:pseudo, :email, :mot_de_passe, :role");
        $requete->bindValue(':pseudo', ucfirst($pseudo), PDO::PARAM_STR);
        $requete->bindValue(':email', $email, PDO::PARAM_STR);
        $requete->bindValue(':mot_de_passe', $pwdCrypte, PDO::PARAM_STR);
        $requete->bindValue(':role', ucfirst($role), PDO::PARAM_STR);

        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


//-----------------------------Enregistrer un personnage-----------------------------

/* Nom de la fonction : ajouterPersonnage
*
* A quoi sert cette fonction : ajoute un personnage
*
* Paramètres de la fonction ($pseudoperso, $royaume, $idmembre)
*	$pseudoperso : le pseudonyme du personnage
*	$roayume : le royaume du personnage
*   $idmembre : l'id du membre qui souhaite enregistrer le personnage
*
* Retour : l'ajout du personnage et du royaume 
*/
function ajouterPersonnage($pseudoperso, $royaume, $idmembre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("INSERT INTO `personnage` (pseudo_personnage, royaume, id_membre) VALUES (:pseudo_personnage, :royaume, :id_membre");
        $requete->bindValue(':pseudo_personnage', ucfirst($pseudoperso), PDO::PARAM_STR);
        $requete->bindValue(':royaume', str_replace(" ", "-", $royaume), PDO::PARAM_STR);
        $requete->bindValue(':id_membre', $idmembre, PDO::PARAM_INT);

        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


//-----------------------------Postulations------------------------------------------

/* Nom de la fonction : ajouterPostulation
*
* A quoi sert cette fonction : ajouter une postulation
*
* Paramètres de la fonction ($contenu, $idmembre, $idpostulation)
*   $contenu : le contenu du commentaire
*   $idmembre : l'id du membre ayant écrit le commentaire
*   $idpostulation : l'id de la postulation concernée par le commentaire
*
* Retour : l'ajout du commentaire sur la postulation
*/

function ajouterPostulation($contenu, $idmembre, $idpostulation)
{
    try {
        $connexion = connexionBdd();

        $statut = "En cours";
        $requete = $connexion->prepare("INSERT INTO `postulation`(contenu, id_membre, id_postulation, statut) VALUES (:contenu, :id_membre, :id_postulation, :statut)");
        $requete->bindValue(":contenu", ucfirst($contenu), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $idpostulation, PDO::PARAM_INT);
        $requete->bindValue(":statut", ucfirst($statut), PDO::PARAM_STR);
        
        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


//------------------------------------Vote-------------------------------------------

/* Nom de la fonction : ajouterVote
*
* A quoi sert cette fonction : ajouter un vote sur une postulation
*
* Paramètres de la fonction ($choix, $idmembre, $idpostulation)
*   $choix : le choix du vote
*   $idmembre : l'id du membre ayant voté
*   $idpostulation : l'id de la postulation concernée par le vote
*
* Retour : l'ajout d'un vote sur la postulation
*/

function ajouterVote($choix, $idmembre, $idpostulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("INSERT INTO `vote`(choix, id_membre, id_postulation) VALUES (:choix, :id_membre, :id_postulation)");
        $requete->bindValue(":choix", $choix, PDO::PARAM_BOOL);
        $requete->bindValue(":id_membre", $idmembre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $idpostulation, PDO::PARAM_INT);
        
        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}
