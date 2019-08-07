<?php

namespace App\Controller;

use \Core\Controller\Controller;
use \Core\Controller\FormController;

class UserController extends Controller
{
    private $password;
    private $name;
    private $verify;

    public function __construct()
    {
        $this->loadModel('user');
        
    }

    public function login()
    {
        $form = new FormController();
        $form->field('name', ["require"])
            ->field('password', ["require"]);
        $errors =  $form->hasErrors();
        //verifier si post
        if (!isset($errors["user"])) {
            $datas = $form->getDatas();
            //verifier si erreurs
            if (empty($errors)) {
                //verifier que user existe
                //verifier que user et password
                $user = $this->user->getUser($datas["name"], $datas["password"]);
                if ($user) {
                    // machin connecter
                    // message bien connecter
                    // machin redirection
                    $this->flash()->addSuccess("le POST est super top");
                } else {
                    $this->flash()->addAlert("pas cool");
                }
            } else {
                $this->flash()->addAlert("appprend a remplir un formulaire");
            }
            unset($datas['password']);
        }

        return $this->render('users/login', compact("datas"));
    }
}