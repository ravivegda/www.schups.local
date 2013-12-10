<?php

/*
 * User Info
 */
require_once "config.php";

class userInfo{

    public function __construct() {}
    
    /*
     * list all users info
     */
    public function listUsers()
    {
        global $db;
        $user_db_data = array();
        $cache = Cache::getInstance();
        // $cache->flush();
        if($cache->exists("user_info_data"))
        {
            $user_db_data = $cache->get("user_info_data");
        } else {    
            $e = $db->prepare("SELECT * FROM user_info");
            $e->execute();
            $user_data = $e->fetchAll();    
            // cache will clear in every 1 min.
            $cache->set("user_info_data", $user_data, 60 * 60 * 0.1);
            $user_db_data = $user_data;
        }
        return $user_db_data;
    }
    
    /*
     * list all users info
     */
    public function getUserById($user_id)
    {
        global $db;
        $user_db_data = array();
        $cache = Cache::getInstance();
        // $cache->flush();
        if($cache->exists("user_data"))
        {
            $user_db_data = $cache->get("user_data");
        } else {    

            $qry = "SELECT * FROM user_info WHERE id = ".$user_id;
            $e = $db->prepare($qry);
            $e->execute();
            $user_data = $e->fetch();    
            // cache will clear in every 1 min.
            $cache->set("user_data", $user_data, 60 * 60 * 0.1);
            
            if($e->rowCount() > 0)
                $user_db_data = $user_data;
            else
                $user_db_data = "";
        }

        return $user_db_data;
    }
}

?>
