<?php
namespace App\Controllers;
use Throwable;
use App\Models\Login;



class LoginController{

    public function __construct()
    {


    }
    
    public function login()
    {

        $login = new Login();
        $retour = $login->login();
        if($retour==-1){
            $_SESSION["invalidUsernameNorPassword"]=false;
            $_SESSION["loginError"]=true;
        } else if($retour==-2){
            $_SESSION["invalidUsernameNorPassword"]=true;
            $_SESSION["loginError"]=false;
            include __DIR__ . "/../../resources/views/LoginPage.php";
        } else {
            $_SESSION["invalidUsernameNorPassword"]=false;
            $_SESSION["loginError"]=false;
            $_SESSION["userId"]=$retour;
            header("Location: /");
            exit;
        }
    }

    public function index(){
        if (!empty($_SESSION["userId"])) {
            header("Location: /");
            exit;
        } else {
            include __DIR__ . "/../../resources/views/LoginPage.php";
        }
    }
}