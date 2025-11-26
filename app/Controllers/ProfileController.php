<?php
    namespace App\Controllers;
    use App\Models\Profile;
    
    class ProfileController{

        protected $profile;

        public function __construct(){
            $this->profile = new Profile(1, "nom", "photo", "mail");
        }

             public function index()
            {
               $profile = $this->getProfile();
                include __DIR__ . "/../../resources/views/ProfilePage.php";
                
            }

            public function getProfile(){
                return $this->profile->recupere_Donnee();
            }

           

            
    

    }

?>