<?php

// models/Chapter.php
namespace App\Models\Chapters;
use App\Models\Chapters\ChapterChoice;
use App\Models\Monsters\Monster;
use App\Core\Database;

class Chapter
{
    private ?int $id;
    private string $title;
    private string $description;
    private string $image;

    /**
        * @var array<ChapterChoice> $choices
     */
    private array $choices;

    private int $monsterId;


    public function __construct($id, $title, $description, $image, $choices, $monsterId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image; 
        $this->choices = $choices;
        $this->monsterId = $monsterId;
    }

    public static function find($id) {
        $db = Database::getInstance();
        
        // 1. Récupérer le chapitre
        $stmt = $db->prepare("SELECT * FROM Chapter WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) return null;

        // 2. Récupérer les choix liés
        $stmtChoices = $db->prepare("SELECT * FROM Chapter_Choice WHERE from_chapter_id = :id");
        $stmtChoices->execute([':id' => $id]);
        $choices = $stmtChoices->fetchAll(\PDO::FETCH_ASSOC);

        // 3. Récupérer s'il y a un monstre
        $stmtChoices = $db->prepare("SELECT * FROM Chapter_Monster WHERE chapter_id = :id");
        $stmtChoices->execute([':id' => $id]);
        $chapterMonster = $stmtChoices->fetch(\PDO::FETCH_ASSOC);
        if($chapterMonster == false){
            $monster_id=-1;
        } else {
            $monster_id=$chapterMonster['monster_id'];
        }

        return new self(
            $data['id'],
            $data['title'],
            $data['description'],
            $data['image'],
            $choices, // On passe le tableau de choix à l'objet
            $monster_id //On passe l'id du monstre si il y en a un et -1 s'il y en a pas.
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image; 
    }

    /**
        * @return array<ChapterChoice>
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    public function getMonsterId(): int
    {
        return $this->monsterId;
    }

    public function getItemId() {
        $db = \App\Core\Database::getInstance();
        $stmt = $db->prepare("SELECT item_id FROM Chapter_item WHERE chapter_id = :chapter_id");
        $stmt->execute([':chapter_id' => $this->id]);
        
        $result = $stmt->fetch();
        return $result ? $result['item_id'] : null;
    }
}
