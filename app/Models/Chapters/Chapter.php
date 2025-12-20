<?php

// models/Chapter.php
namespace App\Models\Chapters;
use App\Models\Chapters\ChapterChoice;

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
