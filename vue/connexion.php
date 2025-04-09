<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>
<main>
    <h1 class="page_introuvable">CONNEXION</h1>
    <form action="./?action=connexion" method="POST">
        <p><input type="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']): '' ?>" placeholder="Votre Email" required aria-label="Renseignez votre email ici"></p>
        <p><input type="password" name="mot_de_passe" placeholder="Mot de passe" required aria-label="Renseignez votre mot de passe ici"></p>
        <p><button type="submit">Se connecter</button></p>
    </form>
</main>