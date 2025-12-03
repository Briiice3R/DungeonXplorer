<?php
namespace App\Controllers;
use Throwable;
use App\Models\Register;



class SignUpController{

    public function __construct()
    {
        

    }
    
    public function register()
    {
        $reg = new Register();
        $retour = $reg->register();
        if($retour==0){
            include __DIR__ . "/../../resources/views/HomePage.php";
        } else {
            switch($retour){
                case "2":
                    $_SESSION["alreadyUsedUsername"]="True";
                    
                case "3":
                    $_SESSION["alreadyUsedUsername"]="True";

                case "4":
                    $_SESSION["alreadyUsedUsername"]="True";
                    $_SESSION["alreadyUsedUsername"]="True";
            include __DIR__ . "/../../resources/views/SignUpPage.php";
        }
        }
        
    }

    public function index()
    {
        include __DIR__ . "/../../resources/views/SignUpPage.php";
    }
}