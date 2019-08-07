<?php
$basePath = dirname(__dir__) . DIRECTORY_SEPARATOR;

require_once $basePath . 'vendor/autoload.php';

$app = App\App::getInstance();
$app->setStartTime();
$app::load();

$app->getRouter($basePath)
    ->get('/', 'Home#all', 'home')
    ->get('/user', 'User#login', 'userLogin')
    ->get('/subscrib', 'UserInfos#subscrib', 'subscrib')
    ->get('/profil', 'Profil#infos', 'profil')
    ->get('/chambre', 'Loft#chambre', 'chambre')
    ->get('/episode', 'Episode#jouer', 'episode')



    ->post('/subscrib', 'UserInfos#subscrib', 'infossubscrib')
    ->run();
