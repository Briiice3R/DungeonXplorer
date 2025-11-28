<?php
    namespace App\Models;
    use App\Core\Database;


    class Profile{

        protected $full_name;
        protected $email;
        protected $id;
        protected $gender;
        protected $date_of_birth;
        protected $created_at;
        protected $country_code;
        
        public function __construct($id){
            $this->id = $id;
            $data = $this->recupere_Donnee($id);
            if ($data) {
                $this->full_name  = $data['full_name'];
                $this->gender = $data['gender'];
                $this->email  = $data['email'];
                $this->date_of_birth = $data['date_of_birth'];
                $this->created_at = $data['created_at'];
                $this->country_code = $data['country_code'];
            }
        }
        
        public function get_Name(){
            return $this->full_name;
        }

        public function set_Name($name){
            $this-> name = $full_name;
        }

        public function get_Gender(){
            return $this->gender;
        }

        public function set_Gender($gender){
            $this->gender = $gender;
        }

        public function get_Email(){
            return $this->email;
        }

        public function set_Email($email){
            $this->email = $email;
        }

        public function set_Date_of_Birth($date_of_birth){
            $this->date_of_birth = $date_of_birth;
        }

        public function get_Date_of_Birth(){
           return $this->date_of_birth;
        }

        public function get_Create_at(){
           return $this->created_at;
        }

        public function get_Id(){
            return $this->id;
        }
        public function recupere_Donnee($id){
            $data = Database::getInstance();
            $query = $data->prepare("SELECT * FROM USERS  WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            return $query->fetch(\PDO::FETCH_ASSOC);
       
    }

}


?>