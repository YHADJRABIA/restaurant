<?php

class StaffController
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
        $staffModel = new StaffModel();

        $staffMembers = $staffModel->getAllStaffMembers();
        $jobCategories = $staffModel->getJobCategories();

        // Retour des paramètre exploitables depuis la vue
        return [
            'flashBag' => new FlashBag(),
            "staffMembers" => $staffMembers,
            "jobCategories" => $jobCategories
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
