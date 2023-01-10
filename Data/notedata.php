<?php
include_once 'data.php';
include_once '../Domain/note.php';
class NoteData extends Data
{

    public static function getNotes(){
        $notes = [];
        $conexionDB = Data::createInstance();
        // Extraeremos las ordenes donde el estado sea 0 (Sin tomar) o 1 (En proceso)
        $sql = $conexionDB->query("SELECT * FROM tbnote");
        foreach($sql->fetchAll() as $note){
            $notes[] = new Note($note['id'],$note['date'], $note['title'], $note['note']);
            
        }
        return $notes;
    }
    public static function getNextID(){
            $conection = Data::createInstance();

            $sql = $conection->query("SELECT MAX(id) AS id FROM tbnote");
            $accountand = $sql->fetch();
            return $accountand["id"];
        }
    public static function save($note){
        $conection = Data::createInstance();
        $sql = $conection -> prepare("INSERT INTO tbnote(id, date, title, note) VALUES (?,?,?,?)");
        $sql -> execute(array(NoteData::getNextID()+1, $note->getDate(), $note->getTitle(), $note->getNote()));
        
        return 1;
    }

    public static function edit($note){
        $connection = Data::createInstance();
        $sql = $connection->query("UPDATE tbnote SET title='".$note->getTitle()."', note='".$note->getNote()."' WHERE id='".$note->getID()."'");

        return 1;
    }
    public static function delete($id){
        $connection = Data::createInstance();
        $sql = $connection->query("DELETE from tbnote WHERE id='".$id."'");
        
    }
}
