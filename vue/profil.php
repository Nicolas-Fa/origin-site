<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>

<main class="container">

    <h1 class="titre">Profil de <?= $pseudo ?></h1>
    <section id="mes_personnages">
        <div class="liste_personnages">
            <h2>Mes personnages</h2>
            <ul>
                <?php for ($i = 0; $i < count($pseudo_personnage); $i++): ?>
                    <?php $id = $id_personnage[$i]["id_personnage"]; ?>
                    <li>
                        <p><?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]), " - ", ucfirst($royaume_personnage[$i]["royaume"]); ?></p>
                        <!------------------------------Formulaires de modification---------------------------------->
                        <!-- Bouton edition -->
                        <div class="boutons_edition">
                            <button class="visualiser_personnage bouton" data-pseudo="<?= lcfirst($pseudo_personnage[$i]["pseudo_personnage"]); ?>" data-royaume="<?= lcfirst($royaume_personnage[$i]["royaume"]); ?>" data-id="<?= $id ?>" aria-label="Voir le personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]) ?>">Voir le personnage</button>
                            
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
                            <form action="./?action=profil" method="POST" onsubmit="return confirm('Confirmer la suppression? (cette action est irréversible)')">
                                <input type="hidden" name="id_personnage_a_supprimer" value="<?= $id; ?>">
                                <button class="bouton" type="submit" name="supprimer_personnage" aria-label="Bouton de suppression pour le personnage <?= ucfirst($pseudo_personnage[$i]["pseudo_personnage"]), " ", ucfirst($royaume_personnage[$i]["royaume"]); ?>">Supprimer</button>
                            </form>
                        </div>
                    </li>
                <?php endfor; ?>
                <p class="message">
                    <?php if (isset($_SESSION["message_suppression"])) {
                        echo ($_SESSION["message_suppression"]); // on affiche le message de suppression du personnage
                        unset($_SESSION["message_suppression"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                    } elseif (isset($_SESSION["message_modification"])) {
                        echo ($_SESSION["message_modification"]); // on affiche le message de modification de pseudo/royaume personnage
                        unset($_SESSION["message_modification"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                    }
                    ?></p>
            </ul>
        </div>
        <div class="visualisation_personnage" id="visualisation_personnage">
            <h3 class="nom_personnage"></h3>
            <p class="race_personnage"></p>
            <p class="classe_personnage"></p>
            <img src="" alt="Aperçu du personnage" class="image_personnage">
            <p class="erreur_personnage"></p>
        </div>
    </section>
    <section id="ajout_personnage">
        <form action="./?action=profil" method="post">
            <fieldset class="fieldset_profil">
                <legend>
                    <h2>Ajouter un nouveau personnage</h2>
                </legend>
                <label for="pseudo">Pseudo</label>
                <p><input type="text" name="creation_pseudo" placeholder="Pseudo" required></p>
                <label for="royaume">Royaume</label>
                <p><input type="text" name="creation_royaume" placeholder="Royaume" required></p>
                <button class="bouton" type="submit" aria-label="Créer un nouveau personnage">Créer</button>
                <button class="bouton" type="reset" aria-label="Réinitialiser les champs">Reinitialiser</button>
                <p><?php if (isset($_SESSION["message"])) {
                        echo $_SESSION["message"]; // on affiche le message
                        unset($_SESSION["message"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                    }
                    ?></p>
            </fieldset>
        </form>
    </section>
    <!----------------------------------------Modification du profil--------------------------------------------->

    <!----------------------------------------Modification du pseudo--------------------------------------------->
    <section id="reglages_compte">
        <div class="edition_pseudo_compte">
            <button class="editer bouton" data-id="<?= $id_membre; ?>" data-type="pseudo_compte" aria-label="Editer votre pseudo">Éditer votre pseudo</button>
            <form action="./?action=profil" method="POST" id="editer_pseudo_compte_<?= $id_membre ?>" class="formulaire_edition cache" onsubmit="return confirm('Voulez vous vraiment modifier votre pseudo? (Vous pourrez toujours le changer après.)')">
                <input type="hidden" name="id_compte" value="<?= $id_membre; ?>">
                <label for="nouveau_pseudo_compte">Nouveau pseudo</label>
                <input type="text" name="nouveau_pseudo_compte" placeholder="Nouveau pseudo" aria-label="Nouveau pseudo">
                <button class="bouton" type="submit" name="valider_edition" aria-label="Valider le nouveau pseudo">Valider</button>
            </form>
            <p><?php if (isset($_SESSION["message_modification_pseudo_compte"])) {
                    echo ($_SESSION["message_modification_pseudo_compte"]); // on affiche le message de modification du pseudo du compte
                    unset($_SESSION["message_modification_pseudo_compte"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                }
                ?></p>
        </div>
        <!--------------------------------------Modification du mot de passe------------------------------------->
        <div class="edition_mot_de_passe">
            <button class="editer bouton" data-id="<?= $id_membre; ?>" data-type="changer_mdp" aria-label="Changer le mot de passe de votre compte">Changer le mot de passe</button>
            <form action="./?action=profil" method="POST" id="editer_changer_mdp_<?= $id_membre ?>" class="formulaire_edition cache" onsubmit="return confirm('Voulez vous vraiment modifier votre mot de passe?')">
                <input type="hidden" name="id_compte" value="<?= $id_membre; ?>">
                <label for="nouveau_mot_de_passe">Nouveau mot de passe</label>
                <input type="password" name="nouveau_mot_de_passe" placeholder="Nouveau mot de passe" aria-label="Votre nouveau mot de passe">
                <button class="bouton" type="submit" name="valider_edition" aria-label="Valider le nouveau mot de passe">Valider</button>
            </form>
            <p><?php if (isset($_SESSION["message_modification_mdp"])) {
                    echo ($_SESSION["message_modification_mdp"]); // on affiche le message de modification du pseudo du compte
                    unset($_SESSION["message_modification_mdp"]); // on le supprime de la session pour ne pas le réafficher à chaque fois
                }
                ?></p>
        </div>

        <!--------------------------------------Suppression du profil-------------------------------------------->
        <div class="supprimer_profil">
            <form action="./?action=profil" method="post" onsubmit="return confirm('Voulez vous vraiment supprimer votre compte? (cette action est irréversible)')">
                <input type="hidden" name="suppression_compte" value="<?= $id_membre; ?>">
                <button class="bouton" type="submit">Je veux supprimer mon compte</button>
            </form>
        </div>
    </section>
</main>