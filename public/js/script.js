import { fetchCharacterInfo } from "./token.js";
import { CLIENT_ID, CLIENT_SECRET } from "./vars.js";
document.addEventListener("DOMContentLoaded", function () {
  // ------------------menu burger------------------------------------
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

  // --------------------affichage twitch---------------------------------
  // on vérifie que la place réservée pour twitch existe
  const twitch_embed = document.getElementById("twitch-embed");

  if (twitch_embed) {
    const bouton_twitch = document.querySelector("#activer_twitch")
    bouton_twitch.addEventListener("click", () => {
      // on cache le bouton au clic
      bouton_twitch.classList.add("cache");
      // on crée le script twitch 
      const script = document.createElement("script");
      script.src = "https://player.twitch.tv/js/embed/v1.js";
      script.onload = () => {
        const lecteur = new Twitch.Player("twitch-embed", {
          video: "2419639839",
          muted: true,
        });

        lecteur.addEventListener(Twitch.Player.READY, () => {
          lecteur.pause(); // pas de lecture automatique
        });
      };
      document.head.appendChild(script);
    });
  }
  // -----------------------boutons d'édition de la page de profil---------------------
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

  // ------------------boutons d'affichage de formulaire pour les commentaires--------------
  if (window.location.search.includes("candidatures")) {
    const commentaire = document.querySelectorAll(".commenter");

    commentaire.forEach((button) => {
      button.addEventListener("click", function () {
        const id = button.getAttribute("data-id");
        afficherFormulaireCommentaire(id);
      });
    });
  }

  if (window.location.search.includes("candidatures")) {
    const formulaire = document.querySelectorAll(".editer");

    formulaire.forEach((button) => {
      button.addEventListener("click", function () {
        const id = button.getAttribute("data-id");
        modifierCommentaire(id);
      });
    });
  }

  // --------------------------------API de visualisation de personnage---------------------
  //on vérifie qu'on est bien sur la page de profil
  if (
    window.location.search.includes("profil") ||
    window.location.search.includes("connexion")
  ) {
    // visualisation des personnages
    // on récupère le bouton
    const boutons_voir = document.querySelectorAll(".visualiser_personnage");

    // on récupère les information du champ sur lequel sera mis la visualisation du personnage
    const voir_personnage = document.querySelector("#visualisation_personnage");
    const nom_personnage = voir_personnage.querySelector(".nom_personnage");
    const race_personnage = voir_personnage.querySelector(".race_personnage");
    const classe_personnage =
      voir_personnage.querySelector(".classe_personnage");
    const image_personnage = voir_personnage.querySelector(".image_personnage");
    const erreur_message = voir_personnage.querySelector(".erreur_personnage");

    boutons_voir.forEach((bouton) => {
      bouton.addEventListener("click", async () => {
        const pseudo = bouton.getAttribute("data-pseudo");
        // console.log(pseudo);
        const royaume = bouton.getAttribute("data-royaume");
        // console.log(royaume);

        // Réinitialisation des champs
        nom_personnage.textContent = "";
        race_personnage.textContent = "";
        classe_personnage.textContent = "";
        erreur_message.textContent = "";
        image_personnage.src = "";
        image_personnage.style.display = "none";

        try {
          const { character, media } = await fetchCharacterInfo(
            royaume,
            pseudo
          );
          // console.log(character);
          nom_personnage.textContent = `${
            pseudo.charAt(0).toUpperCase() + pseudo.slice(1)
          } - ${royaume.charAt(0).toUpperCase() + royaume.slice(1)}`;
          race_personnage.textContent = `Race : ${
            character.playable_race?.name ?? "Inconnue"
          }`;
          classe_personnage.textContent = `Classe : ${
            character.playable_class?.name ?? "Inconnue"
          }`;

          const imageData = media.assets?.find(
            (asset) => asset.key === "main-raw"
          ).value;
          document.querySelector(".image_personnage").src = imageData;
          image_personnage.style.display = "block";
          image_personnage.alt = nom_personnage.textContent;
          if (imageData) {
            image_personnage.src = imageData;
          }
        } catch (error) {
          erreur_message.textContent = `Erreur : ${error.message}`;
        }
      });
    });
  }

  // ------------------------------compteur de mots----------------------------------------
  // on vérifie qu'on est bien sur la page de postulation
  if (window.location.search.includes("postuler")) {
    // compteur de mots des postulations
    const textarea = document.getElementById("postulation");
    const compteur = document.getElementById("compteur");
    // console.log(textarea);
    // console.log(compteur);

    // on modifie le compteur en fonction de ce qui est écrit
    const mettreAJourCompteur = () => {
      const caracteres = textarea.value.replace(/\s/g, ""); // on retire les espaces et d'éventuels espaces au début
      compteur.textContent = `${caracteres.length} / 750`;
    };

    // a chaque frappe de l'utilisateur, le compteur s'actualise
    textarea.addEventListener("input", mettreAJourCompteur);

    // On initialise au cas où du texte est prérempli
    mettreAJourCompteur();

    // a chaque frappe de l'utilisateur, le compteur s'actualise
    textarea.addEventListener("input", mettreAJourCompteur);

    // On initialise au cas où du texte est prérempli
    mettreAJourCompteur();
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
  const tous_les_form = document.querySelectorAll(".formulaire_edition");
  // on sélectionne le bon formulaire en fonction du type et de l'id
  const form = document.getElementById(`editer_${type}_${id}`);
  // s'il n'y a pas de formulaire, arrêt de la fonction
  if (!form) return;

  // s'il y a un formulaire, et qu'il a la classe "cache"
  if (form && form.classList.contains("cache")) {
    tous_les_form.forEach((form) => {
      form.classList.replace("actif", "cache"); // on cache les formulaires ouverts
    });
    form.classList.replace("cache", "actif"); // on remplace "cache" par "actif"
  } else {
    form.classList.replace("actif", "cache"); // on remplace "actif" par "caché"
  }
}

function afficherFormulaireCommentaire(id) {
  // on récupère les formulaires
  const formulaire_commentaire = document.querySelectorAll(
    ".formulaire_commentaire"
  );
  // on récupère les formulaires en fonction de l'id
  const form = document.getElementById(`commenter_postulation_${id}`);

  // s'il n'y a pas de formulaire, arrêt de la fonction
  if (!form) return;
  // s'il y a un formulaire qui a la class "cache"
  if (form && form.classList.contains("cache")) {
    formulaire_commentaire.forEach((form) => {
      form.classList.replace("actif", "cache"); // on ferme tous les formulaires ouverts
    });
    form.classList.replace("cache", "actif"); // on active le formulaire
  } else {
    form.classList.replace("actif", "cache"); // sinon on referme le formulaire
  }
}

function modifierCommentaire(id) {
  // on récupère les formulaires
  const formulaire_commentaire = document.querySelectorAll(
    ".modifier_formulaire"
  );
  // on récupère les formulaires en fonction de l'id de la postulation
  const form = document.getElementById(`editer_commentaire_${id}`);

  // s'il n'y a pas de formulaire, arret de la fonction
  if (!form) return;
  // s'il y a un formulaire avec la classe "cache"
  if (form && form.classList.contains("cache")) {
    formulaire_commentaire.forEach((form) => {
      form.classList.replace("actif", "cache"); // on ferme les formulaires ouverts
    });
    form.classList.replace("cache", "actif");
  } else {
    form.classList.replace("actif", "cache");
  }
}
