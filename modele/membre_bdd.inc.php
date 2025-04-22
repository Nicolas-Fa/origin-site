<?php

include_once(RACINE . "/modele/bdd.inc.php");


/* Nom de la fonction : recupererMembres
*
* A quoi sert cette fonction : récuperer tous les membres
*
* Paramètres de la fonction ()
*
* Retour : un tableau associatif avec l'ensemble des membres inscrits
*/

function recupererMembres()
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `membre`");
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }

}


/* Nom de la fonction : recupererMailMembre
*
* A quoi sert cette fonction : récupère le membre en fonction de son mail
*
* Paramètres de la fonction ($email)
*	$email : l'email du membre
*
* Retour : le membre associé à l'email renseigné
*/

function recupererMailMembre($email)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `membre` WHERE email=:email");
        $requete->bindValue(":email", $email, PDO::PARAM_STR);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction : recupererIdMembreParMail
*
* A quoi sert cette fonction : récupère l'id du membre en fonction de son mail
*
* Paramètres de la fonction ($email)
*	$email : l'email du membre
*
* Retour : l'id membre associé à l'email renseigné
*/

function recupererIdMembreParMail($email)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `id_membre` FROM `membre` WHERE email=:email");
        $requete->bindValue(":email", $email, PDO::PARAM_STR);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction recupererPseudoMembre()
*
* A quoi sert cette fonction : récupère le membre en fonction de son pseudo
*
* Paramètres de la fonction ($pseudo)
*	$pseudo : le pseudo renseigné par le membre
*
* Retour : le membre associé au pseudo renseigné
*/

function recupererPseudoMembre($pseudo)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `pseudo` FROM `membre` WHERE pseudo=:pseudo");
        $requete->bindValue(":pseudo", ucfirst($pseudo), PDO::PARAM_STR);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction recupererPseudoMembreParIdMembre($id_membre)
*
* A quoi sert cette fonction : récupère le pseudo du membre en fonction de son id
*
* Paramètres de la fonction ($id_membre)
*	$id_membre : l'id du membre
*
* Retour : le pseudo du membre associé à son id
*/

function recupererPseudoMembreParIdMembre($id_membre)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `pseudo` FROM `membre` WHERE id_membre=:id_membre");
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction recupererRoleMembre()
*
* A quoi sert cette fonction : récupère les membres selon leur rôle
*
* Paramètres de la fonction ($role)
*	$role : le role du membre
*
* Retour : les membres ayant le rôle choisi
*/

function recupererRoleMembre($role)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `role`, `pseudo`, `id_membre` FROM `membre` WHERE role=:role");
        $requete->bindValue(":role", ucfirst($role), PDO::PARAM_STR);
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

/* Nom de la fonction recupererPseudoMembreParMail()
*
* A quoi sert cette fonction : récupère le membre en fonction de son email
*
* Paramètres de la fonction ($email)
*	$email : l'email du membre
*
* Retour : le pseudo du membre associé a l'email 
*/

function recupererPseudoMembreParMail($email)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `pseudo` FROM `membre` WHERE email=:email");
        $requete->bindValue(":email", ucfirst($email), PDO::PARAM_STR);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


/* Nom de la fonction recupererRoleMembreParMail()
*
* A quoi sert cette fonction : récupère le rôle du membre en fonction de son email
*
* Paramètres de la fonction ($email)
*	$email : l'email du membre
*
* Retour : le role du membre associé à l'email
*/

function recupererRoleMembreParMail($email)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT `role` FROM `membre` WHERE email=:email");
        $requete->bindValue(":email", $email, PDO::PARAM_STR);
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

    echo "recupererMailMembre() : \n";
    echo "<pre>";
    print_r(recupererMailMembre("origin@test.com"));
    echo "</pre>";

    echo "recupererPseudoMembre() : \n";
    print_r(recupererPseudoMembre("test"));

    echo "recupererRoleMembre() : \n";
    print_r(recupererRoleMembre("Membre"));
}
