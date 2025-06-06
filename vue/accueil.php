<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>

<main class="container accueil">

    <p>
        <?php //si un membre a supprimé son compte
        if (isset($_SESSION["message_suppression_compte"])) {
            echo $_SESSION["message_suppression_compte"]; // on affiche le message de suppression de compte
            seDeconnecter(); // on déconnecte le membre qui a supprimé son compte
            header("Location: index.php?action=accueil");
            exit;
        }
        ?>
    </p>

    <!-- Progression des boss -->
    <div id="communication">
        <section class="progression">
<<<<<<< HEAD
            <h1 class="titre">Progression de la guilde Origin</h1>
=======
            <h1>Progression de la guilde Origin</h1>
>>>>>>> 340cd16746a54d114a0aa8a8ed9e9d38412750c1
            <figure>
                <?php foreach ($images_boss as $images): ?>
                    <img src="public/images/<?= $images ?>" alt="Origin <?= substr($images, 0, 6) ?>">
                <?php endforeach; ?>
            </figure>
            <section>
                <h2>Qui sommes-nous ?</h2>
                <section>
                    <h3>Origin est une guilde du serveur Sargeras-EU, Horde/Alliance.</h3>
                    <p>Notre objectif principal est le PvE HL, dans une ambiance détendue mais concentrée afin d'obtenir les meilleurs résultats. Le PvE HL consiste à tomber tous les boss Mythiques avant la sortie du nouveau raid. Pour cela, nous demandons une certaine rigueur en raid et en dehors afin de mieux les appréhender.
                    </p>
                </section>
                <section>
                    <h3>Ce que nous pouvons vous apporter</h3>
                    <p> Une structure fiable et compétitive en 3 soirs par semaine avec des personnes déterminées, qui optimisent leur personnage, se renseignent sur leur classe et s'entraident de façon à obtenir une bonne ambiance avec les résultats qui vont avec.
                    </p>
                </section>
                <section>
                    <h3>Mais que recherchons-nous ?</h3>
                    <p> Des joueurs qui ont la niaque, qui sont matures et ont une réelle envie de performance en un minimum de temps. On a tous une vie, on aime tous WoW, alors on se donne les moyens de profiter à 100% des deux.</p>
                </section>
                <section>
                    <h3>Une présence sur les trois soirs obligatoires :</h3>
                    <p>Mercredi — 21h à 00h</p>
                    <p>Jeudi — 21h à 00h</p>
                    <p> Dimanche — 21h à 00h</p>
                </section>
                <section>
                    <h3>Palmarès :</h3>
                    <p>Nerub'ar Palace - 1er serveur (10e FR / 196e World)</p>
                    <p>Amirdrassil - 1er serveur (11e FR / 245e World)</p>
                    <p>Aberrus - 2e serveur (13e FR / 294e World)</p>
                    <p>Caveau des Incarnations - 2e serveur (17e FR / 307e World) </p>
                    <p>Sepulcher of the First Ones - 3e serveur (18e FR / 327e World)</p>
                    <p>Sanctum of Domination - 3e serveur (18e FR / 393e World)</p>
                    <p>Castle Nathria - 4e serveur (23e FR / 364e World)</p>
                    <p>Ny'alotha - 3e serveur (30e FR / 469e World)</p>
                    <p>The Eternal Palace - 3e serveur (27e FR / 546e World)</p>
                    <p>Battle of Dazar'alor - 5e serveur (55e FR / 1035e World)</p>
                </section>
            </section>
        </section>
<<<<<<< HEAD
    <aside id="medias">
        <iframe
            src="https://www.youtube-nocookie.com/embed/0VZz7v0-LVs?si=TlCQP79vRfIdvDZ4"
            title="Reine Ansurek Myhique"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
            loading="lazy"
            class="videos">
        </iframe>
        <button id="activer_twitch" class="bouton actif">Nos streamers Twitch</button>
        <div id="twitch-embed"></div>
    </aside>
=======

        <aside id="medias">
            <iframe
                src="https://www.youtube-nocookie.com/embed/0VZz7v0-LVs?si=TlCQP79vRfIdvDZ4"
                title="Reine Ansurek Myhique"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
                loading="lazy"
                class="videos">
            </iframe>
            <button id="activer_twitch" class="bouton actif">Nos streamers Twitch</button>
            <div id="twitch-embed"></div>
        </aside>
>>>>>>> 340cd16746a54d114a0aa8a8ed9e9d38412750c1
    </div>

    <!-- Liste des membres du roster -->
    <section id="liste_roster">
        <h2>Notre roster mythique</h2>
        <ul>
            <?php if (count($titan) > 0) :
                for ($i = 0; $i < count($titan); $i++): ?>
                    <li><?= ucfirst($titan[$i]["pseudo"]) ?></li>
                <?php endfor;
            endif;
            if (count($moderateur) > 0) : for ($i = 0; $i < count($moderateur); $i++) : ?>
                    <li> <?= ucfirst($moderateur[$i]["pseudo"]) ?>
                <?php endfor;
            endif; ?>
        </ul>
    </section>
</main>