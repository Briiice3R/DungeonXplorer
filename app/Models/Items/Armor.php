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
        $protection
    ) {
        parent::__construct($id, $name, $description, new ItemType(null, ItemType::ARMOR));
        $this->protection = $protection;
    }

    public function save(){
        parent::save();
        $db = Database::getInstance();
        if($this->id === null){
            $stmt = $db->prepare("INSERT INTO Armor (item_id, protection) VALUES (:item_id, :protection)");
            $this->id = $db->lastInsertId();
            $stmt->execute([
                ':protection' => $this->protection
            ]);
        } else{
            $stmt = $db->prepare("UPDATE Armor SET protection = :protection WHERE item_id = :item_id");
            $stmt->execute([
                ':item_id' => $this->id,
                ':protection' => $this->protection
            ]);
        }
    }

    public static function find($id): ?Armor {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT i.id, i.name, i.description, a.protection FROM item i JOIN Armor a ON i.id = a.item_id WHERE i.id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        if (!$result) {
            return null;
        }
        return new Armor(
            $result['id'],
            $result['name'],
            $result['description'],
            $result['protection']
        );
    }


    public function getProtection(): float {
        return $this->protection;
    }
}