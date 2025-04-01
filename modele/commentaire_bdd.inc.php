<?php

include_once(RACINE . "/modele/bdd.inc.php");


/* Nom de la fonction : recupererCommentaires
*
* A quoi sert cette fonction : récupérer les commentaires
*
* Paramètres de la fonction ()
*
* Retour : un tableau associatif avec toutes les informations sur tous les commentaires
*/

function recupererCommentaires()
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `commentaire`");
        $requete->execute();

        $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererCommentaireParIdPostulation
*
* A quoi sert cette fonction : récupère le contenu du commentaire en fonction de l'id de la postulation
*
* Paramètres de la fonction ($id_postulation)
*	$id_postulation : l'id de la postulation
*
* Retour : le contenu du commentaire de la postulation
*/

function recupererCommentaireParIdPostulation($id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `contenu` FROM `commentaire` WHERE id_postulation=:id_postulation");
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererDateCommentaireParIdPostulation
*
* A quoi sert cette fonction : récupère la date du commentaire en fonction de l'id de la postulation
*
* Paramètres de la fonction ($id_postulation)
*	$id_postulation : l'id de la postulation
*
* Retour : la date du commentaire de la postulation
*/

function recupererDateCommentaireParIdPostulation($id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `date_commentaire` FROM `commentaire` WHERE id_postulation=:id_postulation");
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

    echo "recupererCommentaires() : \n";
    echo "<pre>";
    print_r(recupererCommentaires(""));
    echo "</pre>";

    echo "recupererCommentaireParIdPostulation() : \n";
    print_r(recupererPseudoMembre("1"));

    echo "recupererDateCommentaireParIdPostulation() : \n";
    print_r(recupererDateCommentaireParIdPostulation("1"));
}
