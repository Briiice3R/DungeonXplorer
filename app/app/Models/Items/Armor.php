<?php

namespace App\Models\Items;

use App\Core\Database;

class Armor extends Item
{
    private float $protection;

    public function __construct(
        $id,
        $name,
        $description,
        $protection,
        $maxStackSize = 1
    ) {
        parent::__construct(
            $id, 
            $name, 
            $description, 
            $maxStackSize, 
            new ItemType(null, ItemType::ARMOR)
        );
        $this->protection = $protection;
    }

    public function save() {
        parent::save();
        $db = Database::getInstance();
        
        $check = $db->prepare("SELECT COUNT(*) FROM Armor WHERE item_id = :id");
        $check->execute([':id' => $this->id]);
        
        if ($check->fetchColumn() == 0) {
            $stmt = $db->prepare("INSERT INTO Armor (item_id, protection) VALUES (:item_id, :protection)");
            $stmt->execute([
                ':item_id' => $this->id,
                ':protection' => $this->protection
            ]);
        } else {
            $stmt = $db->prepare("UPDATE Armor SET protection = :protection WHERE item_id = :item_id");
            $stmt->execute([
                ':item_id' => $this->id,
                ':protection' => $this->protection
            ]);
        }
    }

    public static function find($id): ?Armor {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT i.id, i.name, i.description, i.max_stack_size, a.protection 
                               FROM Item i 
                               JOIN Armor a ON i.id = a.item_id 
                               WHERE i.id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Armor(
            $result['id'],
            $result['name'],
            $result['description'],
            $result['protection'],
            $result['max_stack_size'] ?? 1
        );
    }

    public function getProtection(): float {
        return $this->protection;
    }
}