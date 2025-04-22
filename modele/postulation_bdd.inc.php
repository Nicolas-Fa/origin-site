<?php

include_once(RACINE . "/modele/bdd.inc.php");

/* Nom de la fonction : recupererPostulation
*
* A quoi sert cette fonction : récupérer une postulation
*
* Paramètres de la fonction ()
*
* Retour : un tableau associatif avec toutes les informations sur toues les postualtions
*/

function recupererPostulation()
{
    $resultat=array();
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `postulation`");
        $requete->execute();

        return ($requete->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }

}

// ------------------ By Thierry B. -------------------
// Récupère toutes les postulations avec le statut 'En cours' ansi que le pseudo du membre postulant
function recupererPostulationsEnCours()
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare(
            "SELECT `id_postulation`, `contenu`, 
                DATE_FORMAT(date_de_soumission, '%d/%m/%Y à %Hh%imin') AS `date_formatee`, 
                `statut`, pseudo
            FROM `postulation`
            JOIN `membre` USING(id_membre)
            WHERE statut = 'En cours'
            ORDER BY id_postulation");
        $requete->execute();

        return ($requete->fetchAll(PDO::FETCH_ASSOC));

    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}
// ----------------------------------------------------

/* Nom de la fonction : recupererContenuParIdMembre
*
* A quoi sert cette fonction : récupère le contenu de la postulation en fonction de l'id du membre
*
* Paramètres de la fonction ($id_membre)
*	$id_membre : l'id du membre
*
* Retour : le contenu de la postulation du membre
*/

function recupererContenuParIdMembre($id_membre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `contenu` FROM `postulation` WHERE id_membre=:id_membre");
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererStatutPostuParIdPostu
*
* A quoi sert cette fonction : récupère le statut de la postulation en fonction de l'id de celle-ci
*
* Paramètres de la fonction ($id_postulation)
*	$id_postulation : l'id de la postulation
*
* Retour : le statut de la postulation
*/

function recupererStatutPostuParIdPostu($id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `statut` FROM `postulation` WHERE id_postulation=:id_postulation");
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererDatePostuParIdPostu
*
* A quoi sert cette fonction : récupère la date de la postulation en fonction de l'id de celle-ci
*
* Paramètres de la fonction ($id_postulation)
*	$id_postulation : l'id de la postulation
*
* Retour : la date a laquelle a été postée la postulation
*/

function recupererDatePostuParIdPostu($id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `date_de_soumission` FROM `postulation` WHERE id_postulation=:id_postulation");
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}

// ------------------------------test--------------------------------------------
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    header('Content-Type:text/plain');

    echo "recupererPostulation() : \n";
    echo "<pre>";
    print_r(recupererPostulation());
    echo "</pre>";

    echo "recupererContenuParIdMembre() : \n";
    print_r(recupererContenuParIdMembre("1"));

    echo "recupererStatutPostuParIdPostu() : \n";
    print_r(recupererStatutPostuParIdPostu("1"));
}
