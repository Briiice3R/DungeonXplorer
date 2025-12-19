<?php
namespace App\Models\Heroes;
use App\Core\Database;
class HeroType{
    protected ?int $id;
    protected string $name;
    protected string $description;
    protected string $image;
    protected float $maxPv;
    protected float $maxMana;
    protected float $maxStrength;
    protected float $maxInitiative;
    protected int $maxItems;

    public function __construct(
        $id,
        $name,
        $description,
        $image,
        $maxPv,
        $maxMana,
        $maxStrength,
        $maxInitiative,
        $maxItems
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->maxPv = $maxPv;
        $this->maxMana = $maxMana;
        $this->maxStrength = $maxStrength;
        $this->maxInitiative = $maxInitiative;
        $this->maxItems = $maxItems;
    }

    public function save(){
        $db = Database::getInstance();
        if($this->id === null){
            $stmt = $db->prepare("INSERT INTO hero_type (name, image, description, max_pv, max_mana, max_strength, max_initiative, max_items) VALUES (:name, :image, :description, :max_pv, :max_mana, :max_strength, :max_initiative, :max_items)");
            $stmt->execute([
                ':name' => $this->name,
                ':image' => $this->image,
                ':description' => $this->description,
                ':max_pv' => $this->maxPv,
                ':max_mana' => $this->maxMana,
                ':max_strength' => $this->maxStrength,
                ':max_initiative' => $this->maxInitiative,
                ':max_items' => $this->maxItems
            ]);
            $this->id = $db->lastInsertId();
        } else{
            $stmt = $db->prepare("UPDATE hero_type SET name = :name, image = :image, description = :description, max_pv = :max_pv, max_mana = :max_mana, max_strength = :max_strength, max_initiative = :max_initiative, max_items = :max_items WHERE id = :id");
            $stmt->execute([
                ':name' => $this->name,
                ':image' => $this->image,
                ':description' => $this->description,
                ':max_pv' => $this->maxPv,
                ':max_mana' => $this->maxMana,
                ':max_strength' => $this->maxStrength,
                ':max_initiative' => $this->maxInitiative,
                ':max_items' => $this->maxItems,
                ':id' => $this->id
            ]);
        }
    }

    public static function find($id): ?HeroType {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM hero_type WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        if (!$result) {
            return null;
        }

        return new HeroType(
            $result['id'],
            $result['name'],
            $result['image'],
            $result['description'],
            $result['max_pv'],
            $result['max_mana'],
            $result['max_strength'],
            $result['max_initiative'],
            $result['max_items']
        );
    }

    public static function findAll() {
        $pdo=Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM Hero_type");
        $arr = array();

        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $arr[] = new HeroType($row["id"], $row["name"], $row["description"], $row["image"], $row["max_pv"], $row["max_mana"], $row["max_strength"], $row["max_initiative"], $row["max_items"]);
        }
        return $arr;
    }

    public function getId(): int {
        return $this->id;
    }


    public function getName(): string {
        return $this->name;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getMaxPv(): float {
        return $this->maxPv;
    }

    public function getMaxMana(): float {
        return $this->maxMana;
    }

    public function getMaxStrength(): float {
        return $this->maxStrength;
    }

    public function getMaxInitiative(): float {
        return $this->maxInitiative;
    }

    public function getMaxItems(): int {
        return $this->maxItems;
    }
}