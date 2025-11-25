<?php

namespace App\Models;

class Level{
    private int $level;
    private float $requiredXp;
    private float $pvBonus;
    private float $manaBonus;
    private float $strengthBonus;
    private float $initiativeBonus;

    public function __construct(
        $level,
        $requiredXp,
        $pvBonus,
        $manaBonus,
        $strengthBonus,
        $initiativeBonus
    )
    {
        $this->level = $level;
        $this->requiredXp = $requiredXp;
        $this->pvBonus = $pvBonus;
        $this->manaBonus = $manaBonus;
        $this->strengthBonus = $strengthBonus;
        $this->initiativeBonus = $initiativeBonus;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function getRequiredXp(): float {
        return $this->requiredXp;
    }

    public function getPvBonus(): float {
        return $this->pvBonus;
    }

    public function getManaBonus(): float {
        return $this->manaBonus;
    }

    public function getStrengthBonus(): float {
        return $this->strengthBonus;
    }

    public function getInitiativeBonus(): float {
        return $this->initiativeBonus;
    }
}