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

        // On récupère les héros de l'utilisateur qui ont une progression
        $userId = $_SESSION['userId'];
        $db = \App\Core\Database::getInstance();
        
        // Jointure pour avoir le nom du héros et son chapitre actuel
        $stmt = $db->prepare("SELECT h.id, h.name, h.image AS hero_img, p.chapter_id, p.start_date, c.title AS chapter_title 
            FROM Hero h
            JOIN Progression p ON h.id = p.hero_id
            JOIN Chapter c ON p.chapter_id = c.id
            WHERE h.user_id = :u
            ORDER BY p.start_date DESC");
        $stmt->execute([':u' => $userId]);
        $ongoingAdventures = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        include __DIR__ . "/../../resources/views/AventureAccueil.php";
    }
}
