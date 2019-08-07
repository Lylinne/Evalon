<?php

namespace App\Controller;

use \Core\Controller\Controller;

class EpisodeController extends Controller
{
    
    public function jouer()
    {
        return $this->render('users/episode', []);
    }
}