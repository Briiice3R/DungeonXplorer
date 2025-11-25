<?php
namespace App\Models\Heros;

use App\Models\Items\Armor;
use App\Models\Items\Potion;
use App\Models\Items\Weapon;
use App\Models\Level;
use App\Models\User;

abstract class Hero{
    protected int $id;
    protected string $name;
    protected string $image;
    protected string $biography;
    protected float $xp;
    protected float $pv;
    protected float $mana;
    protected float $strength;
    protected float $initiative;
    protected User $user;
    protected HeroType $heroType;
    protected Level $level;
    protected ?Armor $armor = null;
    protected ?Weapon $primaryWeapon = null;
    protected ?Weapon $secondaryWeapon = null;

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
        ?User $user,
        ?HeroType $heroType,
        ?Level $level,
        ?Armor $armor,
        ?Weapon $primaryWeapon,
        ?Weapon $secondaryWeapon
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->biography = $biography;
        $this->xp = $xp;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->strength = $strength;
        $this->initiative = $initiative;
        $this->user = $user;
        $this->heroType = $heroType;
        $this->level = $level;
        $this->armor = $armor;
        $this->primaryWeapon = $primaryWeapon;
        $this->secondaryWeapon = $secondaryWeapon;
    }

    public function getId(): int{
        return $this->id;
    }
    public function getName(): string{
        return $this->name;
    }
    public function getBiography(): string{
        return $this->biography;
    }
    public function getPv():float{
        return $this->pv + $this->level->getPvBonus();
    }

    public function getInitiative():float{
        return $this->initiative + $this->level->getInitiativeBonus();
    }

    public function getStrength():float{
        return $this->strength + $this->level->getStrengthBonus();
    }

    public function getMana():float{
        return $this->mana + $this->level->getManaBonus();
    }
    public function getImage(): string {
        return $this->image;
    }

    public function getXp(): float {
        return $this->xp;
    }

    public function getArmor(): ?Armor {
        return $this->armor;
    }

    public function getPrimaryWeapon(): ?Weapon {
        return $this->primaryWeapon;
    }

    public function getSecondaryWeapon(): ?Weapon {
        return $this->secondaryWeapon;
    }

    public function getLevel(): ?Level {
        return $this->level;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function getHeroType(): ?HeroType {
        return $this->heroType;
    }

    public function physicAttack(Hero $target):void{
        $attack = rand(1, 6) + $this->getStrength() + ($this->primaryWeapon ? $this->primaryWeapon->getDamage() : 0);
        $defense = $target->defense();
        $damage = max(0, $attack - $defense);
        $target->receiveDamage($damage);
    }
    public abstract function defense(): float;
    public function receiveDamage(float $damage): void{
        $this->pv = max(0, $this->pv - $damage);
    }
    public function consumePotion(Potion $potion): void{
        switch($potion->getEffectType()){
            case "PV":
                $this->pv = min($this->pv + $potion->getEffectValue(), $this->heroType->getMaxPv());
                break;
            case "MANA":
                $this->mana = min($this->mana + $potion->getEffectValue(), $this->heroType->getMaxMana());
                break;
            default:
                echo "Potion inexistante.";
                break;
        }
    }
}