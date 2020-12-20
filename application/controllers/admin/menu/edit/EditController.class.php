<?php

class EditController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        /*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        /*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */

        /* Sécurité supplémentaire : vérifier si l'utilisateur est connecté en tant qu'admin.
        Autrement, quiconque disposant du lien vers cette page pourrait y accéder. */
        $userSession = new UserSession();
        if ($userSession->isAdmin() == false) {
            $http->redirectTo('/user/login');
        }

        $menuModel = new MenuModel();
        $result = $menuModel->updateMenuItemById($formFields['name'], $formFields['price'], $formFields['menuId']);

        $http->sendJsonResponse($result);
    }
}
