<?php

namespace App\Models\Items;

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

    public function getId(): ?int{
        return $this->id;
    }
    public function getCategory(): string{
        return $this->category;
    }
}