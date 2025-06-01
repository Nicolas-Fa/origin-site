<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>
<main class="container">
    <?php if (!$a_postule) : ?>
        <h1 class="titre">Nous rejoindre</h1>
        <section>
            <form action="./?action=postuler" method="POST" id="formulaire_postulation">
                <fieldset class="fieldset_profil">
                    <legend>
                        <h2>Présentez vous, votre expérience, vos classes...</h2>
                    </legend>
                    <div class="champ_formulaire_postulation">
                        <label for="postulation"></label>
                        <textarea name="contenu_postulation" id="postulation" maxlength="900" rows="16" cols="50" required></textarea>
                        <div class="compteur_caracteres" id="compteur"></div>
                    </div>
                    <div class="champ_logs_postulation">
                        <label for="page_de_logs">Votre page warcraftlogs</label>
                        <input type="url" id="page_de_logs" name="page_de_logs" required>
                    </div>
                    <button type="submit" class="bouton" aria-label="Envoyer la postulation">Envoyer</button>
                </fieldset>
            </form>
        </section>
    <?php else : ?>
        <h1>Votre candidature est en cours de traitement</h1>
        <section>
            <p class="message">
                <?php if (isset($_SESSION["message"])) {
                    //on affiche le message de validation d'envoi de la postulation
                    echo $_SESSION["message"];
                    // on le supprime de la session pour ne pas le réafficher à chaque fois
                    unset($_SESSION["message"]);
                } ?>
            </p>
        </section>
    <?php endif; ?>
</main>