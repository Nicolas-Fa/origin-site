document.addEventListener("DOMContentLoaded", function () {
  // selection des boutons "editer"
  const formulaire = document.querySelectorAll(".editer");

  // ouverture et fermeture des formulaires
  formulaire.forEach((button) => {
    button.addEventListener("click", function () {
      const id = button.getAttribute("data-id");
      const type = button.getAttribute("data-type");
      afficherFormulaireEdition(id, type);
    });
  });

  // menu burger
  const burger = document.getElementById("burger");
  const nav_liste = document.querySelector(".nav_liste");
  const icone_burger = burger?.querySelector("i");

  if (burger && nav_liste && icone_burger) {
    burger.addEventListener("click", function (scroll) {
      scroll.preventDefault(); //empêche le scroll vers le haut
      nav_liste.classList.toggle("active");
      icone_burger.classList.toggle("fa-bars");
      icone_burger.classList.toggle("fa-xmark");
    });
  }
});

/* Nom de la fonction : afficherFormulaireEdition
 *
 * A quoi sert cette fonction : afficher un formulaire
 *
 * Paramètres de la fonction (id, type)
 *	id : le data-id du formulaire
 *  type : le data-type du formulaire
 *
 * Retour : le formulaire d'edition s'affiche ou se cache
 */
function afficherFormulaireEdition(id, type) {
  // on récupère tous les formulaires
  const tousLesForm = document.querySelectorAll(".formulaire_edition");
  // on sélectionne le bon formulaire en fonction du type
  const form = document.getElementById(`editer_${type}_${id}`);

  // s'il n'y a pas de formulaire, arrêt de la fonction
  if (!form) return;

  tousLesForm.forEach((form) => {
    form.classList.replace("actif", "cache"); // on cache les formulaires ouverts
  });

  // s'il y a un formulaire, et qu'il a la classe "cache"
  if (form && form.classList.contains("cache")) {
    form.classList.replace("cache", "actif"); // on remplace "cache" par "actif"
  } else {
    form.classList.replace("actif", "cache"); // on remplace "actif" par "caché"
  }
}
