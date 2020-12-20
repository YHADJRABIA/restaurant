<?php
class BookingController
{
	public function httpGetMethod(Http $http, array $queryFields)
	{
		/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

		/* Sécurité supplémentaire : cette page n'est sensée être accessible qu'aux utilisateurs connectés.
		Si par example un utilisateur non connecté venait à taper manuellement le chemin de cette page sur sa barre de recherche,
		il pourrait y accéder.*/
		$userSession = new UserSession();
		if ($userSession->getAdmin() == 1) {
			$http->redirectTo('/');
		} elseif ($userSession->isAuthenticated() == false) {
			$http->redirectTo('/user/login');
		}
		return ['_form' => new BookingForm];
	}

	public function httpPostMethod(Http $http, array $formFields)
	{
		/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */

		/* Sécurité supplémentaire : cette page n'est sensée être accessible qu'aux utilisateurs connectés.
		Si par example un utilisateur non connecté venait à taper manuellement le chemin de cette page sur sa barre de recherche,
		il pourrait y accéder.*/
		$userSession = new UserSession();
		if ($userSession->getAdmin() == 1) {
			$http->redirectTo('/');
		} elseif ($userSession->isAuthenticated() == false) {
			$http->redirectTo('/user/login');
		}


		$bookingModel = new BookingModel();
		$userSession = new UserSession();

		$bookingYear = $formFields['bookingYear'] . '-' . $formFields['bookingMonth'] . '-' . $formFields['bookingDay'];
		$bookingTime = $formFields['bookingHour'] . ':' . $formFields['bookingMinute'] . ':00';

		$reservationId = $bookingModel->setBooking(
			$bookingYear,
			$bookingTime,
			$formFields['numberOfSeats'],
			$userSession->getId()
		);

		// Ajout d'un message de notification
		$flashBag = new FlashBag();
		$flashBag->add('Your reservation has been taken into account');

		// Redirection vers la page d'accueil
		$http->redirectTo('/');
	}
}
