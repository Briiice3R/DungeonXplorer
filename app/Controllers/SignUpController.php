<?php
namespace App\Controllers;
use App\Core\Database;
use App\Utils\SessionInitializer;
use Throwable;



class SignUpController{

    public function __construct()
    {
        

    }
    
    public function register()
    {
        $alreadyUsedEmail=0;
        $alreadyUsedUsername=0;
        $username = trim($_POST["username"]);
        $password = $_POST["password_1"];
        $email = trim($_POST["email"]);
        $genre = $_POST["genre"];

        $regex_email = "/^(?=.{1,254}$)(?=^[^@]{1,64}@)(?:\"(?:\\\\.|[^\"\\\\])*\"|[A-Za-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[A-Za-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*)@(?:[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?)(?:\\.(?:[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?))*$/";
    
        $req_verif_1 = Database::getInstance()->prepare("SELECT count(*) FROM user_dungeon WHERE email='$email'");
        $req_verif_1->execute();
        $req_verif_2 = Database::getInstance()->prepare("SELECT count(*) FROM user_dungeon WHERE username='$username'");
        $req_verif_2->execute();
        if($req_verif_1->fetchColumn()<1){
            $alreadyUsedEmail=0;
            $_SESSION["alreadyUsedEmail"]="False";
        } else {
            $alreadyUsedEmail=1;
            $_SESSION["alreadyUsedEmail"]="True";
        }
        if($req_verif_2->fetchColumn()<1){
            $alreadyUsedUsername=0;
            $_SESSION["alreadyUsedUsername"]="False";
        } else {
            $alreadyUsedUsername=1;
            $_SESSION["alreadyUsedUsername"]="True";
        }


        if($alreadyUsedEmail!=1 && $alreadyUsedUsername!=1 && $username!="" && $password!="" && $email!="" && ($genre=="H"||$genre=="F"||$genre=="A") && preg_match($regex_email, $email)){
            if($_POST["password_1"]==$_POST["password_2"]){
                $req = Database::getInstance()->prepare("INSERT INTO user_dungeon (username, password, email, gender, admin) VALUES (:username, :password, :email, :gender, 0)");
                $req->bindParam(':username',$username);
                $req->bindParam(':password',$password);
                $req->bindParam(':email',$email);
                $req->bindParam(':gender',$genre);
                $req->execute();
                $_SESSION["alreadyUsedEmail"]="False";
                $_SESSION["alreadyUsedUsername"]="False";
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