<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>
<main class="container">
    <section id="connexion">
        <h1>CONNEXION</h1>
        <form action="?action=connexion" method="POST">
            <p><input type="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" placeholder="Votre Email" required aria-label="Renseignez votre email ici"></p>
            <p><input type="password" name="mot_de_passe" placeholder="Mot de passe" required aria-label="Renseignez votre mot de passe ici"></p>
            <button type="submit" class="bouton" aria-label="Se connecter">Se connecter</button>
            <p class="inscription">Vous n'avez pas de compte?</p>
            <a href="?action=inscription" aria-label="S'inscrire" class="inscription">S'inscrire</a>
        </form>
    </section>

</main>