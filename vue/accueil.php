<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>

<body class="container">

    <p><?php //si un membre a supprimé son compte
        if (isset($_SESSION["message_suppression_compte"])) {
            echo $_SESSION["message_suppression_compte"]; // on affiche le message de suppression de compte
            seDeconnecter(); // on déconnecte le membre qui a supprimé son compte
            header("Location: index.php?action=accueil");
            exit;
        }
        ?></p>

    <h1></h1>

    <!--------------------Liste des membres du roster----------------------->
    <ul id="liste_roster">
        <?php if (count($titan) > 0) :
            for ($i = 0; $i < count($titan); $i++): ?>
                <li><?= ucfirst($titan[$i]["pseudo"]) ?></li>
        <?php endfor;
        endif; ?>
    </ul>
</body>