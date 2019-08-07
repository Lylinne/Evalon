<?php

namespace App\Controller;

use \Core\Controller\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->loadModel('user');
        $this->loadModel('crush');
    }

    public function all()
    {
        echo $this->crush->perso($img, $column = 'img');

        return $this->render('post/all', []);
    }
}
