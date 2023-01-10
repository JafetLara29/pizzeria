<?php
    class Note{
        private $id;
        private $date;
        private $title;
        private $note;

        public function __construct($id, $date, $title, $note){
            $this->id =$id;
            $this->date =$date;
            $this->title =$title;
            $this->note =$note;
        }

        public function getID(){
            return $this->id;
        }
        public function getDate(){
            return $this->date;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getNote(){
            return $this->note;
        }
    }
?>