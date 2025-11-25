<?php
namespace App\Models\Heros;
use App\Models\Spell;

class Magicien extends Hero{

    private array $spells = [];
    public function __construct(
        $id,
        $name,
        $image,
        $biography,
        $xp,
        $pv,
        $mana,
        $strength,
        $initiative,
        $armor,
        $primaryWeapon,
        $secondaryWeapon,
        $level,
        $user,
        $heroType,
        $spells
    )
    {
        parent::__construct(
            $id,
            $name,
            $image,
            $biography,
            $pv,
            $initiative,
            $strength,
            $mana,
            $xp,
            $armor,
            $primaryWeapon,
            $secondaryWeapon,
            $level,
            $user,
            $heroType
        );

        $this->spells=$spells;
    }

    public function defense():float{
        return rand(1, 6) + $this->strength/2 + ($this->armor ? $this->armor->getProtection() : 0);
    }

    public function magicAttack(Hero $target, Spell $spell):void{
        $attack = (rand(1,6) + rand(1,6)) + $spell->getManaCost();
        $this->mana -= $spell->getManaCost();
        $damage = max(0, $attack - $this->defense());
        $target->receiveDamage($damage);
    }
}