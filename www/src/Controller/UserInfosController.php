<?php

namespace App\Controller;

use \Core\Controller\Controller;
use \App\Model\Table\UserInfosTable;
use \Core\Controller\MailController;
use \Core\Controller\FlashController;

class UserInfosController extends Controller
{
    public function __construct()
    {
        $this->loadModel('userInfos');
    }

    public function subscrib()
    {
        if(!empty($_POST))
        {
            extract($_POST);
            if(isset($_POST['subscrib']))
            {
                //$_POST récupère les name du formulaire
                $name            = htmlentities(trim($name));
                $email           = htmlentities(trim($email));
                $verify_mail     = htmlentities(trim($verify_mail));
                $password        = htmlentities(strtolower($password));
                $verify_password = htmlentities(strtolower($verify_password));

                if(
                    ( 	filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
                    ) &&
                    ( $_POST["password"] == $_POST["verify_password"])
                ){
                    
                    if(!empty($name && $email && $verify_mail && $password && $verify_password))
                    {   
                        //verif si les mails et les names de la db existe 
                        
                        if($this->userInfos->isNameExist($name))
                        {
                            throw new \Exception("name existe deja");
                        }
                        if($this->userInfos->ismailexist($email))
                        {
                            throw new \Exception("mail existe deja");
                        }
                        else {
                            $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT);
                            
                            $fields = [
                                "name"		=> htmlentities(trim($name)),
                                "email"	    => htmlentities(trim($email)),
                                "password"	=> htmlentities(strtolower($password)),
                                "token"     => substr(md5(uniqid()), 0, 15)
                                
                            ];
                            $result = $this->userInfos->create($fields, $class=false);
                            //$users = $this->userInfos->isMailExist($email);
                            $users = $this->userInfos->isNameExist($name);
                            
                            $this->messageFlash()->success("vous êtes bien enregistré");

                            $email = new MailController();
                            $email->object("validez votre compte")
                                ->to($users->getEmail())
                                ->message('confirmation', compact("users"))
                                ->send();
                            //informer le client qu'il va devoir valider son adresse mail
                            $this->messageFlash()->success("vous avez reçu un mail");
                            header('location: '.$this->generateUrl("userLogin"));
                            exit();
                        
                        }
                        unset($users["password"]);
                    }
                }
                /**
                * verifie que l'utilisateur est connecté
                * @return array|void
                */
                if (session_status() != PHP_SESSION_ACTIVE){
                    session_start();
                                
                }
                // est pas defini et false
                if(empty($_SESSION["auth"])){
                    if($verify){
                        return false;
                        exit();
                    }
                    header('location: /userLogin');
                    exit();
                }
                return $_SESSION["auth"];
            }        
        }
        return $this->render('users/subscrib');
    }

}