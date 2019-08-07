<?php

namespace App\Model\Table;

use \Core\Model\Table;

class HomeTable extends Table
{

    public function perso($img, $column = 'img')
        {
            return $this->query("SELECT * FROM {$this->table}  WHERE $column= ?", [$img], true);
        }

}