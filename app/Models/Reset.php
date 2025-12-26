<?php
namespace App\Models;
use App\Core\Database;

class Reset {
    function send_email() {
        /*
         * Retourne 0 si l'email n'est pas dans la base
         * Retourne 1 si les données du formulaire sont imvalides
         * Retourne 2 en cas d'erreur du curl
         * Retourne l'email initialement transmis si tout se passe bien
         */
    

        $email = trim($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email)>=255){
            return 1;
        }
        
        $req_verif = Database::getInstance()->prepare("SELECT username FROM User WHERE email=:email");
        $req_verif->bindParam(':email', $email);
        $req_verif->execute();

        $code = null;
        $username = $req_verif->fetchColumn();

        if($username != false){
            $code = random_int(100000, 999999);
            $hash = password_hash($code, PASSWORD_DEFAULT);
            $expires = date('Y-m-d H:i:s', time() + 900);
            $creation = date('Y-m-d H:i:s', time());
        
            $req_reset = Database::getInstance()->prepare("INSERT INTO Password_Resets (user_email, code_hash, expiration_date, creation_date) VALUES (:email, :code_hash, :expires, :creates) ON DUPLICATE KEY UPDATE code_hash = :code_hash, expiration_date = :expires, creation_date = :creates");
            $req_reset->bindParam(':email', $email);
            $req_reset->bindParam(':code_hash', $hash);
            $req_reset->bindParam(':expires', $expires);
            $req_reset->bindParam(':creates', $creation);
            $req_reset->execute();
        } else {
            return 0;
        }

        $envFile = __DIR__ . '/../../.env';
        if (!file_exists($envFile)) {
            die("Le fichier .env n'existe pas.");
        }
        $env = parse_ini_file($envFile);
        $apiKey = $env["RESEND_API_KEY"] ?? null;

        $data = [
            'from' => 'DungeonXplorer <onboarding@resend.dev>',
            'to' => [$email],
            'subject' => 'Code de réinitialisation',
            'html' => "<p>Bonjour $username !</p><p>Votre code : <strong>$code</strong></p><p>Valide 15 minutes.</p>"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.resend.com/emails');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if(curl_errno($ch)){
            curl_close($ch);
            return 2;
        }
        curl_close($ch);
        return $email;
    }

    function checkCode(){
        /*
        Retourne -1 si le code est incorrecte ou s'il est expiré.
        Retourne l'email si le code est juste et non expiré.
        */
        $email=$_SESSION["resetingEmail"];
        if($email!=0){
            $code = trim($_POST["code"]);
            $req_check_reset = Database::getInstance()->prepare("SELECT * FROM Password_Resets WHERE user_email=:email");
            $req_check_reset->bindParam(':email', $email);
            $req_check_reset->execute();
                
            $dataInBDD = $req_check_reset->fetch();

            if(password_verify($code,$dataInBDD["code_hash"]) && (strtotime($dataInBDD["expiration_date"])>=time())){
                return $email;
            }

        }
        return -1;
        
        
    }

    function resetPassword(){ 
        /* Retourne:
         * 0 si tout c'est bien passé,
         * -1 si des données sont invalides,
         */
        $password = $_POST["password_1"];

        if($_POST["password_1"]==$_POST["password_2"] && strlen($password)<=255){
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $req = Database::getInstance()->prepare("UPDATE User set password=:password where email=:email");
            $req->bindParam(':password',$hashPassword);
            $req->bindParam(':email',$_SESSION["resetPasswordVerifiedEmail"]);
            $req->execute();

            
            return 0;
        } else {
            return -1;
        }
    }
}
?>