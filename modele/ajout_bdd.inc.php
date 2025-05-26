<?php 

include_once(RACINE . "/modele/bdd.inc.php");

//-----------------------------Commentaires------------------------------------------

/* Nom de la fonction : ajouterCommentaire
*
* A quoi sert cette fonction : ajouter un commentaire
*
* Paramètres de la fonction ($contenu, $id_membre, $id_postulation)
*   $contenu : le contenu du commentaire
*   $id_membre : l'id du membre ayant écrit le commentaire
*   $id_postulation : l'id de la postulation concernée par le commentaire
*
* Retour : l'ajout du commentaire sur la postulation
*/

function ajouterCommentaires($contenu, $id_membre, $id_postulation)
{
    try {
        $connexion = connexionBdd();
        
        // on vérifie que le commentaire ne soit pas vide
        $contenu = htmlspecialchars(trim($contenu), ENT_QUOTES, 'UTF-8');
        if ($contenu === '') {
            throw new Exception("Le commentaire ne peut pas être vide.");
        }

        // on enregistre le commentaire dans la base de données
        $requete = $connexion->prepare("INSERT INTO `commentaire`(contenu, id_membre, id_postulation) VALUES (:contenu, :id_membre, :id_postulation)");
        $requete->bindValue(":contenu", ucfirst($contenu), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);
        
        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur lors de l'ajout du commentaire : " . $erreur->getMessage());
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
        // on vérifie que l'email soit bien renseigné
        $email = trim($email);
        if ($email === '') {
            throw new Exception("L'email ne peut pas être vide.");
        }
        // on vérifie que le pseudo soit bien renseigné
        $pseudo = htmlspecialchars(trim($pseudo));
        if ($pseudo === '') {
            throw new Exception("Le pseudo ne peut pas être vide.");
        }
        // on vérifie que le mot de passe fasse au moins 8 caractères
        if(strlen($pwd) < 8){
            throw new Exception(("Le mot de passe doit contenir au moins 8 caractères"));
        }

        // On vérifie que l'email ne soit pas déjà enregistré
        $check_email = $connexion->prepare("SELECT COUNT(*) FROM `membre` WHERE email=:email");
        $check_email->bindValue(":email", $email, PDO::PARAM_STR);
        $check_email->execute();

        if($check_email->fetchColumn() > 0){
            throw new Exception("Cet email est déjà utilisé");
        }

        // On vérifie que le pseudo ne soit pas déjà enregistré
        $check_pseudo = $connexion->prepare("SELECT COUNT(*) FROM `membre` WHERE pseudo=:pseudo");
        $check_pseudo->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $check_pseudo->execute();

        if($check_pseudo->fetchColumn() > 0){
            throw new Exception("Ce pseudo est déjà utilisé");
        }

        $role = "Membre"; // rôle par défaut
        // on sécurise le mot de passe
        $pwd_crypte = password_hash(trim($pwd), PASSWORD_DEFAULT);
        // on enregistre le nouveau membre dans la BDD
        $requete = $connexion->prepare("INSERT INTO `membre` (pseudo, email, mot_de_passe, role) VALUES (:pseudo, :email, :mot_de_passe, :role)");
        $requete->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $requete->bindValue(":email", $email, PDO::PARAM_STR);
        $requete->bindValue(":mot_de_passe", $pwd_crypte, PDO::PARAM_STR);
        $requete->bindValue(":role", $role, PDO::PARAM_STR);

        $resultat = $requete->execute();
    } catch (PDOException $erreur) { // on capture et on gère les erreurs de base de données
        throw new Exception("Erreur: " . $erreur->getMessage());
    } catch (Exception $msg){ // on capture et on gère les autres erreurs (email, mdr)
        throw new Exception("Erreur : " . $msg->getMessage());
    }
    return $resultat;
}


//-----------------------------Enregistrer un personnage-----------------------------

/* Nom de la fonction : ajouterPersonnage
*
* A quoi sert cette fonction : ajoute un personnage
*
* Paramètres de la fonction ($pseudoperso, $royaume, $idmembre)
*	$pseudo_perso : le pseudonyme du personnage
*	$royaume : le royaume du personnage
*   $id_membre : l'id du membre qui souhaite enregistrer le personnage
*
* Retour : l'ajout du personnage et du royaume 
*/
function ajouterPersonnage($pseudo_perso, $royaume, $id_membre)
{
    try {
        $connexion = connexionBdd();

        $pseudo_perso = htmlspecialchars(trim($pseudo_perso));
        if ($pseudo_perso === '') {
            throw new Exception("Le pseudo de votre personnage ne peut pas être vide.");
        }

        $royaume = htmlspecialchars(trim($royaume));
        if ($royaume === '') {
            throw new Exception("Le royaume de votre personnage ne peut pas être vide.");
        }
        
        $requete = $connexion->prepare("INSERT INTO `personnage` (pseudo_personnage, royaume, id_membre) VALUES (:pseudo_personnage, :royaume, :id_membre)");
        $requete->bindValue(':pseudo_personnage', strtolower($pseudo_perso), PDO::PARAM_STR);
        $requete->bindValue(':royaume', strtolower(str_replace(" ", "-", ($royaume))), PDO::PARAM_STR);
        $requete->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);

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
* Paramètres de la fonction ($contenu, $id_membre, $id_postulation)
*   $contenu : le contenu du commentaire
*   $id_membre : l'id du membre ayant écrit le commentaire
*   $id_postulation : l'id de la postulation concernée par le commentaire
*
* Retour : l'ajout du commentaire sur la postulation
*/

function ajouterPostulation($contenu, $id_membre)
{
    try {
        $connexion = connexionBdd();

        $contenu = htmlspecialchars(trim($contenu));
        if ($contenu === '') {
            throw new Exception("La postulation ne peut pas être vide.");
        }

        $statut = "En cours";
        $requete = $connexion->prepare("INSERT INTO `postulation`(contenu, id_membre, statut) VALUES (:contenu, :id_membre, :statut)");
        $requete->bindValue(":contenu", ucfirst($contenu), PDO::PARAM_STR);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
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
* Paramètres de la fonction ($choix, $id_membre, $id_postulation)
*   $choix : le choix du vote
*   $id_membre : l'id du membre ayant voté
*   $id_postulation : l'id de la postulation concernée par le vote
*
* Retour : l'ajout d'un vote sur la postulation
*/

function ajouterVote($choix, $id_membre, $id_postulation)
{
    try {
        $connexion = connexionBdd();

        $requete = $connexion->prepare("INSERT INTO `vote`(choix, id_membre, id_postulation) VALUES (:choix, :id_membre, :id_postulation)");
        $requete->bindValue(":choix", $choix, PDO::PARAM_BOOL);
        $requete->bindValue(":id_membre", $id_membre, PDO::PARAM_INT);
        $requete->bindValue(":id_postulation", $id_postulation, PDO::PARAM_INT);
        
        $resultat = $requete->execute();
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
    return $resultat;
}
