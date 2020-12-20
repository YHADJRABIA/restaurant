"use strict";
let menuId, editedInfo, name, price;
let crudTable = $("#crud-table");
/*-------------------------------------------------------- Suppression d'élément -----------------------------------------------*/

crudTable.on("click", "#remove-button", function (event) {
  // Récuperation du bouton cliqué
  var button = $(event.currentTarget);

  // Contenu de data-menu du bouton cliqué, correspondant au contenu de la colonne Id de la BDD
  menuId = button.data("menu");

  // Confirmation de suppression de l'élement
  var confirmation = confirm("Proceed with deletion?");
  console.log(menuId);
  if (confirmation) {
    // Envoi d'une requête HTTP POST au contrôleur, qui fera à son tour appel à la méthode supprimer du modèle (avec menuId comme paramètre), afin de supprimer de la ligne concernée depuis la BDD
    $.post(requestUrl + "/admin/menu/delete", { menuId: menuId }, onDeleteRow);
  }
});

// Fonction callback, executée après avoir reçu une réponse JSON de la part du contrôleur
function onDeleteRow(response) {
  // La réponse JSON est en format string, la méthode parse permet de la transformer en objet
  var response = JSON.parse(response);
  console.log(menuId);
  // Bouton cliqué
  var button = $("#remove-button[data-menu='" + menuId + "']");

  // Ligne du tableau correspondant au bouton cliqué
  var tr = button.closest("tr");

  // Si la réponse est égale à 0 c'est que la ligne a bien été supprimée de la base de données, il est donc possible de procéder à sa suppression sur la vue
  if (response === "0") {
    // Suppression de la ligne de tableau concernée de l'interface
    tr.remove();
  }
}

/*-------------------------------------------------------- Modification d'élément -----------------------------------------------*/
crudTable.on("click", "#edit-button", function (event) {
  // Bouton cliqué
  var button = $(event.currentTarget);

  // Icône du bouton cliqué
  var icon = button.children("i");

  // Ligne du tableau correspondant au bouton cliqué
  var tr = button.closest("tr");

  // Champs à modifier
  name = tr.find("[data-menu='name']");
  var nameVal = name.text();
  price = tr.find("[data-menu='price']");
  var priceVal = price.text().replace(" €", "");

  // Contenu de data-menu du bouton cliqué, correspondant au contenu de la colonne Id de la BDD
  menuId = button.data("menu");

  if (icon.hasClass("fa-cog")) {
    name.html("<input data-menu='name' value='" + nameVal + "'>");
    price.html("<input data-menu='price' value='" + priceVal + "'>");
  } else {
    var menuInfo = {
      name: tr.find("input[data-menu='name']").val(),
      price: tr.find("input[data-menu='price']").val(),
      menuId: menuId,
    };
    console.log(menuId);
    $.post(requestUrl + "/admin/menu/edit", menuInfo, onEditRow);
    editedInfo = [tr.find("input[data-menu='name']").val(), tr.find("input[data-menu='price']").val()];
    name.html(editedInfo[0]);
    if (isNaN(editedInfo[1])) {
      price.html("This needs to be a number!");
    } else {
      price.html(editedInfo[1] + " €");
    }
  }

  // Inversion d'icônes
  icon.toggleClass("fa-cog");
  icon.toggleClass("fa-check");
});

function onEditRow(response) {
  // La réponse JSON est en format string, la méthode parse permet de la transformer en objet
  var response = JSON.parse(response);
  // Si la réponse est égale à 0 c'est que la ligne a bien été modifiée de la base de données, il est donc possible de procéder à sa modification sur la vue
  if (response === "0") {
    // Et oui, j'ai un peu triché avec ce handler, vous avez décelé ma supercherie !
  }
}
