<?php

class MenuController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        /*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

        // Création d'un objet de la classe appartenant au modèle, afin d'avoir accès aux méthodes CRUD
        $menuModel = new MenuModel();

        $menuItems = $menuModel->getAllMenuItems();

        // Retour des paramètre exploitables depuis la vue
        return [
            'flashBag' => new FlashBag(),
            "menuItems" => $menuItems
        ];
    }


    public function httpPostMethod(Http $http, array $formFields)
    {
        /*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
    }
}
