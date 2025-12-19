<?php
    namespace App\Models;
    use App\Core\Database;


    class Users{

        protected $full_name;
        protected $email;
        protected $id;
        protected $gender;
        protected $date_of_birth;
        protected $created_at;
        protected $country_code;
        
        // Crée un profile à partir de l'id et des autres données d'un compte lié à cet id dans la base de données
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
        
        // Retourne le nom de l'utilisateur
        public function get_Name(){
            return $this->full_name;
        }

        // Modifie le nom de l'utilisateur'
        public function set_Name($name){
            $this-> name = $full_name;
        }

        // Retourne le genre de l'utilisateur
        public function get_Gender(){
            return $this->gender;
        }

        // Modifie le genre de l'utilisateur'
        public function set_Gender($gender){
            $this->gender = $gender;
        }

        // Retourne l'adresse mail de l'utilisateur
        public function get_Email(){
            return $this->email;
        }

        // Modifie l'adresse mail de l'utilisateur'
        public function set_Email($email){
            $this->email = $email;
        }

        // Modifie la date de naissance de l'utilisateur
        public function set_Date_of_Birth($date_of_birth){
            $this->date_of_birth = $date_of_birth;
        }

        // Retourne la date de naissance de l'utilisateur
        public function get_Date_of_Birth(){
           return $this->date_of_birth;
        }

        // Retourne la date de création du compte de l'utilisateur
        public function get_Create_at(){
           return $this->created_at;
        }

        // Retourne l'id lié au compte de l'utilisateur
        public function get_Id(){
            return $this->id;
        }

        // Récupère les données du compte dans la base de données
        public function recupere_Donnee($id){
            $data = Database::getInstance();
            $query = $data->prepare("SELECT * FROM USERS  WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            return $query->fetch(\PDO::FETCH_ASSOC);
       
    }
    // Met à jour les informations sur le compte
    public function maj_Profil($id, $full_name, $date_of_birth, $email, $gender){
        $data = Database::getInstance();
        
        if( $full_name != null ){
            $query = $data->prepare(" UPDATE USERS SET full_name= :full_name WHERE id= :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':full_name', $full_name);
            $query->execute();
        }
        if( $date_of_birth != null){
            $query = $data->prepare(" UPDATE USERS SET date_of_birth = :date_of_birth WHERE id= :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':date_of_birth', $date_of_birth);
            $query->execute();
        }
        if($email !=null){
            $query = $data->prepare(" UPDATE USERS SET email = :email WHERE id= :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':email', $email);
            $query->execute();
        }
        if($gender != null){
            $query = $data->prepare(" UPDATE USERS SET gender= :gender WHERE id= :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':gender', $gender);
            $query->execute();
        }
        header('location: /profile');
    }

    // Permet de supprimer le compte de la base de données et efface aussi les données de session liées au compte
    public function supprimer_Profil($id){
        $data = Database::getInstance();
        $query = $data->prepare(" DELETE FROM USERS WHERE id= :id");
        $query->bindParam(':id', $id);
        $query->execute();
        session_destroy();
        session_unset();
    }
}


?>