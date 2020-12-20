"use strict";

/*---------------------------------------------- Fonctions liées aux évenements ----------------------------------------------*/

/*------------------------------------------------ Barre de navigation ----------------------------------------------------*/

// Déroulement de la barre de navigation en affichage tablette et mobile.
function toggleNav() {
  NAV_LINKS.classList.toggle("nav-active");
  this.classList.toggle("toggle");
}

/*-------------------------------------------- Lightbox ---------------------------------------------------------*/

// Image suivante
function nextItem() {
  itemIndex == totalPhotoItem - 1 ? (itemIndex = 0) : itemIndex++;
  changeItem();
}

// Image suivante
function prevItem() {
  itemIndex == 0 ? (itemIndex = totalPhotoItem - 1) : itemIndex--;
  changeItem();
}

// Affichage ou non de la lightbox
function toggleLightbox() {
  LIGHTBOX.classList.toggle("open");
}

// Mise à jour des informations de l'élément sélectionné
function changeItem() {
  var imgSrc = photoItems[itemIndex].querySelector(".lightbox-item img").getAttribute("src");
  lightboxImg.src = imgSrc; // Change l'image
  lightboxText.innerHTML = photoItems[itemIndex].querySelector("figcaption").innerHTML; // Change le titre
  lightboxCounter.innerHTML = itemIndex + 1 + " of " + totalPhotoItem; // Change l'indice du compteur
}

/* Filtrage */

// Filtrage du personnel du restaurant en fonction de leur
function filterByCategory() {
  FILTER_CONTAINER.querySelector(".active").classList.remove("active"); // Ôte la classe « active » à l'élement souligné pour qu'il ne soit plus souslignés
  this.classList.add("active"); // Souligne l'élément actif uniquement

  // Filtre les élements n'appartenant pas à la catégorie du filtre choisie
  const FILTER_VALUE = this.getAttribute("data-filter");
  for (let k = 0; k < totalItemsToFilter; k++) {
    switch (FILTER_VALUE) {
      case itemsToFilter[k].getAttribute("data-category"):
        itemsToFilter[k].classList.remove("hidden");
        // Il pourrait parraître redondant d'ajouter une classe show vu que l'élement n'est déjà plus caché, mais ceci a pour but d'enclencher l'animation associée à la classe
        itemsToFilter[k].classList.add("show");
        break;

      case "all":
        itemsToFilter[k].classList.remove("hidden");
        itemsToFilter[k].classList.add("show");
        break;

      default:
        itemsToFilter[k].classList.remove("show");
        itemsToFilter[k].classList.add("hidden");
        break;
    }
  }
}
