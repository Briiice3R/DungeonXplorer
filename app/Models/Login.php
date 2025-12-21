<?php
namespace app\Models;
use App\Core\Database;
use App\Utils\SessionInitializer;


class Login{
    function login(){ 
        /* Retourne:
         * l'identifiant de l'utilisateur si tout c'est bien passé,
         * -1 si des données sont invalides,
         * -2 si le nom d'utilisateur et/ou le mot de passe sont incorrectes
         */
        
        $username = trim($_POST["username"]);
        $password = $_POST["password"];

        if($username=="" || $password==""){
            return -1;
        }

        $req_verif = Database::getInstance()->prepare("SELECT password FROM User WHERE username=:username");
        $req_verif->bindParam(':username', $username);
        $req_verif->execute();

        $passwordInBDD = $req_verif->fetchColumn();
        if($passwordInBDD!==false){
            if(password_verify($password,$passwordInBDD)){
                $req_id = Database::getInstance()->prepare("SELECT id FROM User WHERE username=:username");
                $req_id->bindParam(':username', $username);
                $req_id->execute();
                $user_id = $req_id->fetchColumn();
                return $user_id;
            } else {
                return -2;
            }
        } else {
            return -2;
        }
    }
}
?>