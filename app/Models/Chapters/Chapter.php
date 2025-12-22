<?php

// models/Chapter.php
namespace App\Models\Chapters;
use App\Models\Chapters\ChapterChoice;
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

    public function __construct($id, $title, $description, $image, $choices)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image; 
        $this->choices = $choices;
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

        return new self(
            $data['id'],
            $data['title'],
            $data['description'],
            $data['image'],
            $choices // On passe le tableau de choix à l'objet
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
}
