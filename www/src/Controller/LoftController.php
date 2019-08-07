<?php

namespace App\Controller;

use \Core\Controller\Controller;

class LoftController extends Controller
{
    public function chambre()
    {
        return $this->render('users/chambre', []);
    }
}