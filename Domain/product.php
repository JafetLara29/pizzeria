<?php
    class Product{
        private $id;
        private $name;
        private $description;
        private $price;
        private $imagePath;
        private $type;

        public function __construct($id, $name, $description, $price, $imagePath, $type){
            $this->id =$id;
            $this->name =$name;
            $this->description =$description;
            $this->price =$price;
            $this->imagePath =$imagePath;
            $this->type = $type;
        }

        public function getID(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getDescription(){
            return $this->description;
        }
        public function getPrice(){
            return $this->price;
        }
        public function getImagePath(){
            return $this->imagePath;
        }
        public function getType(){
            return $this->type;
        }
    }
?>