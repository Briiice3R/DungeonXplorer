<?php
    namespace App\Models;
    use App\Core\Database;


    class User{

        protected $username;
        protected $email;
        protected $id;
        protected $password;
        protected $created_at;
        protected $gender;
        
        
        // Crée un profile à partir de l'id et des autres données d'un compte lié à cet id dans la base de données
        public function __construct($id){
            $this->id = $id;
            $data = $this->recupere_Donnee($id);
            if ($data) {
                $this->username = $data['username'];
                $this->email  = $data['email'];
                $this->password = $data['password'];
                $this->created_at = $data['created_at'];
                $this->gender = $data['gender'];
            }
        }
        
        // Retourne le nom de l'utilisateur
        public function get_Name(){
            return $this->username;
        }

        // Modifie le nom de l'utilisateur'
        public function set_Name($name){
            $this-> name = $username;
        }

        // Retourne l'adresse mail de l'utilisateur
        public function get_Email(){
            return $this->email;
        }

        // Modifie l'adresse mail de l'utilisateur'
        public function set_Email($email){
            $this->email = $email;
        }

        public function get_Created_at(){
            return $this->created_at;
        }

        public function set_Gender($gender){
            $this->gender = $gender;
        }

        public function get_Gender(){
            return $this->gender;
        }

        public function traduit_genre(){
            if($this->gender == 'female'){
                return 'femme';
            }
            elseif($this->gender == 'male'){
                return 'homme';
            }
            elseif($this->gender == 'other'){
                return 'autre';
            }
            else{
                return 'ne souhaite pas le communiquer';
            }
            
        }

        // Modifie le mot de passe de l'utilisateur'
        public function set_Password($password){
            $this->password = $password;
        }

        // Modifie le mot de passe de l'utilisateur'
        public function get_Password(){
           return $this->password;
        }
        
        // Retourne l'id lié au compte de l'utilisateur
        public function get_Id(){
            return $this->id;
        }

        // Récupère les données du compte dans la base de données
        public function recupere_Donnee($id){
            $data = Database::getInstance();
            $query = $data->prepare("SELECT * FROM User  WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            return $query->fetch(\PDO::FETCH_ASSOC);
       
    }
    // Met à jour les informations sur le compte
    public function maj_Profil($id, $username, $email, $password, $gender){
        $data = Database::getInstance();
        
        if( $username != null ){
            $query = $data->prepare(" UPDATE User SET username= :username WHERE id= :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':username', $username);
            $query->execute();
        }
        if( $password != null ){
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $query = $data->prepare(" UPDATE User SET password = :password WHERE id= :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':password', $hash);
            $query->execute();
        }
        if($email !=null){
            $query = $data->prepare(" UPDATE User SET email = :email WHERE id= :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':email', $email);
            $query->execute();
        }
        if($gender !=null){
            $query = $data->prepare(" UPDATE User SET gender = :gender WHERE id= :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':gender', $gender);
            $query->execute();
        }
        header('location: /profile');
    }

    // Permet de supprimer le compte de la base de données et efface aussi les données de session liées au compte
    public function supprimer_Profil($id){
        $data = Database::getInstance();
        $query = $data->prepare(" DELETE FROM User WHERE id= :id");
        $query->bindParam(':id', $id);
        $query->execute();
        session_destroy();
        session_unset();
    }
}


?>