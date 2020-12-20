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

        /* Sécurité supplémentaire : vérifier si l'utilisateur est connecté en tant qu'admin.
        Autrement, quiconque disposant du lien vers cette page pourrait y accéder. */
        $userSession = new UserSession();
        if ($userSession->isAdmin() == false) {
            $http->redirectTo('/user/login');
        }
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

        /* Sécurité supplémentaire : vérifier si l'utilisateur est connecté en tant qu'admin.
        Autrement, quiconque disposant du lien vers cette page pourrait y accéder. */
        $userSession = new UserSession();
        if ($userSession->isAdmin() == false) {
            $http->redirectTo('/user/login');
        }

        /* Si une photo a été ajoutée — la déplacer vers le dossier img
        sinon mettre une photo par défaut */
        if ($http->hasUploadedFile('photo') == true) {
            $photo = $http->moveUploadedFile('photo', '/img/staff');
        } else {
            $photo = 'unknown-staff.jpg';
        }

        /* Exécute la requête paramétrée avec le contenu du formulaire */
        $staffModel = new StaffModel();

        if (empty($formFields['firstName']) == false) {
            $jobCategories = $staffModel->getJobCategories();
            /* Bloc de code servant à éviter une injection SQL de catégorie mais seul l'admin peut faire cette injection,
            or il est sensé être gentil, donc on lui fait confiance. */

            $flaw = true; // Si flaw reste à true, c'est qu'il y a une faille

            /* Si la valeur injectée est comprise dans la colonne du tableau, alors on considère qu'il n'y a pas de faille
             et on peut alors procéder avec la méthode create */
            foreach ($jobCategories as $jobCategory) :
                if (in_array($formFields['category'], $jobCategory)) {
                    $flaw = false;
                }
            endforeach;

            if ($flaw == false) {
                $staffModel->insertStaffMember(
                    $formFields['firstName'],
                    $formFields['lastName'],
                    $formFields['occupation'],
                    $formFields['category'],
                    $photo

                );
            }


            $http->redirectTo('/admin/staff');
        }

        array_push($staffMembers, $formFields['firstName']);

        return $staffMembers;
    }
}
