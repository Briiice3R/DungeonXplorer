<?php
namespace App\Controllers;

use App\Models\Heroes\Hero;

class InventoryController
{
    /**
     * Sauvegarde l'équipement envoyé via le popup de ChapterPage
     * Format attendu dans $_POST['equippedData'] : "Left: ID Right: ID Armor: ID"
     */
    public function saveInventory($heroId)
    {
        @session_start();
        
        if (!isset($_SESSION['userId']) || $heroId != ($_SESSION['active_hero_id'] ?? null)) {
            header("Location: /DungeonXplorer/login");
            exit();
        }

        $db = \App\Core\Database::getInstance();
        $equippedData = $_POST['equippedData'] ?? '';

        // Extraction des IDs (chiffres) ou de la valeur 'null'
        preg_match('/Left: (\d+|null)/', $equippedData, $leftMatch);
        preg_match('/Right: (\d+|null)/', $equippedData, $rightMatch);
        preg_match('/Armor: (\d+|null)/', $equippedData, $armorMatch);

        // Conversion pour la BDD
        $leftId  = (!isset($leftMatch[1]) || $leftMatch[1] === 'null')  ? null : (int)$leftMatch[1];
        $rightId = (!isset($rightMatch[1]) || $rightMatch[1] === 'null') ? null : (int)$rightMatch[1];
        $armorId = (!isset($armorMatch[1]) || $armorMatch[1] === 'null') ? null : (int)$armorMatch[1];

        try {
            // Mise à jour de la table Hero
            // Note : vérifie bien que ces noms de colonnes correspondent à ta table SQL
            $stmt = $db->prepare("UPDATE Hero SET 
                primary_weapon_id = :left, 
                secondary_weapon_id = :right, 
                armor_id = :armor 
                WHERE id = :id");
            
            $stmt->execute([
                ':left'  => $leftId,
                ':right' => $rightId,
                ':armor' => $armorId,
                ':id'    => $heroId
            ]);

            // Récupération du chapitre actuel pour rediriger l'utilisateur là où il était
            $currentChapter = $db->query("SELECT chapter_id FROM Progression WHERE hero_id = $heroId")->fetchColumn();
            
            // Redirection vers le chapitre avec un message de succès
            header("Location: /DungeonXplorer/chapter/" . ($currentChapter ?: 1) . "?success=equipok");
            exit();

        } catch (\Exception $e) {
            exit("Erreur lors de la mise à jour de l'équipement : " . $e->getMessage());
        }
    }

    /**
     * API pour sauvegarder les résultats de combat (AJAX/Fetch)
     */
    public function saveFightResult()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        
        $hero = Hero::find($data['heroId'] ?? 0);
        if (!$hero) {
            echo json_encode(['success' => false, 'message' => 'Héros introuvable']);
            return;
        }

        $hero->setPv($data['pv']);
        $hero->setMana($data['mana']);
        
        if (isset($data['xpGained'])) {
            $hero->addXp($data['xpGained']);
        }

        $hero->save();
        echo json_encode(['success' => true, 'message' => 'Combat sauvegardé']);
    }
}