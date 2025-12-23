<?php
namespace App\Controllers;

use App\Models\Monsters\Monster;
use App\Models\Chapters\Chapter;
use App\Models\Heroes\Hero;

class FightController
{
    public function show($idChapitre)
    {
        $hero = Hero::find(3); 
        $monster = Monster::find(1); 

        if ($hero === null || $monster === null) {
            die("Héros ou Monstre introuvable !");
        }

        
        $heroData = [
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
                'name' => $hero->getArmor()->getName(),
                'protection' => $hero->getArmor()->getProtection()
            ] : null,
            'primaryWeapon' => $hero->getPrimaryWeapon() ? [
                'name' => $hero->getPrimaryWeapon()->getName(),
                'damage' => $hero->getPrimaryWeapon()->getDamage()
            ] : null,
            'inventory' => array_map(function($slot) {
                return [
                    'item' => [
                        'id' => $slot->getItem()->getId(),
                        'name' => $slot->getItem()->getName(),
                        'type' => $slot->getItem()->getItemType()->getName()
                    ],
                    'quantity' => $slot->getQuantity()
                ];
            }, $hero->getInventoryItems()->getItems())
        ];

        $monsterData = [
            'id' => $monster->getId(),
            'name' => $monster->getName(),
            'description' => $monster->getDescription(),
            'pv' => $monster->getPv(),
            'maxPv' => $monster->getPv(),
            'mana' => $monster->getMana(),
            'strength' => $monster->getStrength(),
            'initiative' => $monster->getInitiative(),
            'dropXp' => $monster->getDropXp()
        ];

        include __DIR__ . "/../../resources/views/FightPage.php";
    }

    public function saveFightResult()
    {
        header('Content-Type: application/json');
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        $hero = Hero::find($data['heroId']);
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
?>