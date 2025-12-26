<?php

namespace App\Models;
use App\Core\Database;
class Level{
    private ?int $level;
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

    public function save():void
    {
        $db = Database::getInstance();
        if($this->level === null){
            $stmt = $db->prepare("INSERT INTO Level (required_xp, pv_bonus, mana_bonus, strength_bonus, initiative_bonus) VALUES (:required_xp, :pv_bonus, :mana_bonus, :strength_bonus, :initiative_bonus)");
            $stmt->execute([
                ':required_xp' => $this->requiredXp,
                ':pv_bonus' => $this->pvBonus,
                ':mana_bonus' => $this->manaBonus,
                ':strength_bonus' => $this->strengthBonus,
                ':initiative_bonus' => $this->initiativeBonus
            ]);
            $this->level = $db->lastInsertId();
        } else{
            $stmt = $db->prepare("UPDATE Level SET required_xp = :required_xp, pv_bonus = :pv_bonus, mana_bonus = :mana_bonus, strength_bonus = :strength_bonus, initiative_bonus = :initiative_bonus WHERE level = :level");
            $stmt->execute([
                ':required_xp' => $this->requiredXp,
                ':pv_bonus' => $this->pvBonus,
                ':mana_bonus' => $this->manaBonus,
                ':strength_bonus' => $this->strengthBonus,
                ':initiative_bonus' => $this->initiativeBonus,
                ':level' => $this->level
            ]);
        }
    }

    public static function find($level): ?Level
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Level WHERE level = :level");
        $stmt->execute([':level' => $level]);
        $data = $stmt->fetch();
        if(!$data){
            return null;
        }
        return new Level(
            $data['level'],
            $data['required_xp'],
            $data['pv_bonus'],
            $data['mana_bonus'],
            $data['strength_bonus'],
            $data['initiative_bonus']
        );
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