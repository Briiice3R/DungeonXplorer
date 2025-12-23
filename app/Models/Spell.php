<?php

namespace App\Models;
use App\Core\Database;
class Spell
{
    private ?int $id;
    private string $name;
    private string $description;
    private float $manaCost;

    public function __construct($id, $name, $description, $manaCost)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->manaCost = $manaCost;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string{
        return $this->description;
    }
    public function getManaCost(): float
    {
        return $this->manaCost;
    }

    public function save(){
        $db = Database::getInstance();
        if($this->id === null){
            $stmt = $db->prepare("INSERT INTO Spell (name, description, mana_cost) VALUES (:name, :description, :mana_cost)");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':mana_cost', $this->manaCost);
            $stmt->execute();
            $this->id = $db->lastInsertId();
        } else {
            $stmt = $db->prepare("UPDATE Spells SET name = :name, description = :description, mana_cost = :mana_cost WHERE id = :id");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':mana_cost', $this->manaCost);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        }
    }

    public static function find($id){
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Spell WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(!$data){
            return null;
        }
        return new Spell($data['id'], $data['name'], $data['description'], $data['mana_cost']);
    }
}