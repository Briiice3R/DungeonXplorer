<?php
    namespace App\Models;
    use App\Core\Database;


    class Profile{
        protected $name;
        protected $photo;
        protected $mail;
        protected $id;
        
        public function __construct($id, $name, $photo, $mail){
            $this->name = $name;
            $this->photo = $photo;
            $this->mail = $mail;
            $this->id = $id;
        }

        public function get_Name(){
            return $this->name;
        }

        public function set_Name($name){
            $this-> name = $name;
        }

        public function get_Photo(){
            return $this->photo;
        }

        public function set_Photo($photo){
            $this->photo = $photo;
        }

        public function get_Mail(){
            return $this->mail;
        }

        public function set_Mail($mail){
            $this->mail = $mail;
        }

        public function get_Id(){
            return $this->id;
        }
        public function recupere_Donnee(){
            $data = new Database();
           $query = $data->db->prepare("SELECT * FROM PROFILE  WHERE id = :1");
        $query->bindParam(':id', $taskId);
        $query->execute();
       
    }

    }


?>