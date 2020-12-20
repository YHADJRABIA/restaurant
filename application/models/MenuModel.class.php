<?php
/* Model d'intéraction avec la table « menu » de la base de données, contenant les méthodes CRUD.
En notant que les méthodes Create, Update et Delete ne sont accessibles que par l'administrateur du site, pas de risques d'injection SQL donc
*/
class MenuModel
{

    //---------------------------------READ----------------------------------
    // Récupère l'intégralité du contenu de la table « menu »
    public function getAllMenuItems()
    {
        // Appel de la classe de base de données
        $database = new Database();

        // Formulation de la requête SQL
        $sql = "
        SELECT 
            *
        FROM
            `menu`";

        // Retourne les données récupérées depuis la base de données resultants de l'execution de la requête
        return $menuItems = $database->query($sql);
    }

    // Récupère le membre du personnel dont l'id est determiné par l'utilisateur final
    public function getMenuItemById($id)
    {
        $database = new Database();

        $sql = "
        SELECT
            *
        FROM
            `menu`
        WHERE
            `Id` = ?";

        // Requête paramétrée – ? est determiné dynamiquement
        return $database->queryOne($sql, [$id]);
    }

    //---------------------------------CREATE----------------------------------

    // Insertion d'un nouvel élement au menu — les arguments de la fonction correspondent aux noms des colonnes
    public function insertMenuItem($name, $price, $photo)
    {
        $database = new Database();

        $sql = 'INSERT INTO menu
        (
            `Name`,
            `Price`,
            `Photo`
            
        ) VALUES (?, ?, ?)';

        $database->executeSql(
            $sql,
            [
                $name,
                $price,
                $photo
            ]
        );
        $flashBag = new FlashBag();
        $flashBag->add('Menu item successfully added (bottom of the table)');
    }


    //-------------------------------UPDATE------------------------------------
    public function updateMenuItemById($name, $price, $id)
    {
        $database = new Database();

        $sql = 'UPDATE `menu`
    SET `Name` = ?, `Price` = ?
    WHERE `Id` = ?';

        $database->executeSql($sql, [$name, $price, $id]);
    }



    //-------------------------------DELETE-----------------------------------
    public function deleteMenuItemById($id)
    {
        $database = new Database();

        $sql = 'DELETE FROM `menu` WHERE `Id` = ?';

        return $database->executeSql($sql, [$id]);
    }
}
