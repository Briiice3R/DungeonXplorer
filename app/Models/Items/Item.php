<?php

namespace App\Models\Items;

class Item{
    protected ?int $id = null;
    protected string $name;
    protected string $description;
    protected ItemType $itemType;

    public function __construct(
        $id,
        $name,
        $description,
        $itemType
    )
    {
        $this->id=$id;
        $this->name=$name;
        $this->description=$description;
        $this->itemType = $itemType;
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

    public function getItemType():ItemType{
        return $this->itemType;
    }
}