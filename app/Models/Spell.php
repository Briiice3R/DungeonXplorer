<?php

namespace App\Models;

class Spell
{
    private string $id;
    private string $name;
    private string $description;
    private float $manaCost;

    public function __construct(string $id, string $name, string $description, float $manaCost)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->manaCost = $manaCost;
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string{
        return $this->description;
    }
    public function getManaCost(): float
    {
        return $this->manaCost;
    }
}