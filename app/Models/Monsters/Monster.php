<?php

// models/Monster.php
namespace App\Models\Monsters;
use App\Core\Database;
abstract class Monster
{
    protected ?int $id;
    protected string $name;
    protected string $description;
    protected float $pv;
    protected float $mana;
    protected float $initiative;
    protected float $strength;
    protected float $dropXp;
    protected MonsterType $monsterType;

    public function __construct($id, $name, $description, $pv, $mana, $initiative, $strength, $dropXp, $monsterType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->pv = $pv;
        $this->mana = $mana;
        $this->initiative = $initiative;
        $this->strength = $strength;
        $this->dropXp = $dropXp;
        $this->monsterType = $monsterType;
    }

    public function save(){
        $db = Database::getInstance();
        $monsterTypeId = $this->monsterType->getId();
        if($this->id === null){
            // Insert new monster
            $stmt = $db->prepare("INSERT INTO monster (name, description, pv, mana, initiative, strength, dropXp, monster_type_id) VALUES (:name, :description, :pv, :mana, :initiative, :strength, :dropXp, :monsterTypeId)");
            $stmt->execute([
                ':name' => $this->name,
                ':description' => $this->description,
                ':pv' => $this->pv,
                ':mana' => $this->mana,
                ':initiative' => $this->initiative,
                ':strength' => $this->strength,
                ':dropXp' => $this->dropXp,
                ':monsterTypeId' => $monsterTypeId
            ]);
            $this->id = $db->lastInsertId();
        } else {
            // Update existing monster
            $stmt = $db->prepare("UPDATE monster SET name = :name, description = :description, pv = :pv, mana = :mana, initiative = :initiative, strength = :strength, dropXp = :dropXp, monster_type_id = :monsterTypeId WHERE id = :id");
            $stmt->execute([
                ':name' => $this->name,
                ':description' => $this->description,
                ':pv' => $this->pv,
                ':mana' => $this->mana,
                ':initiative' => $this->initiative,
                ':strength' => $this->strength,
                ':dropXp' => $this->dropXp,
                ':monsterTypeId' => $monsterTypeId,
                ':id' => $this->id
            ]);
        }
    }

    public static function find($id){
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM monster WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        if(!$result){
            return null;
        }
        $monsterType = MonsterType::find($result['monster_type_id']);
        switch($monsterType->getName()){
            case 'Orc':
                return new Orc(
                    $result['id'],
                    $result['name'],
                    $result['description'],
                    $result['pv'],
                    $result['mana'],
                    $result['initiative'],
                    $result['strength'],
                    $result['dropXp']
                );
            default:
                return null;
        }
    }

    abstract public function attack();


    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPv(): float
    {
        return $this->pv;
    }

    public function getMana(): float
    {
        return $this->mana;
    }

    public function getInitiative(): float
    {
        return $this->initiative;
    }

    public function getStrength(): float
    {
        return $this->strength;
    }

    public function getDropXp():float{
        return $this->dropXp;
    }

    public function getMonsterType(): MonsterType{
        return $this->monsterType;
    }


}
