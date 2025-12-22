<?php
namespace App\Models\Heroes;
use App\Models\Items\Potion;
use App\Models\User;
use App\Models\Level;

class Guerrier extends Hero{

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
    User       $user,
    ?Inventory $inventory,
    HeroType  $heroType,
    Level     $level,
    ?Armor     $armor,
    ?Weapon    $primaryWeapon,
    ?Weapon    $secondaryWeapon
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
    }
    public function defense():float{
        return rand(1, 6) + $this->getStrength()/2 + ($this->armor ? $this->armor->getProtection() : 0);
    }
}