<?php
namespace App\Controllers;
use Src\Core\DatabaseController;
use Throwable;

class SignUpController{

    public function __construct()
    {
        

    }
    
    public function register()
    {
        $alreadyUsedEmail=0;
        $username = $_POST["username"];
        $password = $_POST["password_1"];
        $email = $_POST["email"];
    
        $req_verif_1 = DatabaseController::getInstance()->prepare("SELECT count(*) FROM DUNGEON_USER WHERE email='$email'");
        $req_verif_1->execute();
        if($req_verif_1>0){
            if($_POST["password_1"]==$_POST["password_2"]){
                $req = DatabaseController::getInstance()->prepare("INSERT INTO (username, password, email) VALUES (:username, :password, :email)");
                $req->bindParam(':username',$username);
                $req->bindParam(':password',$password);
                $req->bindParam(':email',$email);
                $req->execute();
                include __DIR__ . "/../../resources/views/HomePage.php";
            }
        } else {
            include __DIR__ . "/../../resources/views/SignUpPage.php";
        }
    }

    public function index()
    {
        include __DIR__ . "/../../resources/views/SignUpPage.php";
    }
}