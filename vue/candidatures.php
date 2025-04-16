<main class="container">
    <p class="message_commenter">
        <?php if (isset($_SESSION["message_commentaire"])) {
            echo ($_SESSION["message_commentaire"]);
            unset($_SESSION["message_commentaire"]);
        } ?></p>

    <h1>Candidatures</h1>
    <section id="liste_candidats">
        <!-- on affiche les candidatures -->
        <?php
        $index = 0;
        foreach ($postulations as $postulation) : ?>
            <h3>Candidature de <?= $postulation["pseudo"]; ?></h3>
            <h4>Postée le <?= $postulation["date_formatee"]; ?></h4>
            <p><?= ucfirst($postulation["contenu"]); ?></p>
            <p>Statut : <?= $postulation["statut"]; ?></p>

            <br>
            <button class="commenter bouton" data-id="<?= $postulation["id_postulation"]; ?>">Commenter la postulation de <?= $postulation["pseudo"] ?></button>
            <form action="./?action=candidatures" method="post" class="formulaire_commentaire cache" id="commenter_postulation_<?= $postulation["id_postulation"] ?>">
                <input name="commentaire_postulation" type="hidden" value="<?= $postulation['id_postulation']; ?>" />
                <textarea name="contenu_commentaire" maxlength="250" rows="6" cols="50" required></textarea>
                <button type="submit" class="bouton" aria-label="Envoyer le commentaire">Envoyer</button>
            </form>
            <p class="message">
                <?php if (isset($_SESSION["message_postulation_envoyee"])) {
                    //on affiche le message de validation d'envoi de la postulation
                    echo $_SESSION["message_postulation_envoyee"];
                    // on le supprime de la session pour ne pas le réafficher à chaque fois
                    unset($_SESSION["message_postulation_envoyee"]);
                } ?>
            </p>
            <br><br>
            <h3>Commentaires :</h3>
            <?php
            foreach ($agregat_commentaires[$index] as $commentaire) : ?>
                <h4>Posté le <?= $commentaire["date_formatee"]; ?> par <?= $commentaire["pseudo"]; ?></h4>
                <p><?= $commentaire["contenu"]; ?></p>
                <?php if ($commentaire["pseudo"] == $_SESSION["pseudo"]) : ?>
                    <button class="editer bouton" data-id="<?= $postulation["id_postulation"] ?>">Modifier votre commentaire</button>
                    <form action="./?action=candidatures" method="post" class="modifier_formulaire cache" id="editer_commentaire_<?= $postulation["id_postulation"] ?>">
                        <input name="editer_commentaire" type="hidden" value="<?= $postulation['id_postulation']; ?>" />
                        <textarea name="contenu_edition" maxlength="250" rows="6" cols="50" required><?= $commentaire["contenu"]; ?></textarea>
                        <button type="submit" class="bouton" aria-label="Envoyer le commentaire">Envoyer</button>
                    </form>

            <?php endif;
            endforeach; ?>
            <br>
        <?php
            $index++;
        endforeach;
        ?>

    </section>
</main>