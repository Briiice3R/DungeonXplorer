<?php
namespace App\Models\Heroes;
use App\Models\Items\Potion;
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
        $user,
        $inventory,
        $heroType,
        $level,
        $armor,
        $primaryWeapon,
        $secondaryWeapon,
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