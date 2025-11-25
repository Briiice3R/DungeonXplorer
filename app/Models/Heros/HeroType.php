<?php
namespace App\Models\Heros;

class HeroType{
    protected string $name;
    protected string $description;
    protected float $maxPv;
    protected float $maxMana;
    protected float $maxStrength;
    protected float $maxInitiative;
    protected int $maxItems;

    public function __construct(
        $name,
        $description,
        $maxPv,
        $maxMana,
        $maxStrength,
        $maxInitiative,
        $maxItems
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->maxPv = $maxPv;
        $this->maxMana = $maxMana;
        $this->maxStrength = $maxStrength;
        $this->maxInitiative = $maxInitiative;
        $this->maxItems = $maxItems;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getMaxPv(): float {
        return $this->maxPv;
    }

    public function getMaxMana(): float {
        return $this->maxMana;
    }

    public function getMaxStrength(): float {
        return $this->maxStrength;
    }

    public function getMaxInitiative(): float {
        return $this->maxInitiative;
    }

    public function getMaxItems(): int {
        return $this->maxItems;
    }
}