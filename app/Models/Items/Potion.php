<?php

namespace App\Models\Items;
use App\Core\Database;
class Potion extends Item
{
    private string $effectType;
    private float $effectValue;
    public function __construct(
        $id,
        $name,
        $description,
        $itemType,
        $effectType,
        $effectValue
    )
    {
        parent::__construct($id, $name, $description, new ItemType(null, ItemType::POTION));
        $this->effectType = $effectType;
        $this->effectValue = $effectValue;
    }

    public function save(){
        parent::save();
        $pdo = Database::getInstance();
        if($this->id === null){
            $stmt = $pdo->prepare("INSERT INTO potion (item_id, effect_type, effect_value) VALUES (:effect_type, :effect_value)");
            $this->id = $pdo->lastInsertId();
            $stmt->execute([
                ':effect_type' => $this->effectType,
                ':effect_value' => $this->effectValue
            ]);
        } else{
            $stmt = $pdo->prepare("UPDATE potion SET effect_type = :effect_type, effect_value = :effect_value WHERE item_id = :item_id");
            $stmt->execute([
                ':effect_type' => $this->effectType,
                ':effect_value' => $this->effectValue,
                ':item_id' => $this->id
            ]);
        }
    }

    public static function find($id):?Potion{
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT i.id, i.name, i.description, p.effect_type, p.effect_value 
                               FROM item i 
                               JOIN potion p ON i.id = p.item_id 
                               WHERE i.id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        if(!$result){
            return null;
        }
        return new Potion(
            $result['id'],
            $result['name'],
            $result['description'],
            new ItemType(null, ItemType::POTION),
            $result['effect_type'],
            $result['effect_value']
        );
    }

    public function getEffectType(): string {
        return $this->effectType;
    }
    public function getEffectValue(): float {
        return $this->effectValue;
    }
}