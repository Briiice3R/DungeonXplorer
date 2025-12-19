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
$router->get('/profile/{id}', "ProfileController@index");
$router->get('/updateprofile/{id}', "ProfileController@show");
$router->post('/update/{id}', "ProfileController@update");
$router->get('/delete/{id}', "ProfileController@delete");
$router->get('/chapter/{id}', "ChapterController@show");
// Run it!
$router->run();