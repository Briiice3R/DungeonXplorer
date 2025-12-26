<?php
namespace App\Controllers;

use App\Models\Monsters\Monster;
use App\Models\Chapters\Chapter;
use App\Models\Heroes\Hero;
use App\Models\Items\Inventory;
use App\Models\Item\Potion;
use App\Models\Item\Weapon;
use App\Models\Item\Armor;
use App\Models\Item\InventorySlot;
use App\Models\Level;
use App\Models\Spell;
use App\Models\Chapters\ChapterChoice;

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
        $poisoningSpell = Spell::find(1);
        $careSpell = Spell::find(5);
        $strengthSpell = Spell::find(2);
        $manaSpell = Spell::find(4);

        $stmt = $db->prepare("SELECT to_chapter_id from Chapter_Choice WHERE from_chapter_id = :chapter AND to_chapter_id = 10 Or to_chapter_id = 19 Or to_chapter_id = 36 Or to_chapter_id = 59 Or to_chapter_id = 79");
        $stmt->execute([':chapter' => $idChapitre]);
        $deathChapter = $stmt->fetchColumn();
        $stmt = $db->prepare("SELECT to_chapter_id from Chapter_Choice WHERE from_chapter_id = :chapter AND to_chapter_id <> 10 Or to_chapter_id <> 19 Or to_chapter_id <> 36 Or to_chapter_id <> 59 Or to_chapter_id <> 79");
        $stmt->execute([':chapter' => $idChapitre]);
        $afterChapter = $stmt->fetchColumn();
        
        if ($hero == null || $monster == null) {
            die("Héros ou Monstre introuvable !");
        }

        // Préparer les données pour JavaScript
        $heroData = $this->prepareHeroData($hero);
        $monsterData = $this->prepareMonsterData($monster);
        $poisoningSpellData = $this->prepareSpellData($poisoningSpell);
        $careSpellData = $this->prepareSpellData($careSpell);
        $strengthSpellData = $this->prepareSpellData($strengthSpell);
        $manaSpellData = $this->prepareSpellData($manaSpell);
        $afterChapterData = $this->prepareAfterChapter($afterChapter);
        $deathChapterData = $this->prepareAfterChapter($deathChapter);

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
                'type' => $item->getItemType()->getCategory(),
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

    private function prepareAfterChapter($chapterid){
        return[
            'id' => $chapterid,
            

        ];
        
    }

    private function prepareSpellData(Spell $spell){
        return [
            'id' => $spell->getId(),
            'name'=> $spell->getName(),
            'description' => $spell->getDescription(),
            'manaCost' => $spell->getManaCost(),
            'effect'=> $spell->getEffect()
        ];
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