<?php

namespace App\Models\Chapters;
use App\Core\Database;
class ChapterChoice
{
    private ?int $id;
    private Chapter $fromChapter;
    private Chapter $toChapter;

    public function __construct($id, $fromChapter, $toChapter){
        $this->id = $id;
        $this->fromChapter = $fromChapter;
        $this->toChapter = $toChapter;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFromChapter(): Chapter
    {
        return $this->fromChapter;
    }

    public function getToChapter():Chapter
    {
        return $this->toChapter;
    }
}