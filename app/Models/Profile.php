<?php

    class Profile{
        protected $name;
        protected $photo;
        protected $mail;
        protected $id;
        
        public function __construct($id, $name, $photo, $mail){
            $this->name = $name;
            $this->photo = $photo;
            $this->mail = $mail;
            $this->id = $id;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this-> name = $name;
        }

        public function getPhoto(){
            return $this->photo;
        }

        public function setPhoto($photo){
            $this->photo = $photo;
        }

        public function getMail(){
            return $this->mail;
        }

        public function setMail($mail){
            $this->mail = $mail;
        }

        public function getId(){
            return $this->id;
        }

    }


?>