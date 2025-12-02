<?php
namespace App\Controllers;
use App\Models\Heroes\HeroType;

class AventureController
{
    private $heroType = [];

    public function __construct()
    {
        // Exemple de héro avec des images
        $this->heroType[] = new HeroType(
            1,
            "Guerrier",
            "/resources/images/Evilwarrior.jpg",
            "Voici un guerrier fort !",
            200,
            400,
            50,
            10,
            10
            );

        $this->heroType[] = new HeroType(
            2,
            "Sorcière",
            "/resources/images/Wizard.jpg",
            "Voici un sorcier fort !",
            150,
            500,
            20,
            10,
            20
        ); 
    }

    public function create()
    {
        $heroTypeArr = HeroType::findAll();

        if ($heroTypeArr) {
            include __DIR__ . "/../../resources/views/AventureCreate.php";
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Héro non trouvé!";
        }
    }


    public function index()
    {
        include __DIR__ . "/../../resources/views/AventureAccueil.php";
    }
}
