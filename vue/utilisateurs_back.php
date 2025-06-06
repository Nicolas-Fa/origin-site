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
    <p class="message">
        <?php if (isset($_SESSION["message"])) {
            echo ($_SESSION["message"]);
            unset($_SESSION["message"]);
        } ?>
    </p>
    <section id="utilisateurs">
        <?php foreach ($utilisateurs as $utilisateur) : if ($utilisateur["pseudo"] !== $_SESSION["pseudo"]) : ?>
                <section class="utilisateur">
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
                    if ($_SESSION["role"] == "Admin" && $utilisateur["role"] !== "Moderateur") : ?>
                        <form action="./?action=gestion_utilisateurs" method="POST">
                            <input type="hidden" name="pseudo_membre" value="<?= $utilisateur["pseudo"] ?>">
                            <button class="bouton" type="submit" name="moderateur" aria-label="Passer le membre au grade de modérateur">Modérateur</button>
                        </form>
                    <?php endif; ?>
                    <form action="./?action=gestion_utilisateurs" method="POST">
                        <input type="hidden" name="supprimer_membre" value="<?= $utilisateur["id_membre"] ?>">
                        <button class="bouton supprimer" type="submit" name="supprimer" aria-label="Supprimer le membre"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </section>
        <?php endif;
        endforeach; ?>
    </section>
</main>