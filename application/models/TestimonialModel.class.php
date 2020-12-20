<?php
/* Model d'intéraction avec la table « testimonial » de la base de données, contenant les méthodes CRUD.
En notant que les méthodes Create, Update et Delete ne sont accessibles que par l'administrateur du site, pas de risques d'injection SQL donc
*/
class TestimonialModel
{

    //---------------------------------READ----------------------------------
    // Récupère l'intégralité du contenu de la table « testimonial »
    public function getAllTestimonials()
    {
        // Appel de la classe de base de données
        $database = new Database();

        // Formulation de la requête SQL
        $sql = "
        SELECT 
            *
        FROM
            `testimonial`";

        // Retourne les données récupérées depuis la base de données resultants de l'execution de la requête
        return $testimonials = $database->query($sql);
    }

    // Récupère le commentaire dont l'id est determiné par l'utilisateur final
    public function getTestimonialById($id)
    {
        $database = new Database();

        $sql = "
        SELECT
            *
        FROM
            `testimonial`
        WHERE
            `Id` = ?";

        // Requête paramétrée – ? est determiné dynamiquement
        return $database->queryOne($sql, [$id]);
    }

    //---------------------------------CREATE----------------------------------

    // Insertion d'un nouvel élement à la table de commentaires — les arguments de la fonction correspondent aux noms des colonnes
    public function insertTestimonial($firstname, $lastname, $comment, $photo)
    {
        $database = new Database();

        $sql = 'INSERT INTO testimonial
        (
            FirstName,
            LastName,
            Comment,
            Photo
        ) VALUES (?, ?, ?, ?)';

        $database->executeSql(
            $sql,
            [
                $firstname,
                $lastname,
                $comment,
                $photo
            ]
        );
    }


    //-------------------------------UPDATE------------------------------------
    public function updatTestimonial($id, $firstname, $lastname, $comment, $photo)
    {
        $database = new Database();

        $sql = 'UPDATE `menu`
    SET `FirstName` = ?,
    `LastName` = ?, 
    `Comment` = ?,
    `Photo` = ?,
    WHERE `Id` = ?';

        $database->executeSql($sql, [$firstname, $lastname, $comment, $photo, $id]);
    }



    //-------------------------------DELETE-----------------------------------
    public function deleteTestimonial(array $testimonials)
    {
        $database = new Database();

        foreach ($testimonials as $testimonial) {
            $sql = 'DELETE FROM `testimonial` WHERE `Id` = ?';

            $database->executeSql($sql, [$testimonial['Id']]);
        }
    }
}
