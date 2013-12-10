<?php

require_once 'memcache.class.php';
require_once 'database.class.php';

// create as many database connection as you required.

//  eg:  $db = DB::getInstance("HOST","DATABASE","USERNAME","PASSWORD");

global $db;
$db = DB::getInstance("localhost","schups","root","");

?>