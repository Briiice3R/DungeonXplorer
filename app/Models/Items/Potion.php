<?php

namespace App\Models\Items;

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

    public function getEffectType(): string {
        return $this->effectType;
    }
    public function getEffectValue(): float {
        return $this->effectValue;
    }
}