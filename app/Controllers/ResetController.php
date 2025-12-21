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

        
        
        
    }

    public function index(){
        if (isset($_SESSION["userId"]) && !empty($_SESSION["userId"])) {
            header("Location: /DungeonXplorer");
            exit;
        } else {
            include __DIR__ . "/../../resources/views/ForgotPasswordPage.php";
        }
    }
}