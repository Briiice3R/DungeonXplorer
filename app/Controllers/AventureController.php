<?php
namespace App\Controllers;
use App\Models\Heroes\HeroType;

class AventureController
{
    private $heroType = [];

    public function __construct()
    {

    }

    public function create()
    {
        $heroTypeArr = HeroType::findAll();

        //Vérifie si la personne est connecté ou non
        if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
            // Si non connecté, redirection vers la page de login
            header("Location: login");
            exit();
        }

        if ($heroTypeArr) {
            include __DIR__ . "/../../resources/views/AventureCreate.php";
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Héro non trouvé!";
        }
    }


    public function index()
    {
        if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
            header("Location: login");
            exit();
        }

        include __DIR__ . "/../../resources/views/AventureAccueil.php";
    }
}
