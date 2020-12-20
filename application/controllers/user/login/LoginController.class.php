<?php

class LoginController
{
	public function httpGetMethod(Http $http, array $queryFields)
	{
		/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

		// Empêche l'accès à la page de connexion à tout utilisateur déjà connecté
		$userSession = new UserSession();
		if ($userSession->isAuthenticated() == true) {
			$http->redirectTo('/');
		}

		return [
			"_form" => new LoginForm()
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
		if ($userSession->isAuthenticated() == true) {
			$http->redirectTo('/');
		}


		$userModel = new UserModel();


		try {

			$user = $userModel->findWithEmailPassword($formFields['email'], $formFields['password']);

			// Construction de la session utilisateur.
			$userSession = new UserSession();
			$userSession->create(
				$user['Id'],
				$user['FirstName'],
				$user['LastName'],
				$user['Email'],
				$user['Admin']
			);

			// Redirection vers la page d'accueil.
			$http->redirectTo('/');
		} catch (DomainException $exception) {
			// Réaffichage du formulaire avec un message d'erreur.
			$form = new LoginForm();
			$form->bind($formFields);
			$form->setErrorMessage($exception->getMessage());

			return ['_form' => $form];
		}
	}
}
