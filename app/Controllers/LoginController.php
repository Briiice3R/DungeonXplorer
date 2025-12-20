<?php
namespace App\Controllers;
use Throwable;
use App\Models\Register;



class SignUpController{

    public function __construct()
    {
        

    }
    
    public function login()
    {
        $reg = new Register();
        $retour = $reg->register();
        if($retour==0){
            $_SESSION["invalidUsernameNorPassword"]="False";
            include __DIR__ . "/../../resources/views/HomePage.php";
        } else {
            $_SESSION["invalidUsernameNorPassword"]="True";
            include __DIR__ . "/../../resources/views/LoginPage.php";
        }
        
    }

    public function index(){
        include __DIR__ . "/../../resources/views/LoginPage.php";
    }
}