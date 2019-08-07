<?php

namespace App\Controller;

use \Core\Controller\Controller;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->loadModel('userInfos');
    }

    public function Infos()
    {
        return $this->render('users/profil');
    }
}