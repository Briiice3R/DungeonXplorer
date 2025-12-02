<?php

namespace App\Models\Monsters;
use App\Core\Database;
class MonsterType
{
    private ?int $id;
    private string $name;
    private string $description;
    public function __construct($id, $name, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function save(){
        $db = Database::getInstance();
        if($this->id === null){
            $stmt = $db->prepare("INSERT INTO monster_type (name, description) VALUES (:name, :description)");
            $stmt->execute([
                ':name' => $this->name,
                ':description' => $this->description
            ]);
            $this->id = $db->lastInsertId();
        } else{
            $stmt = $db->prepare("UPDATE monster_type SET name = :name, description = :description WHERE id = :id");
            $stmt->execute([
                ':name' => $this->name,
                ':description' => $this->description,
                ':id' => $this->id
            ]);
        }
    }

    public static function find($id){
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM monster_type WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();
        if(!$data){
            return null;
        }
        return new MonsterType($data['id'], $data['name'], $data['description']);
    }
    public function getId(): ?int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getDescription(): string{
        return $this->description;
    }

}