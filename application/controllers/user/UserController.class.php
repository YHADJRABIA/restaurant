<?php

class UserController
{
	public function httpGetMethod(Http $http, array $queryFields)
	{
		/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
		// Empêche l'accès à la page de d'inscription à tout utilisateur déjà connecté
		$userSession = new UserSession();
		if ($userSession->isAuthenticated() == true) {
			$http->redirectTo('/');
		}
		return [
			"_form" => new UserForm()
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

		try {
			// Inscription de l'utilisateur.
			$userModel = new UserModel();
			$userModel->signUp(
				$formFields['lastName'],
				$formFields['firstName'],
				$formFields['email'],
				$formFields['password'],
				$formFields['birthYear'] . '-' . $formFields['birthMonth'] . '-' . $formFields['birthDay'],
				$formFields['address'],
				$formFields['city'],
				$formFields['country'],
				$formFields['zipCode'],
				$formFields['phone']
			);

			// Redirection vers la page d'accueil.
			$http->redirectTo('/');
		} catch (DomainException $exception) {
			// Réaffichage du formulaire avec un message d'erreur.
			$form = new UserForm();
			$form->bind($formFields);
			$form->setErrorMessage($exception->getMessage());

			return ['_form' => $form];
		}
	}
}
