<?php
namespace App\Models\Heros;

class Voleur extends Hero{

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
        $heroType
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
    }

    public function defense():float{
        return rand(1, 6) + $this->getInitiative()/2 + ($this->armor ? $this->armor->getProtection() : 0);
    }
}