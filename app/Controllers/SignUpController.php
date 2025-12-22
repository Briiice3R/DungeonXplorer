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
        switch($retour){
            case -1:
                $_SESSION["registrationError"]=true;
                header("Location: /signup");
                exit;
                break;
            case -2:
                $_SESSION["alreadyUsedUsername"]=true;
                $_SESSION["alreadyUsedEmail"]=false;
                header("Location: /DungeonXplorer/signup");
                exit;
                break;
            case -3:
                $_SESSION["alreadyUsedUsername"]=false;
                $_SESSION["alreadyUsedEmail"]=true;
                header("Location: /DungeonXplorer/signup");
                exit;
                break;
            case -4:
                $_SESSION["alreadyUsedEmail"]=true;
                $_SESSION["alreadyUsedUsername"]=true;
                header("Location: /DungeonXplorer/signup");
                exit;
                break;
            default:
                $_SESSION["alreadyUsedUsername"]=false;
                $_SESSION["alreadyUsedEmail"]=false;
                $_SESSION["registrationError"]=false;
                $_SESSION["userID"]=$retour;
                header("Location: /DungeonXplorer");
                exit;
                break;
            }
        
        
    }

    public function index(){
        if (isset($_SESSION["userId"]) && !empty($_SESSION["userId"])) {
            header("Location: /DungeonXplorer");
            exit;
        } else {
            include __DIR__ . "/../../resources/views/SignUpPage.php";
        }
    }
}