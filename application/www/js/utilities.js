"use strict";

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

function getRequestUrl() {
  var requestUrl;

  /*
   * Création de l'équivalent de la variable de template PHP $requestUrl
   * contenant l'URL du Front Controller.
   *
   * Cette variable permet de créer des URLs vers des contrôleurs.
   */
  requestUrl = window.location.href;
  requestUrl = requestUrl.substr(0, requestUrl.indexOf("/index.php") + 10);

  return requestUrl;
}

function getWwwUrl() {
  var wwwUrl;

  /*
   * Création de l'équivalent de la variable de template PHP $wwwUrl
   * contenant l'URL du dossier www.
   *
   * Cette variable permet de créer des URLs vers des fichiers statiques.
   */
  wwwUrl = window.location.href;
  wwwUrl = wwwUrl.substr(0, wwwUrl.indexOf("/index.php")) + "/application/www";

  return wwwUrl;
}

function loadDataFromDomStorage(name) {
  var jsonData;

  jsonData = window.localStorage.getItem(name);

  /*
   * Donnée simple (chaîne) -> JSON parse (= désérialisation) -> Donnée complexe
   *
   * Voir ci-dessous pour plus d'explications sur le pourquoi du JSON.
   */
  return JSON.parse(jsonData);
}

function saveDataToDomStorage(name, data) {
  var jsonData;

  /*
   * Le DOM storage ne permet pas de stocker des données complexes (objet, tableau...).
   * On doit donc d'aborder sérialiser nos données dans un format simple, le JSON.
   *
   * On obtient une chaîne représentant l'objet complexe, et c'est cette chaîne que
   * l'on stocke dans le DOM storage.
   *
   * Donnée complexe -> JSON stringify (= sérialisation) -> Donnée simple (chaîne)
   */
  jsonData = JSON.stringify(data);

  window.localStorage.setItem(name, jsonData);
}
