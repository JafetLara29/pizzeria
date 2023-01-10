<?php
    include "../Data/statisticdata.php";
    
    class StatisticBussiness{
        private $data;
        public function __construct(){
            $this->data = new StatisticData();
        }
        public function getNumberOrdersPerDay($date){
            return $this->data->getNumberOrdersPerDay($date); 
        }
        public function getNumberBeveragesPerDay($date){
            return $this->data->getNumberBeveragesPerDay($date); 
        }
        public function getAmountPerDay($date){
            return $this->data->getAmountPerDay($date); 
        }
    }
?>