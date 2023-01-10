<?php
include_once 'data.php';
if (file_exists("../Domain/product.php")) {
    include_once '../Domain/product.php';
}
else {
    include_once './Domain/product.php'; 
}
class StatisticData extends Data
{

    public static function getNumberOrdersPerDay($date){
        
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT COUNT(*) AS number FROM tborder WHERE date='".$date."'");
        $number = $sql->fetch();
        return $number['number'];
    }
    public static function getNumberBeveragesPerDay($date){
        $total = 0;
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT number_beverages FROM tborder WHERE date='".$date."'");
        foreach($sql->fetchAll() as $order){
            $total = $total + $order['number_beverages'];
        }
        return $total;
    }
    public static function getAmountPerDay($date){
        $total = 0;
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT total FROM tborder WHERE date='".$date."'");
        foreach($sql->fetchAll() as $order){
            $total = $total + $order['total'];
        }
        return $total;
    }
    
}
