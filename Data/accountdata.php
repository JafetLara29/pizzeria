<?php
include_once 'data.php';
include_once '../Domain/account.php';
include_once '../Domain/client.php';
class AccountData extends Data
{

    public function validateAccount($account)
    {
        $connection = Data::createInstance();
        $user = AccountData::validateUserExist($account->getUser());
        if($user == 0){
            $sql = $connection->query("SELECT type FROM tbaccount WHERE BINARY password='".$account->getPassword()."'");
            $password = $sql->fetch();
            if(isset($password)){
                return $password['type'];
            }

        }
    }
    public static function validateUserExist($user){
        $connection = Data::createInstance();
        $sql = $connection->query("SELECT type FROM tbaccount WHERE BINARY user='".$user."'");
        $user = $sql->fetch();
        if(empty($user)){
            return 1;
        }else{
            return 0;
        }
    }
    public function getUserID($user)
    {
        $connection = Data::createInstance();
        $sql = $connection->query("SELECT id FROM tbaccount WHERE BINARY user='".$user."'");
        $user = $sql->fetch();

        return $user['id'];
    }
    public static function getNextIDAccount(){
        $conection = Data::createInstance();

        $sql = $conection->query("SELECT MAX(id) AS id FROM tbaccount");
        $accountand = $sql->fetch();
        return $accountand["id"];
    }
    public static function getNextIDClient(){
        $conection = Data::createInstance();

        $sql = $conection->query("SELECT MAX(id) AS id FROM tbclient");
        $accountand = $sql->fetch();
        return $accountand["id"];
    }
    public static function save($account, $client){
        $conection = Data::createInstance();
        $sql = $conection -> prepare("INSERT INTO tbaccount(id, user, password, type) VALUES (?,?,?,?)");
        $sql -> execute(array(AccountData::getNextIDAccount()+1, $account->getUser(), $account->getPassword(), $account->getType()));
        
        $sql = $conection -> prepare("INSERT INTO tbclient(id, name, lastname, address, phone_number) VALUES (?,?,?,?,?)");
        $sql -> execute(array(AccountData::getNextIDClient()+1, $client->getName(), $client->getLastName(), $client->getAddress(), $client->getPhoneNumber()));
        return 1;
    }
    public static function getUserName($id){
        $connection = Data::createInstance();
        $sql = $connection->query("SELECT user FROM tbaccount WHERE id='".$id."'");
        $user = $sql->fetch();
        return $user['user'];
    }
    public static function getClient($id){
        
        $client_="";
        $connection = Data::createInstance();
        $sql = $connection->query("SELECT * FROM tbclient WHERE id='".$id."'");
        $client = $sql->fetch();
        $client_ = new Client($client['id'],$client['name'], $client['lastname'], $client['phone_number'], $client['address']);
        
        return $client_;
    }

}
