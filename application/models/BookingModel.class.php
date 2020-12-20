<?php

/* Il est à noter que la colonne User_Id de la table booking est une clé étrangère liée à la colonne ID
de la table user, c'est à dire que si un utilisateur décide de supprimer son compte (plus d'Id) la colonne User_Id
de la table bookin en sera affectée*/

class BookingModel
{

    //---------------------------------CREATE----------------------------------//
    // Insertion d'un nouvel élement au menu — les arguments de la fonction correspondent aux noms des colonnes
    public function setBooking($bookinDate, $bookingTime, $numberOfSeats, $userId)
    {
        // Appel de la classe de base de données
        $database = new Database();

        $sql = "
        INSERT INTO `booking`(`BookingDate`, `BookingTime`, `NumberOfSeats`, `User_Id`) 
        VALUES (?,?,?,?)";

        $params = [$bookinDate, $bookingTime, $numberOfSeats, $userId];

        return $database->executeSql($sql, $params);
    }


    //--------------------------------READ (avec jointure)--------------------------------------//
    // Fonction utilisable par l'administrateur récupérant la liste des utilisateurs ayant réservé une table (nom, prénom, nombre de places, date et heure)
    public function getReservationList()
    {
        // Appel de la classe de base de données
        $database = new Database();

        $sql = "
        SELECT
         user.FirstName,
         user.LastName,
         NumberOfSeats,
         BookingTime,
         BookingDate

        FROM `booking`
        INNER JOIN `user` ON user.id=booking.User_Id";

        return $reservationList = $database->query($sql);
    }

    //--------------------------------READ (avec jointure)--------------------------------------//
    // Fonction rappelant les informations de réservation à l'utilisateur ayant réservé une table
    public function getReservationDetails($id)
    {
        // Appel de la classe de base de données
        $database = new Database();

        $sql = "
        SELECT
         NumberOfSeats,
         BookingTime,
         BookingDate
        FROM `booking`
        INNER JOIN `user` ON user.id=booking.User_Id
        WHERE user.id = ?";

        return $reservationInfo = $database->query($sql, [$id]);
    }
}
