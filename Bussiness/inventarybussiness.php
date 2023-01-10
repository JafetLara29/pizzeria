<?php
    if (file_exists("../Data/inventarydata.php")) {
        include "../Data/inventarydata.php";
    }
    else {
        if (file_exists("./Data/inventarydata.php")) {
            include "./Data/inventarydata.php";
        }else{
            include "../../Data/inventarydata.php";

        }
    }
    class InventaryBussiness{
        private $data;
        public function __construct(){
            $this->data = new InventaryData();
        }
        // Para obtener refrescos y pizzas
        public function getInventary(){
            return $this->data->getInventary(); 
        }
        public function getProduct($id){
            return $this->data->getProduct($id); 
        }
        // Para obtener la lista de tamaños registrados
        public function getSizes(){
            return $this->data->getSizes(); 
        }
        // Para obtener solo pizzas
        public function getPizzas(){
            return $this->data->getPizzas(); 
        }
        // Para obtener solo bebidas
        public function getBeverage(){
            return $this->data->getBeverage(); 
        }
        
        public function getProductPrice($id){
            return $this->data->getProductPrice($id); 
        }
        public function save($inventary){
            return $this->data->save($inventary); 
        }
        public function edit($inventary){
            return $this->data->edit($inventary); 
        }
        public function editWhithoutImage($inventary){
            return $this->data->editWhithoutImage($inventary); 
        }
        public function delete($id){
            return $this->data->delete($id); 
        }
        
    }
?>