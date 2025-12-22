<?php
namespace App\Controllers;
use Throwable;
use App\Models\Logout;



class LogoutController{

    public function __construct()
    {


    }
    
    public function logout()
    {
        $logout = new Logout();
        $logout->logout();

        header("Location: /DungeonXplorer");
        exit;

    }
}