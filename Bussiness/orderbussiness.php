<?php
    include_once "../Data/orderdata.php";
    class OrderBussiness{
        private $data;
        public function __construct(){
            $this->data = new OrderData();
        }

        public function save($order, $amountBeverages){
            return $this->data->save($order, $amountBeverages); 
        }
        public function edit($order){
            return $this->data->edit($order); 
        }
        public function delete($id){
            return $this->data->delete($id); 
        }
        public function getOrderForDelivery(){
            return $this->data->getOrderForDelivery(); 
        }
        public function getReadyOrderForDelivery(){
            return $this->data->getReadyOrderForDelivery(); 
        }
        public function getOrders(){
            return $this->data->getOrders();
        }
        public function getOrdersByClient($id){
            return $this->data->getOrdersByClient($id);
        }
        public function changeOrderState($id, $state){
            return $this->data->changeOrderState($id, $state);
        }
    }
?>