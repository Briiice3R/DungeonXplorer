<?php
namespace App\Models\Heroes;
use App\Models\Spell;
use App\Models\User;
use App\Models\Level;

class Magicien extends Hero{

    /*** @var array<Spell> $spells*/
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
            $xp,
            $pv,
            $mana,
            $strength,
            $initiative,
            $user,
            $inventory,
            $heroType,
            $level,
            $armor,
            $primaryWeapon,
            $secondaryWeapon,
        );

        $this->spells=$spells;
    }



    public function defense():float{
        return rand(1, 6) + $this->strength/2 + ($this->armor ? $this->armor->getProtection() : 0);
    }

    public function magicAttack(Hero $target, Spell $spell):void{
        if($this->getMana() >= $spell->getManaCost()){
            $attack = (rand(1,6) + rand(1,6)) + $spell->getManaCost();
            $this->mana -= $spell->getManaCost();
            $damage = max(0, $attack - $this->defense());
            $target->receiveDamage($damage);
        }
    }
}