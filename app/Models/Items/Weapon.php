<?php

namespace App\Models\Items;

use App\Core\Database;

class Weapon extends Item
{
    private float $damage;

    public function __construct($id, $name, $description, $damage, $maxStackSize = 1)
    {
        parent::__construct(
            $id, 
            $name, 
            $description, 
            $maxStackSize, 
            new ItemType(null, 'Arme')
        );
        
        $this->damage = $damage;
    }

    public function save() {
        parent::save();
        $pdo = Database::getInstance();

        $check = $pdo->prepare("SELECT COUNT(*) FROM Weapon WHERE item_id = :id");
        $check->execute([':id' => $this->id]);
        
        if ($check->fetchColumn() == 0) {
            $stmt = $pdo->prepare("INSERT INTO Weapon (item_id, damage) VALUES (:item_id, :damage)");
            $stmt->execute([
                ':item_id' => $this->id,
                ':damage'  => $this->damage,
            ]);
        } else {
            // UPDATE
            $stmt = $pdo->prepare("UPDATE Weapon SET damage = :damage WHERE item_id = :item_id");
            $stmt->execute([
                ':item_id' => $this->id,
                ':damage'  => $this->damage,
            ]);
        }
    }

    public static function find($id): ?Weapon {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT i.id, i.name, i.description, i.max_stack_size, w.damage 
                               FROM Item i 
                               JOIN Weapon w ON i.id = w.item_id 
                               WHERE i.id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Weapon(
            $result['id'],
            $result['name'],
            $result['description'],
            $result['damage'],
            $result['max_stack_size'] ?? 1
        );
    }

    public function getDamage(): float {
        return $this->damage;
    }
}