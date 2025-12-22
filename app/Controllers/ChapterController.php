<?php
namespace App\Controllers;
use App\Models\Chapters\Chapter;

class ChapterController
{
    public function show($id)
    {
        // On cherche le chapitre directement en BDD via le modèle
        $chapter = Chapter::find($id);

        if ($chapter) {
            // Charge la vue pour le chapitre
            include __DIR__ .'/../../resources/views/ChapterPage.php'; 
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé dans la base de données !";
        }
    }
}