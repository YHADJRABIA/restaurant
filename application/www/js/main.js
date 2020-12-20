"use strict"; // Contraint l'utilisateur à déclarer les variables afin de pouvoir les manipuler

// Chemin des fichiers

var requestUrl = getRequestUrl();
var wwwUrl = getWwwUrl();

//--------------------------------- Réferencement des éléments HTML -----------------------------------------------

// Il est préférable d'utiliser le mot-clé const si les éléments ne sont pas redéfinis plus bas, cela empêche également leur modification par mégarde

// Barre de navigation
const BURGER = document.querySelector(".burger");
const NAV_LINKS = document.querySelector(".nav-links");

// Boutons du panel admin

//const EDIT_BUTTON = $("#edit-button");
//const REMOVE_BUTTON = $("#remove-button");

// Lightbox
let photoItems = document.querySelectorAll(".lightbox-item");
let totalPhotoItem = photoItems.length;
const LIGHTBOX = document.querySelector(".lightbox");
let lightboxClose = LIGHTBOX.querySelector(".lightbox-close"); // Icône de fermeture
let lightboxImg = LIGHTBOX.querySelector(".lightbox-img"); // Image
let lightboxText = LIGHTBOX.querySelector(".caption-text"); // Texte sous l'image
let lightboxCounter = LIGHTBOX.querySelector(".caption-counter"); // Compteur

// Filtrage
/* Bloc de code manipulant des DOM exclusifs à la page « Staff » (filterBtns n'a aucun enfant en dehors de la page staff), si l'utilisateur
 se trouvait sur une autre page que celle là alors le code coincerait à la ligne manipulant les enfants introuvables de l'élément 
 (se créant dynamiquement depuis la base de données), il est donc nécessaire de s'assurer qu'on est sur la bonne page.
 
 A noter que le type « var » est utilisé au lieu de « let » pour que les élements soient visibles sur toute la page au lieu de juste 
 la structure if */
const FILTER_CONTAINER = document.querySelector(".filter");
if (window.location.href == requestUrl + "/staff") {
  var filterBtns = FILTER_CONTAINER.children; // Catégories de filtrage
  var totalFilterBtn = filterBtns.length;
  var itemsToFilter = document.querySelectorAll(".lightbox-item");
  var totalItemsToFilter = itemsToFilter.length;
}

//---------------------------------------- Gestion des évenements ---------------------------------------
let itemIndex = 0; // Indice de l'élement

// Barre de navigation
BURGER.addEventListener("click", toggleNav);

// Lightbox

// Apparition de la lightbox au clic d'une image
for (let i = 0; i < totalPhotoItem; i++) {
  photoItems[i].addEventListener("click", function () {
    itemIndex = i;
    changeItem();
    toggleLightbox();
  });
}

// Navigation de la lightbox avec les touches ← →
$(document).keydown(function (e) {
  // Les évenements de pression de touches du clavier n'auront lieu que si la lightbox est ouverte
  if (LIGHTBOX.classList.contains("open")) {
    switch (e.keyCode) {
      case 37: // ◄
        prevItem();
        break;

      case 39: // ►
        nextItem();
        break;

      case 27: // Esc
        toggleLightbox();
        break;
    }
  }
});

// Fermeture de la lightbox si l'utilsateur clique sur X ou en dehors du conteneur
LIGHTBOX.addEventListener("click", function (e) {
  if (e.target === lightboxClose || e.target === LIGHTBOX) {
    toggleLightbox();
  }
});

// Filtrage (exclusive à la page « Staff » )
if (window.location.href == requestUrl + "/staff") {
  for (let i = 0; i < totalFilterBtn; i++) {
    filterBtns[i].addEventListener("click", filterByCategory); // Évenement enclenché au clic des boutons de filtrage
  }
}
