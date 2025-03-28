<?php

include_once(RACINE . "/modele/bdd.inc.php");

/* Nom de la fonction : recupererPostulation
*
* A quoi sert cette fonction : récupérer une postulation
*
* Paramètres de la fonction ()
*
* Retour : un tableau associatif avec toutes les informations sur une postualtion
*/

function recupererPostulation()
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `postulation`");
        $requete->execute();

        $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $erreur) {
        die("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}

/* Nom de la fonction : recupererContenuParIdMembre
*
* A quoi sert cette fonction : récupère le contenu de la postulation en fonction de l'id du membre
*
* Paramètres de la fonction ($idMembre)
*	$idMembre : l'id du membre
*
* Retour : le contenu de la postulation du membre
*/

function recupererContenuParIdMembre($idMembre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `contenu` FROM `postulation` WHERE `id_membre=:id_membre`");
        $requete->bindValue(":id_membre", $idMembre, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        die("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererStatutPostuParIdPostu
*
* A quoi sert cette fonction : récupère le statut de la postulation en fonction de l'id de celle-ci
*
* Paramètres de la fonction ($idPostulation)
*	$idMembre : l'id de la postulation
*
* Retour : le statut de la postulation
*/

function recupererStatutPostuParIdPostu($idPostulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `statut` FROM `postulation` WHERE `id_postulation=:id_postulation`");
        $requete->bindValue(":id_postulation", $idPostulation, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        die("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}
