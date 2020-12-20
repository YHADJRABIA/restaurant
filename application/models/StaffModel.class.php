<?php
/* Model d'intéraction avec la table « staff » de la base de données, contenant les méthodes CRUD.
En notant que les méthodes Create, Update et Delete ne sont accessibles que par l'administrateur du site, pas de risques d'injection SQL donc
*/

class StaffModel
{

    //---------------------------------READ----------------------------------

    // Récupère l'intégralité du contenu de la table « staff »
    public function getAllStaffMembers()
    {
        // Appel de la classe de base de données
        $database = new Database();

        // Formulation de la requête SQL
        $sql = "
        SELECT 
            *
        FROM
            `staff`";

        // Retourne les données récupérées depuis la base de données resultants de l'execution de la requête
        return $staffMembers = $database->query($sql);
    }

    // Récupère – sans répétition – les élements la colonne « Occupation » afin de les utiliser pour le filtre d'affichage

    public function getJobCategories()
    {
        $database = new Database();

        $sql = "
        SELECT DISTINCT 
        `Category` 
        FROM 
        `staff`";

        return $jobCategories = $database->query($sql);
    }


    // Récupère le membre du personnel dont l'id est determiné par l'utilisateur final
    public function getStaffMemberById($id)
    {
        $database = new Database();

        $sql = "
        SELECT
            *
        FROM
            `staff`
        WHERE
            `Id` = ?";

        // Requête paramétrée – ? est determiné dynamiquement
        return $database->queryOne($sql, [$id]);
    }

    //---------------------------------CREATE----------------------------------


    // Insertion d'un nouveau membre du personnel — les arguments de la fonction correspondent aux noms des colonnes
    public function insertStaffMember($firstname, $lastname, $occupation, $category, $photo)
    {
        $database = new Database();

        $sql = 'INSERT INTO staff
        (
            FirstName,
            LastName,
            Occupation,
            Category,
            Photo
        ) VALUES (?, ?, ?, ?, ?)';

        $database->executeSql(
            $sql,
            [
                $firstname,
                $lastname,
                $occupation,
                $category,
                $photo
            ]
        );

        $flashBag = new FlashBag();
        $flashBag->add('Staff member successfully added (bottom of the table)');
    }

    //-------------------------------UPDATE------------------------------------
    public function updateStaffMemberById($firstname, $lastname, $occupation, $id)
    {
        $database = new Database();

        $sql = 'UPDATE `staff`
        SET `Firstname` = ?, `Lastname` = ?, `Occupation` = ?
        WHERE `Id` = ?';

        $database->executeSql($sql, [$firstname, $lastname, $occupation, $id]);
    }


    //-------------------------------DELETE-----------------------------------
    public function deleteStaffMemberById($id)
    {
        $database = new Database();


        $sql = 'DELETE FROM `staff` WHERE `Id` = ?';

        return $database->executeSql($sql, [$id]);
    }
}
