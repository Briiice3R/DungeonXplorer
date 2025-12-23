<?php
namespace app\Models;
use App\Core\Database;
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';


class Reset{
    function send_email(){
        /* Retourne 0 si tout vas bien
        et 1 si les données sont invalides
        */

        $email = trim($_POST["email"]);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email)>=255){
            return 1;
        }
        
        $req_verif = Database::getInstance()->prepare("SELECT count(*) FROM User WHERE email=:email");
        $req_verif->bindParam(':email', $email);
        $req_verif->execute();

        if($req_verif->fetchColumn()>0){
            $code = random_int(100000, 999999);
            $hash = password_hash($code, PASSWORD_DEFAULT);
            $expires = date('Y-m-d H:i:s', time() + 900);
        
            $req_register = Database::getInstance()->prepare("INSERT INTO Password_Resets (user_email, code_hash, expiration_date) VALUES (:email, :code_hash, :expires) ON DUPLICATE KEY UPDATE code_hash = :code_hash, expiration_date = :expires");
            $req_register->bindParam(':email', $email);
            $req_register->bindParam(':code_hash', $hash);
            $req_register->bindParam(':expires', $expires);
            $req_register->execute();
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USER');
        $mail->Password = getenv('SMTP_PASS');
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SMTPDebug = 2;


        $mail->setFrom('dungeonxplorer866@gmail.com', 'Test');
        $mail->addAddress('dungeonxplorer866@gmail.com');
        $mail->Subject = 'Test SMTP';
        $mail->Body = 'Ça marche';

        $mail->send();

        return 0;  
    }
}
?>