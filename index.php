<?php

/*
    - Commande à exécuter pour lancer le serveur : php -S localhost:8001
*/
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

session_start();


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


$router->get('/chapter/{id}', "ChapterController@show");

$router->get('/signup', "SignUpController@index");
$router->post('/signup', "SignUpController@register");
$router->get('/login', "LoginController@index");
$router->post('/login', "LoginController@login");
$router->get('/logout', "LogoutController@logout");
// Run it!
$router->run();