<?php
namespace App\Models\Heroes;

use App\Models\Items\Armor;
use App\Models\Items\InventorySlot;
use App\Models\Items\Potion;
use App\Models\Items\Weapon;
use App\Models\Level;
use App\Models\User;
use App\Models\Items\Item;
use App\Models\Items\Inventory;
use App\Core\Database;

abstract class Hero{
    protected ?int $id;
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
    protected ?Inventory $inventoryItems;
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
        User       $user,
        ?Inventory $inventoryItems,
        HeroType  $heroType,
        Level     $level,
        ?Armor     $armor,
        ?Weapon    $primaryWeapon,
        ?Weapon    $secondaryWeapon
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
        $this->inventoryItems = $inventoryItems;
        $this->heroType = $heroType;
        $this->level = $level;
        $this->armor = $armor;
        $this->primaryWeapon = $primaryWeapon;
        $this->secondaryWeapon = $secondaryWeapon;
    }

    public function save(): void
    {
        // On récupère la connexion PDO (Singleton)
        $pdo = Database::getInstance();

        // 1. Préparation des IDs des objets liés (Clés étrangères)
        // Si l'objet (ex: armor) existe, on prend son ID, sinon on envoie NULL à la BDD
        $armorId = $this->armor?->getId();
        $primaryWeaponId = $this->primaryWeapon?->getId();
        $secondaryWeaponId = $this->secondaryWeapon?->getId();


        $levelValue = $this->level->getLevel(); // ou ->getLevel() selon ta classe Level
        $userId = $this->user->get_Id();
        $typeId = $this->heroType->getId();

        // 2. Tableau des données à envoyer (Paramètres nommés pour la sécurité)
        $params = [
            ':name' => $this->name,
            ':image' => $this->image,
            ':bio' => $this->biography,
            ':xp' => $this->xp,
            ':pv' => $this->pv,
            ':mana' => $this->mana,
            ':str' => $this->strength,
            ':init' => $this->initiative,
            ':armor' => $armorId,
            ':w1' => $primaryWeaponId,
            ':w2' => $secondaryWeaponId,
            ':lvl' => $levelValue,
            ':uid' => $userId,
            ':tid' => $typeId,
        ];

        // 3. Logique : INSERT ou UPDATE ?
        if ($this->id === null) {
            // --- SCÉNARIO CRÉATION (INSERT) ---
            $sql = "INSERT INTO Hero (
                        name, image, biography, xp, pv, mana, strength, initiative,
                        armor_id, primary_weapon_id, secondary_weapon_id,
                        level, user_id, hero_type_id
                    ) VALUES (
                        :name, :image, :bio, :xp, :pv, :mana, :str, :init,
                        :armor, :w1, :w2,
                        :lvl, :uid, :tid
                    )";

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            // 4. Récupérer l'ID généré par la BDD et le mettre dans l'objet
            $this->id = (int)$pdo->lastInsertId();
        }
        else {
            // --- SCÉNARIO SAUVEGARDE (UPDATE) ---
            $sql = "UPDATE Hero SET 
                        name = :name,
                        image = :image,
                        biography = :bio,
                        xp = :xp,
                        pv = :pv,
                        mana = :mana,
                        strength = :str,
                        initiative = :init,
                        armor_id = :armor,
                        primary_weapon_id = :w1,
                        secondary_weapon_id = :w2,
                        level = :lvl,
                        user_id = :uid,
                        hero_type_id = :tid
                    WHERE id = :id";

            // On ajoute l'ID aux paramètres pour la clause WHERE
            $params[':id'] = $this->id;

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }
    }

    public static function find(int $id): ?Hero{
        // Cette méthode sera implémentée dans les classes filles
        $db = Database::getInstance();
        $sql = "SELECT * FROM Hero WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(!$result){
            return null;
        }

        $user = User::find($result["user_id"]);
        $heroType = HeroType::find($result["hero_type_id"]);
        $level = Level::find($result["level"]);
        $armor = $result["armor_id"] ? Armor::find($result["armor_id"]) : null;
        $primaryWeapon = $result["primary_weapon_id"] ? Weapon::find($result["primary_weapon_id"]) : null;
        $secondaryWeapon = $result["secondary_weapon_id"] ? Weapon::find($result["secondary_weapon_id"]) : null;

        $heroInstance = null;
        switch($heroType->getName()){
            case "Guerrier":
                $heroInstance = new Guerrier(
                    $result["id"],
                    $result["name"],
                    $result["image"],
                    $result["biography"],
                    $result["xp"],
                    $result["pv"],
                    $result["mana"],
                    $result["strength"],
                    $result["initiative"],
                    $user,
                    null,
                    $heroType,
                    $level,
                    $armor,
                    $primaryWeapon,
                    $secondaryWeapon
                );
                break;
            case "Magicien":
                $spells = Spell::findSpellsByHeroId($id);
                $heroInstance =  new Magicien(
                    $result["id"],
                    $result["name"],
                    $result["image"],
                    $result["biography"],
                    $result["xp"],
                    $result["pv"],
                    $result["mana"],
                    $result["strength"],
                    $result["initiative"],
                    $user,
                    null,
                    $heroType,
                    $level,
                    $armor,
                    $primaryWeapon,
                    $secondaryWeapon,
                    $spells
                );
                break;
            case "Voleur":
                $heroInstance = new Voleur(
                    $result["id"],
                    $result["name"],
                    $result["image"],
                    $result["biography"],
                    $result["xp"],
                    $result["pv"],
                    $result["mana"],
                    $result["strength"],
                    $result["initiative"],
                    $user,
                    null,
                    $heroType,
                    $level,
                    $armor,
                    $primaryWeapon,
                    $secondaryWeapon
                );
                break;
            default:
                return null;
        }
        // Chargement de l'inventaire
        $inventoryItems = new Inventory($heroInstance, $heroType->getMaxItems());
        $inventoryItems->loadInventory();
        $heroInstance->setInventory($inventoryItems);
        return $heroInstance;
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

    public function getInventoryItems(): Inventory {
        return $this->inventoryItems;
    }

    public function setInventory(Inventory $inventoryItems): void {
        $this->inventoryItems = $inventoryItems;
    }

    public function physicAttack(Hero $target):void{
        $attack = rand(1, 6) + $this->getStrength() + ($this->primaryWeapon ? $this->primaryWeapon->getDamage() : 0);
        $defense = $target->defense();
        $damage = max(0, $attack - $defense);
        $target->receiveDamage($damage);
    }
    public abstract function defense(): float;
    public function receiveDamage(float $damage): void{
        if($this->armor){
            $damage = max(0, $damage - $this->armor->getProtection());
        }
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