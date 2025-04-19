<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>

<main class="container back">

    <h1 class="titre">Liste des utilisateurs</h1>
                <p class="message"><?php if (isset($_SESSION["message_modification"])) {
                        echo ($_SESSION["message_modification"]);
                        unset($_SESSION["message_modification"]);
                    } ?></p>
    <section id="utilisateurs">
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <div class="utilisateur">
                <p><?= ucfirst($utilisateur["pseudo"]) ?></p> 
                <p>Role : <?= $utilisateur["role"]; ?></p>
                <?php if ($utilisateur["role"] !== "Membre") : ?>
                    <form action="./?action=gestion_utilisateurs" method="POST">
                        <input type="hidden" name="pseudo_membre" value="<?= $utilisateur["pseudo"] ?>">
                        <button class="bouton" type="submit" name="membre" aria-label="Passer le membre au grade de titan">Membre</button>
                    </form>
                <?php endif;
                if ($utilisateur["role"] !== "Titan") : ?>
                    <form action="./?action=gestion_utilisateurs" method="POST">
                        <input type="hidden" name="pseudo_membre" value="<?= $utilisateur["pseudo"] ?>">
                        <button class="bouton" type="submit" name="titan" aria-label="Passer le membre au grade de titan">Titan</button>
                    </form>
                <?php endif;
                if ($utilisateur["role"] !== "Moderateur") : ?>
                    <form action="./?action=gestion_utilisateurs" method="POST">
                        <input type="hidden" name="pseudo_membre" value="<?= $utilisateur["pseudo"] ?>">
                        <button class="bouton" type="submit" name="moderateur" aria-label="Passer le membre au grade de modérateur">Modérateur</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </section>
</main>