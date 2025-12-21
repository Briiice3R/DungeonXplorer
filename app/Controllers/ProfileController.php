<?php
    namespace App\Controllers;
    use App\Models\User;

    class ProfileController{

        protected User $profileController;

        public function __construct(){
            
        }

        // Affiche la page pour consulter la page de profil
        public function index($id)
        {
            $this->profileController = new User($id); 
            $profileController = $this->profileController;
            include __DIR__ . "/../../resources/views/ProfilePage.php";     
        }

        // Affiche la page de modification du profile
        public function show($id)
        {
            $this->profileController = new User($id); 
            $updateProfileController = $this->profileController;
            include __DIR__ . "/../../resources/views/UpdateProfilePage.php"; 

        }
        // Met à jours les données d'un utilisateur dans la base de données
        public function update($id){
            $this->profileController = new User($id); 
            $username = htmlSpecialChars($_POST['username']);  
            $email = htmlSpecialChars($_POST['email']);
            $password = htmlSpecialChars($_POST['password']);
            $gender = htmlSpecialChars($_POST['gender']);
            $this->profileController->maj_Profil($id, $username, $email, $password, $gender);
             header('location:/profile/'.$id);
        }

        // Efface le profile de la base de données
        public function delete($id){
            $this->profileController = new User($id); 
            $deleteProfileController = $this->profileController;
            $deleteProfileController->supprimer_Profil($id);
            header('location: /');
        }
    }
?>