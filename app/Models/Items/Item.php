<?php

namespace App\Models\Items;
use App\Core\Database;

class Item{
    protected ?int $id = null;
    protected string $name;
    protected string $description;
    protected int $maxStackSize;
    protected ItemType $itemType;

    public function __construct(
        $id,
        $name,
        $description,
        $maxStackSize,
        $itemType
    )
    {
        $this->id=$id;
        $this->name=$name;
        $this->description=$description;
        $this->itemType = $itemType;
        $this->maxStackSize = $maxStackSize;
    }

    public function save(){
        $pdo = Database::getInstance();
        $itemType = ItemType::find($this->itemType->getId());
        if($this->id === null){
            $stmt = $pdo->prepare("INSERT INTO item (name, description,max_stack_size, item_type_id) VALUES (:name, :description, :maxStackSize ,:item_type_id)");
            $stmt->execute([
                ':name' => $this->name,
                ':description' => $this->description,
                ':item_type_id' => $itemType,
                ':maxStackSize' => $this->maxStackSize
            ]);
            $this->id = $pdo->lastInsertId();
        } else{
            $stmt = $pdo->prepare("UPDATE item SET name = :name, description = :description, max_stack_size = :maxStackSize, item_type_id = :item_type_id WHERE id = :id");
            $stmt->execute([
                ':name' => $this->name,
                ':description' => $this->description,
                ':item_type_id' => $itemType,
                ':maxStackSize' => $this->maxStackSize,
                ':id' => $this->id,
            ]);
        }
    }

    public static function find($id):?Item{
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM item WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        if(!$result){
            return null;
        }

        $itemType = ItemType::find($result['item_type_id']);
        return new Item(
            $result['id'],
            $result['name'],
            $result['description'],
            $result['max_stack_size'],
            $itemType
        );

    }


    public function getId():?int{
        return $this->id;
    }
    public function getName():string{
        return $this->name;
    }

    public function getDescription():string{
        return $this->description;
    }
    public function getMaxStackSize():int{
        return $this->maxStackSize;
    }

    public function getItemType():ItemType{
        return $this->itemType;
    }
}