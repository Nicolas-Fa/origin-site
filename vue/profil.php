<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>

<h1>Profil de <?= $pseudo ?></h1>

<?php for($i = 0; $i > count($royaume_personnage); $i++): ?>
<p> <?= $royaume_personnage[$i]["royaume"]; ?></p>
<?php endfor; ?>