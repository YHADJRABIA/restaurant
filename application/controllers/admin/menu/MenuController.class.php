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

        /* Sécurité supplémentaire : vérifier si l'utilisateur est connecté en tant qu'admin.
        Autrement, quiconque disposant du lien vers cette page pourrait y accéder. */
        $userSession = new UserSession();
        if ($userSession->isAdmin() == false) {
            $http->redirectTo('/user/login');
        }
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
        $userSession = new UserSession();
        if ($userSession->isAdmin() == false) {
            $http->redirectTo('/user/login');
        }

        /* Si une photo a été ajoutée — la déplacer vers le dossier img
        sinon mettre une photo par défaut */
        if ($http->hasUploadedFile('photo') == true) {
            $photo = $http->moveUploadedFile('photo', '/img/menu');
        } else {
            $photo = 'unknown-menu.jpg';
        }

        /* Exécute la requête paramétrée avec le contenu du formulaire */
        if (empty($formFields['name']) == false) {
            $menuModel = new MenuModel();
            $menuModel->insertMenuItem(
                $formFields['name'],
                $formFields['price'],
                $photo
            );

            $http->redirectTo('/admin/menu');
        }

        // récup le name de chaque meal checked et push in $meals 

        array_push($menuItems, $formFields['name']);

        return $menuItems;
    }
}
