<?php
    namespace App\Controllers;
    use App\Models\Profile;

    class UpdateProfileController extends ProfileController{

        protected Profile $profilecontroller;

        public function __construct(){
            $this->profilecontroller = new Profile(1); 
        }
        
        public function index()
        {
            $UprofileController = $this->profilecontroller;
            include __DIR__ . "/../../resources/views/UpdateProfilePage.php";     
        }
    }
?>