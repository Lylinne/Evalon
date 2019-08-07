<?php

namespace App\Model\Table;

use \Core\Model\Table;

class UserInfosTable extends Table
{
    public function isMailExist($email, $column = 'email')
    {
        return $this->query("SELECT * FROM {$this->table}  WHERE $column= ?", [$email], true);
    }

    public function isNameExist($name, $column = 'name')
    {
        return $this->query("SELECT * FROM {$this->table}  WHERE $column= ?", [$name], true);
    }

    public function connect($arrayUserInfos)
    {
        return $this->query("INSERT INTO user_infos (name=?, email=?, password=?, token = ?, created_at = ?)
                            VALUES( :name,
                                    :email,
                                    :password,
                                    :token,
                                    :created_at)", $arrayUserInfos);
                                    
    }

    public function getCreatedAt()
    {
        return ($this->created_at->format('Y-m-d H:i:s'));
    }

    //:boolean|void
    public function usersConnect($email){

        return $this->query("SELECT * FROM user_infos WHERE `email`= ?", [$email]);
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    
}