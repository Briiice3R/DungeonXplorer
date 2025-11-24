<?php
namespace App\Controllers;
class SignUpController{
    public function __construct()
    {
        

    }
    
    public function index()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            include __DIR__ . "/../../resources/views/HomePage.php";
        } else{

            include __DIR__ . "/../../resources/views/SignUpPage.php";
        }
    }
}