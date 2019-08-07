<?php

namespace App\Model\Table;

use \Core\Model\Table;

class UserTable extends Table
{
    public function login($dbuser, $dbpassword, $dbhost, $dbname)
    {
        $sql = "SELECT * FROM user_infos WHERE `name`= ?";
        $pdo = getDB($dbuser, $dbpassword, $dbhost,$dbname);
        $statement = $pdo->prepare($sql);
        $statement->execute(
            [
                htmlspecialchars($_POST["name"])
            ]
            );
            $user = $statement->fetch();
    }
}