<main class="container">
    <p class="message">
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
            <div class="candidature">
                <h3>Candidature de <?= ucfirst($postulation["pseudo"]); ?></h3>
                <h4>Postée le <?= $postulation["date_formatee"]; ?></h4>
                <p><?= ucfirst($postulation["contenu"]); ?></p>
                <p class="statut">Statut : <?= $postulation["statut"]; ?></p>

                <button class="commenter bouton" data-id="<?= $postulation["id_postulation"]; ?>" aria-label="Bouton pour commenter la postulation">Commenter la postulation de <?= ucfirst($postulation["pseudo"]) ?></button>
                <form action="./?action=candidatures" method="post" class="formulaire_commentaire cache" id="commenter_postulation_<?= $postulation["id_postulation"] ?>">
                    <input name="commentaire_postulation" type="hidden" value="<?= $postulation['id_postulation']; ?>" />
                    <textarea name="contenu_commentaire" maxlength="250" rows="6" cols="50" required></textarea>
                    <button type="submit" class="bouton" aria-label="Envoyer le commentaire" aria-labelledby="Bouton pour envoyer le commentaire">Envoyer</button>
                </form>
                <p class="message">
                    <?php if (isset($_SESSION["message_postulation_envoyee"])) {
                        //on affiche le message de validation d'envoi de la postulation
                        echo $_SESSION["message_postulation_envoyee"];
                        // on le supprime de la session pour ne pas le réafficher à chaque fois
                        unset($_SESSION["message_postulation_envoyee"]);
                    } ?>
                </p>

                <div class="votes">
                    <?php
                    $vote_pour = 0;
                    $vote_contre = 0;
                    foreach ($agregat_votes[$index] as $vote) {
                        if ($vote["choix"]): $vote_pour++;
                        else : $vote_contre++;
                        endif;
                    }
                    ?>
                    <form action="./?action=candidatures" method="post" class="voter">
                        <button type="submit" class="voter_pour" data-id="<?= $postulation["id_postulation"]; ?>" aria-label="Pouce vers le haut : voter pour"><i class="fa-regular fa-thumbs-up"></i></button>
                        <input type="hidden" name="voter_pour" value="<?= $postulation["id_postulation"]; ?>">
                        <?= $vote_pour ?>
                    </form>
                    <form action="./?action=candidatures" method="post" class="voter">
                        <button type="submit" class="voter_contre" data-id="<?= $postulation["id_postulation"]; ?>" aria-label="Pouce vers le bas : voter contre"><i class="fa-regular fa-thumbs-down"></i></button>
                        <?= $vote_contre ?>
                        <input type="hidden" name="voter_contre" value="<?= $postulation["id_postulation"]; ?>">
                    </form>
                </div>
                <p class="message">
                    <?php if (isset($_SESSION["message_vote"])) {
                        echo ($_SESSION["message_vote"]);
                        unset($_SESSION["message_vote"]);
                    }
                    ?></p>
                <div class="commentaires">
                    <h3>Commentaires :</h3>
                    <?php
                    foreach ($agregat_commentaires[$index] as $commentaire) : ?>
                    <div class="un_commentaire">
                        <h4><?= ucfirst($commentaire["pseudo"]); ?> :</h4>
                        <p><?= ucfirst($commentaire["contenu"]); ?></p>
                        <?php if ($commentaire["pseudo"] == $_SESSION["pseudo"]) : ?>
                            <button class="editer bouton" data-id="<?= $commentaire['id_commentaire'] ?>" aria-label="Bouton pour modifier votre commentaire">Modifier votre commentaire</button>
                            <form action="./?action=candidatures" method="post" class="modifier_formulaire cache" id="editer_commentaire_<?= $commentaire['id_commentaire'] ?>">
                                <input name="editer_commentaire" type="hidden" value="<?= $commentaire['id_commentaire']; ?>" />
                                <textarea name="contenu_edition" maxlength="250" rows="6" cols="50" required><?= $commentaire["contenu"]; ?></textarea>
                                <button type="submit" class="bouton" aria-label="Envoyer le commentaire">Envoyer</button>
                            </form>

                    <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php
            $index++;
        endforeach;
        ?>
    </section>
</main>