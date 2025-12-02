<?php

namespace App\Models\Items;
use App\Core\Database;
class Weapon extends Item
{
    private float $damage;
    public function __construct($id, $name, $description, $damage)
    {
        parent::__construct($id, $name, $description, new ItemType(null, ItemType::WEAPON));
        $this->damage = $damage;
    }
    public function save(){
        parent::save();
        $pdo = Database::getInstance();
        if($this->id === null){
            $stmt = $pdo->prepare("INSERT INTO weapon (damage) VALUES (:damage)");
            $stmt->execute([
                ':damage' => $this->damage,
            ]);
            $this->id = $pdo->lastInsertId();
        } else{
            $stmt = $pdo->prepare("UPDATE weapon SET damage = :damage WHERE item_id = :item_id");
            $stmt->execute([
                ':item_id' => $this->id,
                ':damage' => $this->damage,
            ]);
        }
    }

    public static function find($id):?Weapon{
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT i.id, i.name, i.description, w.damage 
                               FROM item i 
                               JOIN weapon w ON i.id = w.item_id 
                               WHERE i.id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        if(!$result){
            return null;
        }
        return new Weapon(
            $result['id'],
            $result['name'],
            $result['description'],
            $result['damage']
        );
    }

    public function getDamage():float{
        return $this->damage;
    }
}