<?php
    include "../Data/notedata.php";
    class NoteBussiness{
        private $data;
        public function __construct(){
            $this->data = new NoteData();
        }
        public function getNotes(){
            return $this->data->getNotes(); 
        }
        public function save($note){
            return $this->data->save($note); 
        }
        public function edit($note){
            return $this->data->edit($note); 
        }
        public function delete($id){
            return $this->data->delete($id); 
        }
        
    }
?>