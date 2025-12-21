<?php
namespace App\Controllers;
use Throwable;
use App\Models\Reset;




class ResetController{

    public function __construct()
    {

    }
    
    public function reset()
    {
        $reset = new Reset();
        $retour = $reset->send_email();
        if($retour==1){
            $_SESSION["resetError"]=True;
            header("Location: /DungeonXplorer/forgotPassword");
            exit;

        } else {
            $_SESSION["resetError"]=False;
            header("Location: /DungeonXplorer/checkResetPassword");
            exit;
        }

        
        
        
    }

    public function index1(){
        if (isset($_SESSION["userId"]) && !empty($_SESSION["userId"])) {
            header("Location: /DungeonXplorer");
            exit;
        } else {
            include __DIR__ . "/../../resources/views/ForgotPasswordPage.php";
        }
    }
    public function index2(){
        if (isset($_SESSION["userId"]) && !empty($_SESSION["userId"])) {
            header("Location: /DungeonXplorer");
            exit;
        } else {
            include __DIR__ . "/../../resources/views/CheckCodeResetPasswordPage.php";
        }
    }
}