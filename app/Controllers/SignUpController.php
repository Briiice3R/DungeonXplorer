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
            $_SESSION["alreadyUsedUsername"]="False";
            $_SESSION["alreadyUsedEmail"]="False";
            $_SESSION["registrationError"]="False";
            include __DIR__ . "/../../resources/views/HomePage.php";
        } else {
            switch($retour){
                case "1":
                    $_SESSION["registrationError"]="True";
                case "2":
                    $_SESSION["alreadyUsedUsername"]="True";
                    $_SESSION["alreadyUsedEmail"]="False";

                    
                case "3":
                    $_SESSION["alreadyUsedUsername"]="False";
                    $_SESSION["alreadyUsedEmail"]="True";

                case "4":
                    $_SESSION["alreadyUsedEmail"]="True";
                    $_SESSION["alreadyUsedUsername"]="True";
            }
            include __DIR__ . "/../../resources/views/SignUpPage.php";
        }
        
    }

    public function index()
    {
        include __DIR__ . "/../../resources/views/SignUpPage.php";
    }
}