<?php

include_once(RACINE . "/modele/bdd.inc.php");


/* Nom de la fonction : sInscrire
*
* A quoi sert cette fonction enregistre un nouvel utilisateur dans la Base de données
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
        $requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $requete->bindValue(':email', $email, PDO::PARAM_STR);
        $requete->bindValue(':mot_de_passe', $pwdCrypte, PDO::PARAM_STR);
        $requete->bindValue(':role', $role, PDO::PARAM_STR);

        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        die("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}


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

        $requete = $connexion->prepare("SELECT * FROM `membre` WHERE `email=:email`");
        $requete->bindValue(":email", $email, PDO::PARAM_STR);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        die("Erreur: " . $erreur->getMessage());
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

        $requete = $connexion->prepare("SELECT * FROM `membre` WHERE `pseudo=:pseudo`");
        $requete->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        die("Erreur: " . $erreur->getMessage());
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

function recupererRoleMembre($role)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("SELECT * FROM `membre` WHERE `role=:role`");
        $requete->bindValue(":role", $role, PDO::PARAM_STR);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erreur) {
        die("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}

// ------------------------------test--------------------------------------------
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    header('Content-Type:text/plain');

    echo "recupererMailMembre() : \n";
    print_r(recupererMailMembre("origin@test.com"));

    echo "recupererPseudoMembre() : \n";
    print_r(recupererPseudoMembre("test"));

    echo "recupererRoleMembre() : \n";
    print_r(recupererRoleMembre("Membre"));
}
