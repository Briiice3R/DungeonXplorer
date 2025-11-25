<?php

namespace App\Models\Items;

class Armor extends Item
{
    private float $protection;
    public function __construct(
        $id,
        $name,
        $description,
        $itemType,
        $protection
    ) {
        parent::__construct($id, $name, $description, new ItemType(null, ItemType::ARMOR));
        $this->protection = $protection;
    }

    public function getProtection(): float {
        return $this->protection;
    }
}