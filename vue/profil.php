<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>

<main class="container">

    <h1 class="titre">Profil de <?= ucfirst($pseudo) ?></h1>
    <section id="mes_personnages">
        <section class="liste_personnages">
            <h2>Mes personnages</h2>
            <ul>
                <?php for ($i = 0; $i < count($pseudo_personnage); $i++): ?>
                    <?php $id = $id_personnage[$i]["id_personnage"]; ?>
                    <li>
                        <p><?= htmlspecialchars_decode(ucfirst($pseudo_personnage[$i]["pseudo_personnage"])), " - ", htmlspecialchars_decode(ucfirst($royaume_personnage[$i]["royaume"])); ?></p>
                        <!-- Formulaires de modification -->
                        <!-- Bouton edition -->
                        <section class="boutons_edition">
                            <button class="visualiser_personnage bouton" data-pseudo="<?= htmlspecialchars_decode(lcfirst($pseudo_personnage[$i]["pseudo_personnage"])); ?>" data-royaume="<?= htmlspecialchars_decode(lcfirst($royaume_personnage[$i]["royaume"])); ?>" data-id="<?= $id ?>" aria-label="Voir le personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]) ?>">Voir le personnage</button>

                            <!-- Bouton edition du pseudo personnage -->
                            <button class="editer bouton" data-id="<?= $id; ?>" data-type="pseudo" aria-label="Editer le pseudo du personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]) ?>">Éditer le pseudo</button>

                            <!-- Bouton edition du royaume -->
                            <button class="editer bouton" data-id="<?= $id; ?>" data-type="royaume" aria-label="Editer le royaume du personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]) ?>">Éditer le royaume</button>

                            <!-- Formulaire d'edition du personnage, caché par défaut -->
                            <form action="./?action=profil" method="POST" id="editer_pseudo_<?= $id ?>" class="formulaire_edition cache">
                                <input type="hidden" name="id_personnage" value="<?= $id; ?>">
                                <input type="text" name="nouveau_pseudo_perso" placeholder="Nouveau pseudo" aria-label="Nouveau pseudo de votre personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]) ?>">
                                <button class="bouton" type="submit" name="valider_edition" aria-label="Bouton de validation : Nouveau pseudo de votre personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]) ?>">Valider</button>
                            </form>

                            <!-- Formulaire d'edition du royaume, caché par défaut -->
                            <form action="./?action=profil" method="POST" id="editer_royaume_<?= $id ?>" class="formulaire_edition cache">
                                <input type="hidden" name="id_personnage" value="<?= $id; ?>">
                                <input type="text" name="nouveau_royaume" placeholder="Nouveau royaume" aria-label="Nouveau royaume de votre personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]) ?>">
                                <button class="bouton" type="submit" name="valider_edition" aria-label="Bouton de validation : Nouveau royaume de votre personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]) ?>">Valider</button>
                            </form>

                            <!-- partie suppression de personnage -->
                            <form action="./?action=profil" method="POST">
                                <input type="hidden" name="id_personnage_a_supprimer" value="<?= $id; ?>">
                                <button class="bouton supprimer" type="submit" name="supprimer_personnage" aria-label="Bouton de suppression pour le personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]), " ", ucfirst($royaume_personnage[$i]["royaume"]); ?>"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </section>
                    </li>
                <?php endfor; ?>
                <p class="message">
                    <?php if (isset($_SESSION["message"])) {
                        echo ($_SESSION["message"]); // on affiche le message de suppression du personnage
                        unset($_SESSION["message"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                    }
                    ?>
                </p>
            </ul>
        </section>
    </section>
    <div class="visualisation_personnage" id="visualisation_personnage">
        <h3 class="nom_personnage"></h3>
        <p class="race_personnage"></p>
        <p class="classe_personnage"></p>
        <img class="image_personnage" alt="">
        <p class="erreur_personnage"></p>
    </div>
    <section id="ajout_personnage">
        <form action="./?action=profil" method="post">
            <fieldset class="fieldset_profil">
                <legend>
                    <h2>Ajouter un nouveau personnage</h2>
                </legend>
                <label for="pseudo">Pseudo</label>
                <input type="text" name="creation_pseudo" placeholder="Pseudo" required>
                <label for="royaume">Royaume</label>
                <input type="text" name="creation_royaume" placeholder="Royaume" required>
                <button class="bouton" type="submit" aria-label="Créer un nouveau personnage">Créer</button>
                <button class="bouton" type="reset" aria-label="Réinitialiser les champs">Reinitialiser</button>
                <p>
                    <?php if (isset($_SESSION["message"])) {
                        echo $_SESSION["message"]; // on affiche le message
                        unset($_SESSION["message"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                    }
                    ?>
                </p>
            </fieldset>
        </form>
    </section>
    <!-- Modification du profil -->

    <!-- Modification du pseudo -->
    <h2>Editer mon profil</h2>
    <section id="reglages_compte">
        <section class="edition_pseudo_compte">
            <button class="editer bouton" data-id="<?= $id_membre; ?>" data-type="pseudo_compte" aria-label="Editer votre pseudo">Éditer votre pseudo</button>
            <form action="./?action=profil" method="POST" id="editer_pseudo_compte_<?= $id_membre ?>" class="formulaire_edition cache">
                <input type="hidden" name="id_compte" value="<?= $id_membre; ?>">
                <label for="nouveau_pseudo_compte">Nouveau pseudo</label>
                <input type="text" name="nouveau_pseudo_compte" placeholder="Nouveau pseudo" aria-label="Nouveau pseudo">
                <button class="bouton" type="submit" name="valider_edition" aria-label="Valider le nouveau pseudo">Valider</button>
            </form>
            <p>
                <?php if (isset($_SESSION["message_modification_pseudo_compte"])) {
                    echo ($_SESSION["message_modification_pseudo_compte"]); // on affiche le message de modification du pseudo du compte
                    unset($_SESSION["message_modification_pseudo_compte"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                }
                ?>
            </p>
        </section>
        <!-- Modification du mot de passe -->
        <section class="edition_mot_de_passe">
            <button class="editer bouton" data-id="<?= $id_membre; ?>" data-type="changer_mdp" aria-label="Changer le mot de passe de votre compte">Changer le mot de passe</button>
            <form action="./?action=profil" method="POST" id="editer_changer_mdp_<?= $id_membre ?>" class="formulaire_edition cache">
                <input type="hidden" name="id_compte" value="<?= $id_membre; ?>">
                <label for="nouveau_mot_de_passe">Nouveau mot de passe</label>
                <input type="password" name="nouveau_mot_de_passe" placeholder="Nouveau mot de passe" aria-label="Votre nouveau mot de passe">
                <button class="bouton" type="submit" name="valider_edition" aria-label="Valider le nouveau mot de passe">Valider</button>
            </form>
            <p>
                <?php if (isset($_SESSION["message_modification_mdp"])) {
                    echo ($_SESSION["message_modification_mdp"]); // on affiche le message de modification du pseudo du compte
                    unset($_SESSION["message_modification_mdp"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                }
                ?>
            </p>
        </section>
        <?php if ($_SESSION["role"] !== "Admin") : ?>
            <!-- Suppression du profil -->
            <section class="supprimer_profil">
                <form action="./?action=profil" method="post">
                    <input type="hidden" name="suppression_compte" value="<?= $id_membre; ?>">
                    <button class="bouton supprimer" type="submit" aria-label="Supprimer profil"><i class="fa-solid fa-trash"></i></button>
                </form>
            </section>
        <?php endif; ?>
    </section>
</main>