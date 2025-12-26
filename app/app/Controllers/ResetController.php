<?php
namespace App\Controllers;
use Throwable;
use App\Models\Reset;




class ResetController{

    public function __construct()
    {

    }
    
    public function reset(){
        $reset = new Reset();
        $retour = $reset->send_email();
        if($retour==1 || $retour==2){
            $_SESSION["resetError"]=True;
            $_SESSION["resetingEmail"]="";
            header("Location: /DungeonXplorer/forgotPassword");
            exit;

        } else {
            $_SESSION["resetError"]=False;
            $_SESSION["resetingEmail"]=$retour;
            header("Location: /DungeonXplorer/checkResetPassword");
            exit;
        }
    }

    public function checkResetCode(){
        $reset = new Reset();
        $retour = $reset->checkCode();
        if($retour==-1){
            $_SESSION["incorrectCode"]=True;
            header("Location: /DungeonXplorer/checkResetPassword");
            exit;
        } else {
            $_SESSION["incorrectCode"]=false;
            $_SESSION["resetPasswordVerifiedEmail"]=$retour;
            header("Location: /DungeonXplorer/resetPassword");
            exit;
        }

    }

    public function resetPassword(){
        $reset = new Reset();
        $retour = $reset->resetPassword();
        if($retour==-1){
            $_SESSION["registerNewPasswordError"]=True;
            header("Location: /DungeonXplorer/resetPassword");
            exit;
        } else {
            $_SESSION["registerNewPasswordError"]=false;
            $_SESSION["resetPasswordVerifiedEmail"]="";
            $_SESSION["resetingEmail"]="";
            header("Location: /DungeonXplorer/login");
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
        if ((isset($_SESSION["userId"]) && !empty($_SESSION["userId"])) || (!isset($_SESSION["resetingEmail"])) || $_SESSION["resetingEmail"]=="") {
            header("Location: /DungeonXplorer");
            exit;
        } else {
            include __DIR__ . "/../../resources/views/CheckCodeResetPasswordPage.php";
        }
    }
    public function index3(){
        if ((isset($_SESSION["userId"]) && !empty($_SESSION["userId"])) || (!isset($_SESSION["resetPasswordVerifiedEmail"])) || $_SESSION["resetPasswordVerifiedEmail"]=="") {
            header("Location: /DungeonXplorer");
            exit;
        } else {
            include __DIR__ . "/../../resources/views/ResetPasswordPage.php";
        }
    }
}