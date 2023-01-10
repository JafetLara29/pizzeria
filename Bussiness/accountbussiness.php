<?php
    include "../Data/accountdata.php";
    class AccountBussiness{
        private $data;
        public function __construct(){
            $this->data = new AccountData();
        }

        public function validateAccount($account){
            return $this->data->validateAccount($account); 
        }
        public function validateUserExist($user){
            return $this->data->validateUserExist($user); 
        }
        public function save($account, $client){
            return $this->data->save($account, $client); 
        }
        public function getUserName($id){
            return $this->data->getUserName($id); 
        }
        public function getClient($id){
            return $this->data->getClient($id); 
        }
        public function getUserID($user){
            return $this->data->getUserID($user); 
        }
        
    }
?>