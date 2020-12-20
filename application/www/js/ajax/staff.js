"use strict";
let staffId, editedInfo, firstName, lastName, occupation;
let crudTable = $("#crud-table");

/*-------------------------------------------------------- Suppression d'élément -----------------------------------------------*/
crudTable.on("click", "#remove-button", function (event) {
  // Récuperation du bouton cliqué
  var button = $(event.currentTarget);

  // Contenu de data-staff du bouton cliqué, correspondant au contenu de la colonne Id de la BDD
  staffId = button.data("staff");

  // Confirmation de suppression de l'élement
  var confirmation = confirm("Proceed with deletion?");
  if (confirmation) {
    // Envoi d'une requête HTTP POST au contrôleur, qui fera à son tour appel à la méthode supprimer du modèle (avec staffId comme paramètre), afin de supprimer de la ligne concernée depuis la BDD
    $.post(requestUrl + "/admin/staff/delete", { staffId: staffId }, onDeleteRow);
  }
});

// Fonction callback, executée après avoir reçu une réponse JSON de la part du contrôleur
function onDeleteRow(response) {
  // La réponse JSON est en format string, la méthode parse permet de la transformer en objet
  var response = JSON.parse(response);

  // Bouton cliqué
  var button = $("#remove-button[data-staff='" + staffId + "']");
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
  firstName = tr.find("[data-staff='firstName']");
  var firstNameVal = firstName.text();
  lastName = tr.find("[data-staff='lastName']");
  var lastNameVal = lastName.text();
  occupation = tr.find("[data-staff='occupation']");
  var occupationVal = occupation.text();

  // Contenu de data-staff du bouton cliqué, correspondant au contenu de la colonne Id de la BDD
  staffId = button.data("staff");

  if (icon.hasClass("fa-cog")) {
    // Il ne sert à rien de rajouter un type, car ces inputs ne se trouvent pas dans un formulaire qui se chargera de la validation des types
    firstName.html("<input data-staff='firstName' value='" + firstNameVal + "'>");
    lastName.html("<input data-staff='lastName' value='" + lastNameVal + "'>");
    occupation.html("<input data-staff='occupation' value='" + occupationVal + "'>");
  } else {
    var staffInfo = {
      firstName: tr.find("input[data-staff='firstName']").val(),
      lastName: tr.find("input[data-staff='lastName']").val(),
      occupation: tr.find("input[data-staff='occupation']").val(),
      staffId: staffId,
    };
    $.post(requestUrl + "/admin/staff/edit", staffInfo, onEditRow);
    editedInfo = [tr.find("input[data-staff='firstName']").val(), tr.find("input[data-staff='lastName']").val(), tr.find("input[data-staff='occupation']").val()];
    firstName.html(editedInfo[0]);
    lastName.html(editedInfo[1]);
    occupation.html(editedInfo[2]);
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
