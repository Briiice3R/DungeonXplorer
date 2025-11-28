<?php
    namespace App\Controllers;
    use App\Models\Profile;

    class ProfileController{

        protected Profile $profilecontroller;

        public function __construct(){
          
             $this->profilecontroller = new Profile(1); 
            
        }

             public function index()
            {
               $profilecontroller = $this->profilecontroller;
               include __DIR__ . "/../../resources/views/ProfilePage.php";
                
            }

          

    }

?>