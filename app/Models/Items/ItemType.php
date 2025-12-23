<?php

namespace App\Models\Items;
use App\Core\Database;
class ItemType{
    private ?int $id = null;
    private string $category;

    public const WEAPON = "Arme";
    public const ARMOR = "Armure";
    public const POTION = "Potion";

    public function __construct(
        $id,
        $category,
    )
    {
        $this->id = $id;
        $this->category = $category;
    }

    public function save(){
        $db = Database::getInstance();
        if($this->id === null){
            $stmt = $db->prepare("INSERT INTO Item_type (category) VALUES (:category)");
            $this->id = $db->lastInsertId();
            $stmt->execute([
                ':category' => $this->category
            ]);
        } else {
            $stmt = $db->prepare("UPDATE item_type SET category = :category WHERE id = :id");
            $stmt->execute([
                ':category' => $this->category,
                ':id' => $this->id
            ]);
        }
    }

    public static function find($id): ?ItemType{
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM item_type WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();
        if(!$data){
            return null;
        }
        return new ItemType(
            $data['id'],
            $data['category']
        );

    }

    public function getId(): ?int{
        return $this->id;
    }
    public function getCategory(): string{
        return $this->category;
    }
}