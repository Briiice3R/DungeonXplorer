<?php
namespace App\Controllers;
use App\Models\Chapters\Chapter;

class ChapterController
{
    public function show($id) {
        $chapter = Chapter::find($id); // On cherche le chapitre directement en BDD via le modèle
        $heroId = $_SESSION['active_hero_id'] ?? null; // L'ID du héros choisi au début

        if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
            header("Location: login");
            exit();
        }

        if ($chapter && $heroId) {
            $db = \App\Core\Database::getInstance();
        
            // On fait uniquement un UPDATE car la ligne a été créée par le HeroController
            // ou par la méthode resume() lors de la reprise
            $stmt = $db->prepare("UPDATE Progression 
                SET chapter_id = :chapter, 
                    start_date = NOW() 
                WHERE hero_id = :hero");
            $stmt->execute([':chapter' => $id, ':hero' => $heroId]);
            // Charge la vue pour le chapitre
            include __DIR__ .'/../../resources/views/ChapterPage.php'; 
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé dans la base de données !";
        }
    }

    public function resume($heroId, $chapterId) {
        // 1. On stocke l'ID du héros dans la session pour que le jeu sache qui joue
        $_SESSION['active_hero_id'] = $heroId;

        // 2. On redirige immédiatement vers la page du chapitre sauvegardé
        header("Location: /DungeonXplorer/chapter/" . $chapterId);
        exit();
    }

}