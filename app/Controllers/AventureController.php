<?php
namespace App\Controllers;

class AventureController
{
    
    public function __construct()
    {
        

    }

    public function create()
    {
        include __DIR__ . "/../../resources/views/AventureCreate.php";
    }

    public function index()
    {
        include __DIR__ . "/../../resources/views/AventureAccueil.php";
    }
}
