<?php
include_once 'data.php';
include_once '../Domain/order.php';
class OrderData extends Data
{

    public static function getOrders(){
        $orders = [];
        $conexionDB = Data::createInstance();
        // Extraeremos las ordenes donde el estado sea 0 (Sin tomar) o 1 (En proceso)
        $sql = $conexionDB->query("SELECT * FROM tborder WHERE state='0' OR state = '1'");
        foreach($sql->fetchAll() as $order){
            $orders[] = new Order($order['id'],$order['clientid'], $order['client_name'], $order['client_lastname'], $order['client_phone_number'], $order['client_address'], $order['pizza'], $order['size'], $order['beverage'], $order['comment'], $order['state'], $order['date'], $order['total'], $order['xpress']);
            
        }
        return $orders;
    }
    public static function getOrderForDelivery(){
        $date = date("Y-m-d");
        $orders = [];
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tborder WHERE state='2' AND xpress= '1' AND date='".$date."'");
        foreach($sql->fetchAll() as $order){
            $orders[] = new Order($order['id'],$order['clientid'], $order['client_name'], $order['client_lastname'], $order['client_phone_number'], $order['client_address'], $order['pizza'], $order['size'], $order['beverage'], $order['comment'], $order['state'], $order['date'], $order['total'], $order['xpress']);
            
        }
        return $orders;
    }
    public static function getReadyOrderForDelivery(){
        $date = date("Y-m-d");
        $orders = [];
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tborder WHERE state='3' AND xpress= '1' AND date='".$date."'");
        foreach($sql->fetchAll() as $order){
            $orders[] = new Order($order['id'],$order['clientid'], $order['client_name'], $order['client_lastname'], $order['client_phone_number'], $order['client_address'], $order['pizza'], $order['size'], $order['beverage'], $order['comment'], $order['state'], $order['date'], $order['total'], $order['xpress']);
            
        }
        return $orders;
    }
    public static function getOrdersByClient($id){
        $orders = [];
        $conexionDB = Data::createInstance();
        $sql = $conexionDB->query("SELECT * FROM tborder where clientid='".$id."'");
        foreach($sql->fetchAll() as $order){
            $orders[] = new Order($order['id'],$order['clientid'], $order['client_name'], $order['client_lastname'], $order['client_phone_number'], $order['client_address'], $order['pizza'], $order['size'], $order['beverage'], $order['comment'], $order['state'], $order['date'], $order['total'], $order['xpress']);
            
        }
        return $orders;
    }
    public static function getNextID(){
            $conection = Data::createInstance();

            $sql = $conection->query("SELECT MAX(id) AS id FROM tborder");
            $accountand = $sql->fetch();
            return $accountand["id"];
        }
    public static function save($order, $amountBeverages){
        $conection = Data::createInstance();
        $sql = $conection -> prepare("INSERT INTO tborder(id, clientid, client_name, client_lastname, client_phone_number, client_address, pizza, beverage, size, comment, date, total, number_beverages, xpress) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql -> execute(array(OrderData::getNextID()+1, $order->getClientID(), $order->getClientName(), $order->getClientLastName(), $order->getClientPhoneNumber(), $order->getClientAddress(), $order->getPizza(), $order->getBeverage(), $order->getSize(), $order->getComment(), $order->getDate(), $order->getTotal(), $amountBeverages, $order->getXpress()));
        
        return 1;
    }
    public static function changeOrderState($id, $state){
        
        $connection = Data::createInstance();
        $sql = $connection->query("UPDATE tborder SET state='".$state."' WHERE id='".$id."'");

        return 1;
    }
    public static function edit($order){
        $connection = Data::createInstance();
        $sql = $connection->query("UPDATE tborder SET pizza='".$order->getPizza()."', beverage='".$order->getBeverage()."', size='".$order->getSize()."', comment='".$order->getComment()."', total='".$order->getTotal()."', xpress='".$order->getXpress()."' WHERE id='".$order->getID()."'");

        return 1;
    }
    public static function delete($id){
        $connection = Data::createInstance();
        $sql = $connection->query("DELETE FROM tborder WHERE id='".$id."'");

        return 1;
    }
}
