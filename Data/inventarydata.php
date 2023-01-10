<?php
include_once 'data.php';
if (file_exists("../Domain/product.php")) {
    include_once '../Domain/product.php';
}
else {
    if (file_exists("./Domain/product.php")) {
        include_once './Domain/product.php';
    }else{
        include_once '../../Domain/product.php'; 

    }
}
class InventaryData extends Data
{

    public static function getInventary(){
        $products = [];
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tbinventary WHERE type='pizza' OR type='beverage'");
        foreach($sql->fetchAll() as $product){
            $products[] = new Product($product['id'],$product['name'], $product['description'], $product['price'], $product['image_path'], $product['type']);
            
        }
        return $products;
    }
    
    public static function getProduct($id){
        
        $product = "";
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tbinventary WHERE id='".$id."'");
        $product = $sql->fetch();
        $products_ = new Product($product['id'],$product['name'], $product['description'], $product['price'], $product['image_path'], $product['type']);
        
        return $products_;
    }
    public static function getSizes(){
        $products = [];
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tbinventary WHERE type='tamanio'");
        foreach($sql->fetchAll() as $product){
            $products[] = new Product($product['id'],$product['name'], $product['description'], $product['price'], $product['image_path'], $product['type']);
            
        }
        return $products;
    }
    public static function getProductByID($id){
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tbinventary WHERE id='".$id."'");
        $product = $sql->fetch();
        return $product['id'];
    }
    public static function getPizzas(){
        $products = [];
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tbinventary WHERE type='pizza'");
        foreach($sql->fetchAll() as $product){
            $products[] = new Product($product['id'],$product['name'], $product['description'], $product['price'], $product['image_path'], $product['type']);
            
        }
        return $products;
    }
    public static function getBeverage(){
        $products = [];
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tbinventary WHERE type='beverage'");
        foreach($sql->fetchAll() as $product){
            $products[] = new Product($product['id'],$product['name'], $product['description'], $product['price'], $product['image_path'], $product['type']);
            
        }
        return $products;
    }
    public static function getProductPrice($id){
        $connection = Data::createInstance();
        $sql = $connection->query("SELECT price FROM tbinventary WHERE id='".$id."'");
        $numberid = $sql->fetch();
        // print_r($numberid['price']);
        return $numberid['price'];
    }
    public static function getNextID(){
            $conection = Data::createInstance();

            $sql = $conection->query("SELECT MAX(id) AS id FROM tbinventary");
            $accountand = $sql->fetch();
            return $accountand["id"];
        }
    public static function save($product){
        $conection = Data::createInstance();
        $sql = $conection -> prepare("INSERT INTO tbinventary(id, name, description, price, image_path, type) VALUES (?,?,?,?,?,?)");
        $sql -> execute(array(InventaryData::getNextID()+1, $product->getName(), $product->getDescription(), $product->getPrice(), $product->getImagePath(), $product->getType()));
        
        return 1;
    }

    public static function edit($product){
        $connection = Data::createInstance();
        $sql = $connection->query("UPDATE tbinventary SET name='".$product->getName()."', description='".$product->getDescription()."', price='".$product->getPrice()."', image_path='".$product->getImagePath()."', type='".$product->getType()."' WHERE id='".$product->getID()."'");

        return 1;
    }
    public static function editWhithoutImage($product){
        $connection = Data::createInstance();
        $sql = $connection->query("UPDATE tbinventary SET name='".$product->getName()."', description='".$product->getDescription()."', price='".$product->getPrice()."', type='".$product->getType()."' WHERE id='".$product->getID()."'");

        return 1;
    }
    public static function delete($id){
        $connection = Data::createInstance();
        $sql = $connection->query("DELETE from tbinventary WHERE id='".$id."'");
        
    }
}
