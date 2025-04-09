<?php

include_once(RACINE . "/modele/bdd.inc.php");


/* Nom de la fonction : recupererPersonnage
*
* A quoi sert cette fonction : récupérer les personnages
*
* Paramètres de la fonction ()
*
* Retour : un tableau associatif avec toutes les informations sur tous les personnages
*/

function recupererPersonnage()
{
    $resultat = array();
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `personnage`");
        $requete->execute();

        $ligne = $requete->fetchAll(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $requete->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererIdPersonnageParIdMembre
*
* A quoi sert cette fonction : récupérer l'id des personnages en fonction de l'id du membre
*
* Paramètres de la fonction ($id_membre)
*   $id_membre : l'id du membre
*
* Retour : l'id des personnages appartenant à l'ID renseignée
*/

function recupererIdPersonnageParIdMembre($id_membre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `id_personnage` FROM `personnage` WHERE id_membre=:id_membre ORDER BY `id_personnage`");
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererPseudoPersonnageParIdMembre
*
* A quoi sert cette fonction : récupérer le pseudo des personnages en fonction de l'id du membre
*
* Paramètres de la fonction ($id_membre)
*   $id_membre : l'id du membre
*
* Retour : le pseudo des personnages appartenant à l'ID renseignée
*/

function recupererPseudoPersonnageParIdMembre($id_membre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `pseudo_personnage` FROM `personnage` WHERE id_membre=:id_membre ORDER BY `pseudo_personnage` DESC");
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererRoyaumeParIdMembre
*
* A quoi sert cette fonction : récupérer le royaume d'un personnage donné, d'un membre donné
*
* Paramètres de la fonction ($id_membre, $pseudoperso)
*   $id_membre : l'id du membre
*   $pseudoperso : le pseudo du personnage
*
* Retour : le royaume d'un personnage
*/

function recupererRoyaumeParIdMembre($id_membre)
{
    $resultat = array();
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `royaume` FROM `personnage` WHERE id_membre=:id_membre");
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->execute();

        $resultat =$requete->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}

// ------------------------------test--------------------------------------------
// if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
//     header('Content-Type:text/plain');

//     echo "recupererPersonnage() : \n";
//     echo "<pre>";
//     print_r(recupererPersonnage());
//     echo "</pre>";

//     echo "recupererPseudoPersonnageParIdMembre() : \n";
//     print_r(recupererPseudoPersonnageParIdMembre("1"));

//     echo "recupererRoyaumeParIdMembre() : \n";
//     print_r(recupererRoyaumeParIdMembre("1", "Llorwina"));
// }
