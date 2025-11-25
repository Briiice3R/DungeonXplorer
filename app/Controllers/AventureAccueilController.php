<?php
namespace App\Controllers;

class AventureAccueilController
{
    
    public function __construct()
    {
        

    }

    public function index()
    {
        include __DIR__ . "/../../resources/views/AventureAccueil.php";
    }
}
