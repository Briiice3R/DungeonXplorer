<?php
    namespace App\Controllers;
    use App\Models\Users;

    class ProfileController{

        protected Users $profileController;

        public function __construct(){
            
        }

        // Affiche la page pour consulter la page de profil
        public function index($id)
        {
            $this->profileController = new Users($id); 
            $profileController = $this->profileController;
            include __DIR__ . "/../../resources/views/ProfilePage.php";     
        }

        // Affiche la page de modification du profile
        public function show($id)
        {
            $this->profileController = new Users($id); 
            $updateProfileController = $this->profileController;
            include __DIR__ . "/../../resources/views/UpdateProfilePage.php"; 

        }
        // Met à jours les données d'un utilisateur dans la base de données
        public function update($id){
            $this->profileController = new Users($id); 
            $full_name = htmlSpecialChars($_POST['full_name']);
            $date_of_birth = htmlSpecialChars($_POST['date_of_birth']);
            $email = htmlSpecialChars($_POST['email']);
            $gender = htmlSpecialChars($_POST['gender']);
            $this->profileController->maj_Profil($id, $full_name, $date_of_birth, $email, $gender);
             header('location:/profile/'.$id);
        }

        // Efface le profile de la base de données
        public function delete($id){
            $this->profileController = new Users($id); 
            $deleteProfileController = $this->profileController;
            $deleteProfileController->supprimer_Profil($id);
            header('location: /');
        }
    }
?>