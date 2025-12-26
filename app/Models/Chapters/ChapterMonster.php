<?php
    namespace App\Models\Chapters;
    use App\Core\Database;

    class ChapterMonster{
        protected $chapter_id;
        protected $monster_id;

        public function __construct($id){
            $data = Database::getInstance();
            $query = $data->prepare("SELECT * FROM Chapter_Monster  WHERE chapter_id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            return $query->fetch(\PDO::FETCH_ASSOC);
        }

        public function getChapterId(){
            return $this->chapter_id;
        }

        public function getMonsterId(){
            return $this->monster_id;
        }

        public function isChapterMonster($id){
            $data = Database::getInstance();
            $query = $data->prepare("SELECT * FROM Chapter_Monster  WHERE chapter_id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            return $result !== false;
    
        }


    }

?>