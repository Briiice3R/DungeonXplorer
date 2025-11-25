<?php

namespace App\Models\Items;

class Weapon extends Item
{
    private float $damage;
    public function __construct($id, $name, $description, $damage)
    {
        parent::__construct($id, $name, $description, new ItemType(null, ItemType::WEAPON));
        $this->damage = $damage;
    }

    public function getDamage():float{
        return $this->damage;
    }
}