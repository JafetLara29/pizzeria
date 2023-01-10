<?php
    class Account{
        private $id;
        private $user;
        private $password;
        private $type;

        public function __construct($id, $user, $password, $type){
            $this->id =$id;
            $this->user =$user;
            $this->password =$password;
            $this->type =$type;
        }

        public function getID(){
            return $this->id;
        }
        public function getUser(){
            return $this->user;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getType(){
            return $this->type;
        }

    }
?>