<?php
namespace App\Controllers;
use App\Core\Database;
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
    
        $req_verif_1 = Database::getInstance()->prepare("SELECT count(*) FROM user_dungeon WHERE email='$email'");
        $req_verif_1->execute();
        if($req_verif_1->fetchColumn()<1){
            if($_POST["password_1"]==$_POST["password_2"]){
                $req = Database::getInstance()->prepare("INSERT INTO user_dungeon (username, password, email, admin) VALUES (:username, :password, :email, 0)");
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