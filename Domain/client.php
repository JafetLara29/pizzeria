<?php
    class client{
        private $id;
        private $name;
        private $lastName;
        private $phoneNumber;
        private $address;

        public function __construct($id, $name, $lastName, $phoneNumber, $address){
            $this->id =$id;
            $this->name =$name;
            $this->lastName =$lastName;
            $this->phoneNumber =$phoneNumber;
            $this->address =$address;

        }

        public function getID(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getLastName(){
            return $this->lastName;
        }
        public function getPhoneNumber(){
            return $this->phoneNumber;
        }
        public function getAddress(){
            return $this->address;
        }
    }
?>