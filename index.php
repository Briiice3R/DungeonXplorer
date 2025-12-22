<?php

session_start();
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

// --- Routes accueil ---
$router->get('/', "HomeController@index");

// --- Routes Authentification ---
$router->get('/signup', "SignUpController@index");
$router->post('/signup', "SignUpController@register");
$router->get('/login', "LoginController@index");
$router->post('/login', "LoginController@login");
$router->get('/logout', "LogoutController@logout");
// $router->get('/forgotPassword', "ResetController@index1");
// $router->post('/forgotPassword', "ResetController@reset");
// $router->get('/checkResetPassword', "ResetController@index2");

// --- Routes Aventure (Nécessitent une connexion) ---
$router->get('/aventureaccueil', "AventureController@index");
$router->get('/aventurecreate', "AventureController@create");

// --- Routes Héros ---
$router->post('/hero/create', "HeroController@create"); 
$router->get('/choix-hero', "HeroController@index");

// --- Routes Jeu ---
$router->get('/chapter/{id}', "ChapterController@show");

// --- Routes Jeu ---
$router->get('/profile/{id}',"ProfileController@index");
$router->get('/updateprofile/{id}',"ProfileController@show");
$router->post('/update/{id}',"ProfileController@update");
$router->get('/delete/{id}',"ProfileController@delete");

// Run it!
$router->run();