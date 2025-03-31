<?php
/* Nom de la fonction : connexionBdd
*
* A quoi sert cette fonction : se connecter à une base de données en utlisant des variables stockées dans un fichier .env 
*
* Paramètres de la fonction ()
*
* Retour : la connexion établie à la base de données $pdo ou un message d'erreur s'il y a un problème
*/
function connexionBdd()
{
    try {
        require_once RACINE . "/vendor/autoload.php";
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
        $dotenv->load();
        $pdo = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_LOGIN'], $_ENV['DB_PWD']);
        return $pdo;
    } catch (PDOException $erreur) {
        throw new Exception("Erreur: " . $erreur->getMessage());
    }
}

if ( $_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__) ) {
    // prog de test
    header('Content-Type:text/plain');

    echo "connexionBdd() : \n";
    print_r(connexionBdd());
}
?>