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
    }
?>