<?php
//Conexion a la base de datos
    class Data{
        private static $instancia = NULL;
        
        public static function createInstance(){
            if(!isset(self::$instancia)){//Hacemos referencia a nuestra instancia
                $optionsPDO[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; 
                // Para la base de datos local
                // self::$instancia = new PDO('mysql:host=127.0.0.1:3702;dbname=dbpizzeria;charset=utf8', 'root', '', $optionsPDO);
                
                // Para pc Desktop Lara
                self::$instancia = new PDO('mysql:host=127.0.0.1;dbname=dbpizzeria;charset=utf8', 'root', '', $optionsPDO);
                
                // Para 000webhost;
                // self::$instancia = new PDO('mysql:host=localhost;dbname=id18453827_dbpizzeria', 'id18453827_teamcode', '([lf67XFHbla0]+L', $optionsPDO);


            }
            return self::$instancia;
        }
    
    }
?>