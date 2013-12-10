<?php 
/**
* PHP5 PDO Singleton 
*
*/ 
class DB {

        protected static $instance;

        protected function __construct() {}

        public static function getInstance($db_host, $db, $db_user, $db_password, $db_port = "3306") {

                if(empty(self::$instance)) {

                        $db_info = array(
                                "db_host" => $db_host,
                                "db_port" => $db_port,
                                "db_user" => $db_user,
                                "db_pass" => $db_password,
                                "db_name" => $db,
                                "db_charset" => "UTF-8"
                        );
                        
                        
                        try {                          
                                self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                                self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );  
                                self::$instance->query('SET NAMES utf8');
                                self::$instance->query('SET CHARACTER SET utf8');

                        }  
                        catch(PDOException $e) {  
                                echo $e->getMessage();  
                        }                          
                        
                }
                
                return self::$instance;
        
        }
   

}

//Example
// $db = DB::getInstance("localhost","reedem_one","root","");
// $e = $db->prepare("SELECT * FROM country");
// $e->execute();
// $e->setFetchMode(PDO::FETCH_NUM); //FETCH_ROW 

/* while($row = $e->fetch()) {  
   echo $row[0] . " : ";    
   echo $row[1] . "<br>";  
} */

?>