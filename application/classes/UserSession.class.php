<?php

class UserSession
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            // Démarrage du module PHP de gestion des sessions.
            session_start();
        }
    }

    public function create($userId, $firstName, $lastName, $email, $admin)
    {
        // Construction de la session utilisateur.
        $_SESSION['user'] =
            [
                'UserId'    => $userId,
                'FirstName' => $firstName,
                'LastName'  => $lastName,
                'Email'     => $email,
                'Admin'     => $admin
            ];
    }

    public function getAdmin()
    {
        if ($this->isAuthenticated() == false) {
            return null;
        }
        return $_SESSION['user']['Admin'];
    }

    // Récupération du nom complet de l'utilisateur connecté
    public function getFullName()
    {
        if ($this->isAuthenticated() == false) {
            return null;
        }
        return $_SESSION['user']['FirstName'] . ' ' . $_SESSION['user']['LastName'];
    }

    public function isAuthenticated()
    {
        if (array_key_exists('user', $_SESSION) && !empty($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public function getId()
    {
        if ($this->isAuthenticated() == false) {
            return null;
        }
        return $_SESSION['user']['UserId'];
    }

    public function logout()
    {
        $_SESSION['user'] = [];
    }

    public function isAdmin()
    {
        if ($this->getAdmin() != 1) {
            return false;
        }
        return true;
    }
}
