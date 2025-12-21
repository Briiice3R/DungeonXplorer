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
            $_SESSION["alreadyUsedUsername"]=false;
            $_SESSION["alreadyUsedEmail"]=false;
            $_SESSION["registrationError"]=false;
            header("Location: /");
            exit;
        } else {
            switch($retour){
                case 1:
                    $_SESSION["registrationError"]=true;
                    break;
                case 2:
                    $_SESSION["alreadyUsedUsername"]=true;
                    $_SESSION["alreadyUsedEmail"]=false;
                    break;
                case 3:
                    $_SESSION["alreadyUsedUsername"]=false;
                    $_SESSION["alreadyUsedEmail"]=true;
                    break;
                case 4:
                    $_SESSION["alreadyUsedEmail"]=true;
                    $_SESSION["alreadyUsedUsername"]=true;
                    break;
            }
            include __DIR__ . "/../../resources/views/SignUpPage.php";
        }
        
    }

    public function index()
    {
        include __DIR__ . "/../../resources/views/SignUpPage.php";
    }
}