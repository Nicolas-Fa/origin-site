<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>
<main class="container">
    <?php if (isset($message)): echo $message;
    endif; ?>
    <h1>Candidatures</h1>
    <section id="liste_candidats">
        <!-- on affiche les candidatures -->

        <?php foreach ($postulation as $onePost) : ?>
            <h3>Candidature de <?= $onePost["pseudo"]; ?></h3>
            <h4>Postée le <?= date("d-m-Y H:i:s", strtotime($onePost["date_de_soumission"])); ?></h4>
            <p><?= ucfirst($onePost["contenu"]); ?></p>
            <p>Statut : <?= $onePost["statut"]; ?></p>
        <?php endforeach ?>



        <?php for ($i = 0; $i < count($postulation); $i++) : ?>
            <?php $id_postulation_actuelle = $postulation[$i]["id_postulation"]; ?>
            <h3>Candidature de <?= $postulants[$i]["pseudo"]; ?></h3>
            <h4>Postée le <?= $date_de_soumission[$i]; ?></h4>
            <p><?= ucfirst($postulation[$i]["contenu"]); ?></p>
            <p>Statut : <?= $statut_postulation[$i]["statut"]; ?></p>
            <!-- si on est connecté et que le role est suffisant, on peut commenter la postulation -->
            <?php if (isset($_SESSION["email"]) && ($role == ucfirst("titan")) || ($role == ucfirst("moderateur"))) : ?>
                <form action="./?action=candidatures" method="post" id="commentaire_postulation_<?= $id_postulation_actuelle; ?>">
                    <textarea name="contenu_commentaire" id="commenter_postulation_<?= $id_postulation_actuelle; ?>" maxlength="250" rows="6" cols="50" required></textarea>
                    <button type="submit" class="bouton" aria-label="Envoyer le commentaire">Envoyer</button>
                    <p class="message">
                        <?php if (isset($_SESSION["message_postulation_envoyee"])) {
                            //on affiche le message de validation d'envoi de la postulation
                            echo $_SESSION["message_postulation_envoyee"];
                            // on le supprime de la session pour ne pas le réafficher à chaque fois
                            unset($_SESSION["message_postulation_envoyee"]);
                        } ?>
                    </p>

                </form><br><br>
            <?php endif; ?>
            <div class="partie_commentaires">
                <?php foreach ($commentaires as $commentaire): if ($commentaire["id_postulation"] == $id_postulation_actuelle): ?>
                        <h5><?= $commentaire["pseudo"], " - ",
                            $commentaire["date_commentaire"]; ?></h5>
                        <p><?= ucfirst($commentaire["contenu"]); ?></p>
                <?php endif;
                endforeach; ?>
            </div>


        <?php endfor; ?>
    </section>
</main>