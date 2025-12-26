<?php
namespace App\Controllers;

use App\Models\Monsters\Monster;
use App\Models\Chapters\Chapter;
use App\Models\Heroes\Hero;
use App\Models\Items\Inventory;
use App\Model\Item\Potion;
use App\Model\Item\Weapon;
use App\Model\Item\Armor;
use App\Model\Item\InventorySlot;
use App\Model\Level;
use App\Model\Spell;
use App\Model\Chapters\ChapterChoice;

class FightController
{
    public function show($idChapitre)
    {
        $hero = Hero::find($_SESSION['active_hero_id']);

        $db = \App\Core\Database::getInstance();
        $stmt = $db->prepare("SELECT monster_id from Chapter_Monster WHERE chapter_id = :chapter");
        $stmt->execute([':chapter' => $idChapitre]);
        $monsterId=$stmt->fetchColumn();
        
        $monster = Monster::find($monsterId); 
        
        if ($hero == null || $monster == null) {
            die("Héros ou Monstre introuvable !");
        }

        // Préparer les données pour JavaScript
        $heroData = $this->prepareHeroData($hero);
        $monsterData = $this->prepareMonsterData($monster);

        include __DIR__ . "/../../resources/views/FightPage.php";
    }

    private function prepareHeroData(Hero $hero): array
    {
        return [
            'id' => $hero->getId(),
            'name' => $hero->getName(),
            'pv' => $hero->getPv(),
            'maxPv' => $hero->getHeroType()->getMaxPv(),
            'mana' => $hero->getMana(),
            'maxMana' => $hero->getHeroType()->getMaxMana(),
            'strength' => $hero->getStrength(),
            'initiative' => $hero->getInitiative(),
            'image' => $hero->getImage(),
            'armor' => $hero->getArmor() ? [
                'id' => $hero->getArmor()->getId(),
                'name' => $hero->getArmor()->getName(),
                'protection' => $hero->getArmor()->getProtection()
            ] : null,
            'primaryWeapon' => $hero->getPrimaryWeapon() ? [
                'id' => $hero->getPrimaryWeapon()->getId(),
                'name' => $hero->getPrimaryWeapon()->getName(),
                'damage' => $hero->getPrimaryWeapon()->getDamage()
            ] : null,
            'secondaryWeapon' => $hero->getSecondaryWeapon() ? [
                'id' => $hero->getSecondaryWeapon()->getId(),
                'name' => $hero->getSecondaryWeapon()->getName(),
                'damage' => $hero->getSecondaryWeapon()->getDamage()
            ] : null,
            'inventory' => $this->prepareInventoryData($hero->getInventoryItems())
        ];
    }
    private function prepareInventoryData(Inventory $inventory): array
    {
        return array_map(function($slot) {
            $item = $slot->getItem();
            $itemData = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'description' => $item->getDescription(),
                'type' => $item->getItemType()->getName(),
                'quantity' => $slot->getQuantity()
            ];

            // Ajouter des données spécifiques selon le type d'item
            if ($item instanceof Potion) {
                $itemData['effectType'] = $item->getEffectType();
                $itemData['effectValue'] = $item->getEffectValue();
            } elseif ($item instanceof Weapon) {
                $itemData['damage'] = $item->getDamage();
            }

            return $itemData;
        }, $inventory->getItems());
    }

    /**
     * Prépare les données du monstre au format JSON
     */
    private function prepareMonsterData(Monster $monster): array
    {
        return [
            'id' => $monster->getId(),
            'name' => $monster->getName(),
            'description' => $monster->getDescription(),
            'pv' => $monster->getPv(),
            'maxPv' => $monster->getPv(),
            'mana' => $monster->getMana(),
            'maxMana' => $monster->getMana(),
            'strength' => $monster->getStrength(),
            'initiative' => $monster->getInitiative(),
            'dropXp' => $monster->getDropXp(),
            'monsterType' => [
                'id' => $monster->getMonsterType()->getId(),
                'name' => $monster->getMonsterType()->getName()
            ]
        ];
    }

    // API pour sauvegarder l'état du héros après le combat
    public function saveFightResult()
    {
        header('Content-Type: application/json');
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        $hero = Hero::find($data['heroId']);
        if (!$hero) {
            echo json_encode(['success' => false, 'message' => 'Héros introuvable']);
            return;
        }

        // Mettre à jour les stats du héros
        $hero->setPv($data['pv']);
        $hero->setMana($data['mana']);
        
        if (isset($data['xpGained'])) {
            $hero->addXp($data['xpGained']);
        }

        $hero->save();

        echo json_encode(['success' => true, 'message' => 'Combat sauvegardé']);
    }
}
?>