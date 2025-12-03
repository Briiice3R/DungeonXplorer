<?php
namespace app\Models;
use App\Core\Database;
use App\Utils\SessionInitializer;


class Register{
    function register(){ 
        /* Retourne:
         * 0 si tout c'est bien passé,
         * 1 si des données sont invalides,
         * 2 si le nom d'utilisateur est déjà utilisé,
         * 3 si l'adresse mail est déjà utilisé,
         * 4 si l'adresse mail et le nom d'utilisateur sont déjà utilisé.
         */
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
        } else {
            $alreadyUsedEmail=1;
        }
        if($req_verif_2->fetchColumn()<1){
            $alreadyUsedUsername=0;
        } else {
            $alreadyUsedUsername=1;
        }
        if($alreadyUsedUsername==1 && $alreadyUsedEmail==1){
            return 4;
        }
        if($alreadyUsedEmail==1){
            return 3;
        }
        if($alreadyUsedUsername==1){
            return 2;
        }


        if($_POST["password_1"]==$_POST["password_2"] && $username!="" && $password!="" && $email!="" && ($genre=="H"||$genre=="F"||$genre=="A") && /*preg_match($regex_email, $email)*/filter_var($email, FILTER_VALIDATE_EMAIL)){
            $req = Database::getInstance()->prepare("INSERT INTO user_dungeon (username, password, email, gender, admin) VALUES (:username, :password, :email, :gender, 0)");
            $req->bindParam(':username',$username);
            $req->bindParam(':password',$password);
            $req->bindParam(':email',$email);
            $req->bindParam(':gender',$genre);
            $req->execute();
            $_SESSION["alreadyUsedEmail"]="False";
            $_SESSION["alreadyUsedUsername"]="False";
            
            return 0;
        } else {
            return 1;
        }
    }
}
?>