<?php
namespace App\Controllers;

class AventureController
{
    private $heroType = [];

    public function __construct()
    {
        

    }

    public function create($id)
    {
        $heroType = $this->getHeroType($id);

        if ($heroType) {
            include __DIR__ . "/../../resources/views/AventureCreate.php";
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Héro non trouvé!";
        }
    }

    public function getHeroType($id) {
        foreach ($this->heroType as $heroType) {
            if ($heroType->getId() == $id) {
                return $heroType;
            }
        }
        return null;
    }

    public function index()
    {
        include __DIR__ . "/../../resources/views/AventureAccueil.php";
    }
}
