<?php
    class Order{
        private $id;
        private $clientid;
        private $clientName;
        private $clientLastName;
        private $clientPhoneNumber;
        private $clientAddress;
        private $pizza;
        private $size;
        private $beverage;
        private $comment;
        private $state;
        private $date;
        private $total;
        private $xpress;

        public function __construct($id, $clientid, $clientName,$clientLastName, $clientPhoneNumber, $clientAddress, $pizza, $size, $beverage, $comment, $state, $date, $total, $xpress){
            $this->id =$id;
            $this->clientid =$clientid;
            $this->clientName =$clientName;
            $this->clientLastName =$clientLastName;
            $this->clientPhoneNumber =$clientPhoneNumber;
            $this->clientAddress =$clientAddress;
            $this->pizza =$pizza;
            $this->size =$size;
            $this->beverage =$beverage;
            $this->comment = $comment;
            $this->state = $state;
            $this->date = $date;
            $this->total = $total;
            $this->xpress = $xpress;
        }

        public function getID(){
            return $this->id;
        }
        public function getClientID(){
            return $this->clientid;
        }
        public function getClientName(){
            return $this->clientName;
        }
        public function getClientLastName(){
            return $this->clientLastName;
        }
        public function getClientPhoneNumber(){
            return $this->clientPhoneNumber;
        }
        public function getClientAddress(){
            return $this->clientAddress;
        }
        public function getPizza(){
            return $this->pizza;
        }
        public function getSize(){
            return $this->size;
        }
        public function getBeverage(){
            return $this->beverage;
        }
        public function getComment(){
            return $this->comment;
        }
        public function getState(){
            return $this->state;
        }
        public function getDate(){
            return $this->date;
        }
        public function getTotal(){
            return $this->total;
        }
        public function getXpress(){
            return $this->xpress;
        }
    }
?>