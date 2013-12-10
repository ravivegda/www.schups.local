<?php


        
define ('ROUTED_REQUEST', true);

require_once './APIs/Business/BusinessAPI.php';

$businessAPI = BusinessAPI::getInstance();



$businessIO = new BusinessIO();
$businessIO->setInputValue('sessionToken', '0cc175b9c0f1b6a831c399e269772661');
$businessIO->sealInputs();

$businessIO = $businessAPI->getUsername($businessIO);

echo $businessIO->getOutputValue('username');


//======================================================================

// require_once "./APIs/Data/config.php";
require_once "./APIs/Data/userInfo.class.php";

$userinfo = new userInfo();
$user_db_data = $userinfo->listUsers();

echo "<br><pre>List All User Data:<br>";

foreach($user_db_data as $k => $v)
{
    echo $v['id']." &nbsp; ";
    echo $v['first_name']." &nbsp; ";
    echo $v['last_name']." &nbsp; ";
    echo $v['email']." &nbsp; ";
    echo "<br>";  
}


echo "<hr>User data by ID : <br>";
// get user by user id
$userDataById = $userinfo->getUserById(1);
if($userDataById && $userDataById != "")
{
    echo $userDataById['id']." &nbsp; ";
    echo $userDataById['first_name']." &nbsp; ";
    echo $userDataById['last_name']." &nbsp; ";
    echo $userDataById['email']." &nbsp; ";
}
else
{
    echo "No Data Found";
}

echo "</pre>";