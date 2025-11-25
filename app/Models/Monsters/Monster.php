<?php

// models/Monster.php
namespace App\Models\Monsters;
abstract class Monster
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected float $pv;
    protected float $mana;
    protected float $initiative;
    protected float $strength;

    public function __construct($id, $name, $description, $pv, $mana, $initiative, $strength)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->initiative = $initiative;
        $this->strength = $strength;
    }

    abstract public function attack();


    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPv(): float
    {
        return $this->pv;
    }

    public function getMana(): float
    {
        return $this->mana;
    }

    public function getInitiative(): float
    {
        return $this->initiative;
    }

    public function getStrength(): float
    {
        return $this->strength;
    }


}
