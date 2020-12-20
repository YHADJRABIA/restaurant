<?php

class UserModel
{
  public function signUp(
    string $lastName,
    string $firstName,
    string $email,
    string $password,
    string $birthDate,
    string $address,
    string $city,
    string $country,
    string $zipCode,
    string $phone,
    $admin = 0
  ) {
    $database = new Database();

    // On vérifie qu'il y a un utilisateur avec l'adresse e-mail spécifiée.
    $user = $database->queryOne(
      "SELECT Id FROM user WHERE Email = ?",
      [$email]
    );

    // Est-ce qu'on a bien trouvé un utilisateur ?
    if (!empty($user)) {
      // Retourne une erreur type DomainException
      throw new DomainException(
        "E-mail already in use"
      );
    }

    $sql = "INSERT INTO user
		(
			LastName,
			FirstName,
			Email,
			Password,
			BirthDate,
			CreationTimestamp,
			Address,
			City,
            Country,
			ZipCode,
			Phone,
			Admin
		) VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)";

    /*
         * Hachage du mot de passe, le mot de passe en clair n'est JAMAIS enregistré
         * et ne pourra JAMAIS être récupéré.
         */
    $passwordHash = $this->hashPassword($password);

    // Insertion de l'utilisateur dans la base de données.
    $database->executeSql(
      $sql,
      [
        $lastName,
        $firstName,
        $email,
        $passwordHash,
        $birthDate,
        $address,
        $city,
        $country,
        $zipCode,
        $phone,
        $admin
      ]
    );

    // Ajout d'un message de notification qui s'affichera sur la page d'accueil.
    $flashBag = new FlashBag();
    $flashBag->add('Your account has been successfully created!');
  }

  private function hashPassword(string $password)
  {
    /*
         * Génération du sel, nécessite l'extension PHP OpenSSL pour fonctionner.
         *
         * openssl_random_pseudo_bytes() va renvoyer n'importe quel type de caractères.
         * Or le chiffrement en blowfish nécessite un sel avec uniquement les caractères
         * a-z, A-Z ou 0-9.
         *
         * On utilise donc bin2hex() pour convertir en une chaîne hexadécimale le résultat,
         * qu'on tronque ensuite à 22 caractères pour être sûr d'obtenir la taille
         * nécessaire pour construire le sel du chiffrement en blowfish.
         */
    $salt = '$r$io1er$' . substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);


    // Voir la documentation de crypt() : http://devdocs.io/php/function.crypt
    return crypt($password, $salt);
  }

  private function verifyPassword(string $password, string $hashedPassword)
  {
    // Si le mot de passe en clair est le même que la version hachée alors renvoie true.
    return crypt($password, $hashedPassword) == $hashedPassword;
  }

  public function findWithEmailPassword(string $email, string $password)
  {
    $database = new Database();

    // Récupération de l'utilisateur ayant l'email spécifié en argument.
    $user = $database->queryOne(
      "SELECT
                Id,
                LastName,
                FirstName,
                Email,
                Password,
                Admin
            FROM user
            WHERE Email = ?",
      [$email]
    );

    // Est-ce qu'on a bien trouvé un utilisateur ?
    if (empty($user)) {
      throw new DomainException(
        "Wrong e-mail or password"
      );
    }

    // Est-ce que le mot de passe spécifié est correct par rapport à celui stocké ?
    if ($this->verifyPassword($password, $user['Password']) == false) {
      throw new DomainException(
        "Wrong e-mail or password"
      );
    }

    return $user;
  }

  public function getUserById($userId)
  {
    $database = new Database();

    $sql = "
        SELECT
            *
        FROM
            `user`
        WHERE
            `Id` = ?";

    return $database->queryOne($sql, [$userId]);
  }

  public function getAllUsers()
  {
    $database = new Database();

    $sql = "
        SELECT
            *
        FROM
            `user`";

    return $database->query($sql);
  }
}
