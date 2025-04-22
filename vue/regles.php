<?php
// sécurité pour éviter l'accès aux fichiers contenant des fonctions & variables
// verification que le script PHP est exécuté directement et pas depuis un autre fichier
if ($_SERVER["SCRIPT_FILENAME"] == str_replace(DIRECTORY_SEPARATOR, '/',  __FILE__)) {
    // si c'est le cas, arrêt du script + message d'erreur
    die('Erreur : ' . basename(__FILE__));
}
?>

<main class="container regles">
    <h1>Règles de la Communauté de la Guilde</h1>
    <section>
        <h2>Introduction</h2>
        <p>Bienvenue chez Origin ! Nous avons à cœur de maintenir un environnement sain, respectueux et agréable pour tou·te·s nos membres. Afin de garantir une expérience optimale pour chacun·e, nous avons établi des règles de conduite claires. Le respect et la rigueur sont les fondements de notre communauté.</p>
    </section>

    <section>
        <h2>Nos Valeurs</h2>
        <p>Notre guilde repose sur deux valeurs essentielles :</p>
        <ul>
            <li><strong>Respect</strong> : Nous sommes tou·te·s différent·e·s, nous ne sommes pas toujours d’accord, mais nous avons à cœur de considérer chacun·e de nos membres avec bienveillance et tolérance</li>
            <li><strong>Rigueur</strong> : Nous attendons de chacun·e de nos joueur·se·s qu’iel soit préparé·e, informé·e et impliqué·e à chaque nouveau palier.</li>
        </ul>
    </section>

    <section>
        <h2>Règles de Comportement</h2>
        <p>Voici les règles de conduite que chaque membre doit suivre :</p>
        <ul>
            <li><strong>Respectez les autres membres</strong> : Toute forme de racisme, d'insultes ou de dévalorisation d’un·e autre joueur·se est strictement interdite. Soyez courtois·e et traitez les autres comme vous aimeriez être traité·e.</li>
            <li><strong>Aucune forme de discrimination</strong> : La guilde rejette toute forme de discrimination, qu’elle soit basée sur la race, le genre, l'orientation sexuelle, la religion ou toute autre caractéristique personnelle.</li>
            <li><strong>Évitez les conflits inutiles</strong> : Si vous avez un différend avec un·e autre membre, gérez-le de manière privée et respectueuse. Les disputes publiques ne sont pas tolérées.</li>
            <li><strong>Comportement constructif</strong> : Participez activement aux discussions, apportez des idées et soyez impliqué·e dans les activités et progrès de la guilde.</li>
            <li><strong>Soignez votre langage</strong> : Les propos violents, haineux ou vulgaires sont à proscrire en tout temps. Utilisez un langage respectueux et approprié, en particulier dans les discussions publiques.</li>
        </ul>
    </section>

    <section>
        <h2>Sanctions en Cas de Non-Respect des Règles</h2>
        <p>Le non-respect de ces règles de conduite entraînera des sanctions. Les sanctions peuvent inclure, mais ne se limitent pas à :</p>
        <ul>
            <li><strong>Avertissements</strong> : Les membres qui enfreignent ces règles pour la première fois recevront un avertissement. Si le comportement persiste, des sanctions plus sévères seront appliquées.</li>
            <li><strong>Exclusion temporaire</strong> : En cas d'infraction mineure ou première infraction, le·la membre pourra être exclu·e temporairement pour lui permettre de réfléchir à son comportement.</li>
            <li><strong>Suppression de compte ou retrait de la guilde</strong> : En cas de comportements graves ou répétés, tels que le racisme, les insultes graves ou la dévalorisation d’autres membres, une exclusion définitive de la guilde pourra être envisagée. Cela inclut la suppression du compte si nécessaire.</li>
        </ul>
        <p>Nous nous engageons à appliquer ces sanctions de manière équitable, en prenant en compte la gravité de l'infraction et l'historique du·de la membre concerné·e. La décision finale reviendra aux responsables de la guilde.</p>
    </section>

</main>