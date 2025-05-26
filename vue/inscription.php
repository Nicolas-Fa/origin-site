<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>
<main class="container">
    <section id="inscription">
        <?php if (isset($message)) echo $message; ?>
        <h1>INSCRIPTION</h1>
        <form action="./?action=inscription" method="POST">
            <input type="text" name="pseudo" value="<?= isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : '' ?>" placeholder="Votre Pseudo" required>
            <input type="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" placeholder="Votre Email" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <p>En m'inscrivant je m'engage à respecter les <a href="./?action=regles">règles de la communauté</a></p>
            <button type="submit" class="bouton" aria-label="S'inscrire">S'inscrire</button>
        </form>
    </section>
</main>