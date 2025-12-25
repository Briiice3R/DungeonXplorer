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
$router->get('/forgotPassword', "ResetController@index1");
$router->post('/forgotPassword', "ResetController@reset");
$router->get('/checkResetPassword', "ResetController@index2");

// --- Routes Authentification Admin ---
$router->get('/admin/dashboard', 'AdminController@index');
$router->get('/admin/delete/{type}/{id}', 'AdminController@deleteContent');
$router->get('/admin/forge/data/{type}/{id}', 'AdminController@getForgeData');
$router->post('/admin/forge/update/{type}/{id}', 'AdminController@updateContent');
$router->post('/admin/forge/add/{type}', 'AdminController@addContent');
$router->get('/admin/delete/image/{filename}', 'AdminController@deleteImage');

// --- Routes Aventure (Nécessitent une connexion) ---
$router->get('/aventureaccueil', "AventureController@index");
$router->get('/aventurecreate', "AventureController@create");

// --- Routes Héros ---
$router->post('/hero/create', "HeroController@create"); 
$router->get('/choix-hero', "HeroController@index");
$router->get('/hero/delete/{id}', 'HeroController@deleteAdventure');

// --- Route pour reprendre une aventure spécifique ---
$router->get('/chapter/reprendre/{heroId}/{chapterId}', 'ChapterController@resume');

// --- Routes Jeu ---
$router->get('/chapter/{id}', "ChapterController@show");
$router->get('/fight/{id}', "FightController@show");

// --- Routes Jeu ---
$router->get('/profile/{id}',"ProfileController@index");
$router->get('/updateprofile/{id}',"ProfileController@show");
$router->post('/update/{id}',"ProfileController@update");
$router->get('/delete/{id}',"ProfileController@delete");

// Run it!
$router->run();