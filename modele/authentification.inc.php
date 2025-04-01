<?php 

include_once( RACINE . "/modele/membre_bdd.inc.php");


/* Nom de la fonction : seConnecter
*
* A quoi sert cette fonction : permet à un utilisateur enregistré de se connecter
*
* Paramètres de la fonction ($mail, $pwd)
*	$mail = l'email renseigné par l'utilisateur
*   $pwd = le mot de passe renseigné par l'utilisateur
*
* Retour : 
*/

function seConnecter ($email, $pwd){
    if (!isset($_SESSION)){
        session_start();
    }
    $membre = recupererMailMembre($email);
    $pwd_bdd = $membre["mot_de_passe"];

    if(trim($pwd_bdd)== trim(password_hash($pwd, $pwd_bdd))){
        $_SESSION["email"] = $email;
        $_SESSION["mot_de_passe"] = $pwd_bdd;
    }
}


/* Nom de la fonction : seDeconnecter
*
* A quoi sert cette fonction : permet à l'utilisateur de se déconnecter
*
* Paramètres de la fonction ()
*
* Retour : une déconnexion du membre, fin de session
*/

function seDeconnecter(){
    if(!isset($_SESSION)){
        session_start();
    }
    unset($_SESSION["email"]);
    unset($_SESSION["mot_de_passe"]);
}


/* Nom de la fonction estConnecte
*
* A quoi sert cette fonction : 
*
* Paramètres de la fonction (a,b)
*	a : quelque chose
*	b : quelque chose d'autre
*
* Retour : ce que la fonction est sencé nous afficher
*/

function estConnecte() {
    if (!isset($_SESSION)) {
        session_start();
    }
    $retourne = false;

    if (isset($_SESSION["email"])) {
        $membre = recupererMailMembre($_SESSION["email"]);
        if ($membre["email"] == $_SESSION["email"] && $membre["email"] == $_SESSION["email"]
        ) {
            $retourne = true;
        }
    }
    return $retourne;
}

// ------------------------------test--------------------------------------------
if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {

    header('Content-Type:text/plain');

    // test de connexion
    seConnecter("origin@test.com", "1234nf");
    if (estConnecte()) {
        echo "Connecté";
    } else {
        echo "Pas connecté";
    }

    // deconnexion
    seDeconnecter();
}