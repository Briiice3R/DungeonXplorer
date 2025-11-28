<?php

/*
    - Commande à exécuter pour lancer le serveur : php -S localhost:8001
*/
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';
use Bramus\Router\Router;
// Create Router instance
$router = new Router();

// Config
$router->setNamespace("App\Controllers");
$router->set404(function(){
    echo "erreur";
});

// Routes
$router->get('/', "HomeController@index");
$router->get('/profile', "ProfileController@index");
$router->get('/updateprofile', "ProfileController@show");
$router->get('/updateprofile', "ProfileController@update");

$router->get('/chapter/{id}', "ChapterController@show");
// Run it!
$router->run();