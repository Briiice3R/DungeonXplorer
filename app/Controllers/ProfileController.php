<?php
    namespace App\Controllers;
    use App\Models\Profile;

    class ProfileController{

        protected Profile $profileController;

        public function __construct(){
            $this->profileController = new Profile(1); 
        }

        public function index()
        {
            $profileController = $this->profileController;
            include __DIR__ . "/../../resources/views/ProfilePage.php";     
        }

        public function show()
        {
            $updateProfileController = $this->profileController;
            include __DIR__ . "/../../resources/views/UpdateProfilePage.php"; 

        }

        public function update(){
            $full_name = $_POST['full_name'];
            $date_of_birth = $_POST['date_of_birth'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $this->profileController->maj_Profil(1, $full_name, $date_of_birth, $email, $gender);
             header('location:/profile');
        }
    }
?>