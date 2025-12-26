<?php
namespace App\Controllers;
use App\Models\Chapters\Chapter;
use App\Models\Heroes\Hero;

class ChapterController
{
    public function show($id) {
        $chapter = Chapter::find($id); 
        $heroId = $_SESSION['active_hero_id'] ?? null; 

        if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
            header("Location: /DungeonXplorer/login");
            exit();
        }

        $hero = Hero::find($heroId);

        if ($chapter && $hero) {
            $db = \App\Core\Database::getInstance();
        
            // Mise à jour de la progression
            $stmt = $db->prepare("UPDATE Progression 
                SET chapter_id = :chapter, 
                    start_date = NOW() 
                WHERE hero_id = :hero");
            $stmt->execute([':chapter' => $id, ':hero' => $heroId]);

            // 2. LOGIQUE DE RÉCUPÉRATION VIA SESSION (Sans modification de colonne)
            // Initialisation du tableau des objets ramassés s'il n'existe pas
            if (!isset($_SESSION['collected_items_chapters'])) {
                $_SESSION['collected_items_chapters'] = [];
            }

            // On vérifie s'il y a un item ET que ce n'est PAS un combat
            if ($chapter->getMonsterId() == -1 && $chapter->getItemId() !== null) {
                
                // On vérifie si ce chapitre n'est pas déjà dans la liste des objets ramassés
                if (!in_array($id, $_SESSION['collected_items_chapters'])) {
                    
                    // Ajout de l'objet à l'inventaire
                    $hero->getInventoryItems()->addItem($chapter->getItemId(), 1);
                    
                    // On ajoute l'ID du chapitre à la liste pour ne plus le ramasser
                    $_SESSION['collected_items_chapters'][] = $id;
                    
                    // On prépare le message pour la vue
                    $_SESSION['flash_item_collected'] = true;
                }
            }

            include __DIR__ .'/../../resources/views/ChapterPage.php'; 
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé !";
        }
    }

    public function resume($heroId, $chapterId) {
        $_SESSION['active_hero_id'] = $heroId;
        header("Location: /DungeonXplorer/chapter/" . $chapterId);
        exit();
    }
}